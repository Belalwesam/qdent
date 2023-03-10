<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderReqeust;
use App\Mail\OrderShipped;
use App\Model\Address;
use App\Model\Cart;
use App\Model\Device;
use App\Model\Item;
use App\Model\Notification;
use App\Model\Order;
use App\Model\Period;
use App\Model\Product;
use App\Model\ShippingMethod;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class OrderController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $status = null)
    {
        $page_title = __("All Orders");
        $page_description = __(' Order in the store ');
        // order using datatables
        if ($request->has('user_id')) {
            $data = Order::where('user_id', $request->user_id)->latest('id')->get();
        }elseif($status != null) {
            $data = Order::where('status',$status)->latest('id')->get();
        }

        else {
                $data = Order::latest('id')->get();

        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return  '<span class="badge badge-'.$row->span().'">' . $row->status . '</span>';
                })->addColumn('name', function ($row) {
                    return  $row->user->name ?? '-';
                })->addColumn('product_name', function ($row) {
                    $product = '';
                    foreach ($row->carts->items ?? collect() as $item) {
                      $product .= ($item->product->name ?? "-") .", ";
                    }
                    return  $product;
                })->addColumn('quantity', function ($row) {
                    $qty = 0;

                    foreach ($row->carts->items ?? collect() as $item) {
                      $qty += $item->qty ?? 0;
                    }
                    return $qty;
                })->addColumn('location', function ($row) {

                    return  $row->address();
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" name="select[]" id="manual_entry_'.$item->id.'" class="manual_entry_cb" value="'.$item->id.'" />';
                })->addColumn('total', function ($row) {

                    return  $row->total_price();
                })->addColumn('created_at', function ($row) {

                    return  $row->created_at->diffForHumans();
                })->addColumn('action', function ($row) {
                    $button = '<a href="' . route('orders.show', $row->id) . '" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    $button .= '<a href="' . route('orders.edit', $row->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>';
                    return $button;
                })->rawColumns(['action','status','name','product_name','name','location','quantity','checkbox'])
                ->make(true);
        }
        return  view('admin.order.datatables2', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = '  Add Order  ';
        $page_description = '';
        $products = Product::all();
        return view('admin.order.create', compact('page_title', 'page_description','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $total = 0;
        foreach ($request->check as $product){
            if (array_key_exists('id', $product)){
                $total += $product['total'];
            }
        }
        $sub_total  = $total;
        $shipping = ShippingMethod::find($request->shippingmethod_id);
        $total = $total + $shipping->price;
        $order = new Order();
        $order->fill($request->all());
        $order->total = $total;
        $order->user_id = 0;
        $order->name = $request->firstName.' '.$request->lastName;
        $status = $order->save();;
        $cart = new Cart();
        $cart->order_id = $order->id;
        $cart->user_id = 0;
        $cart->save();
        foreach ($request->check as $product){
            if (array_key_exists('id', $product)){
                $item = new Item();
                $item->product_id = $product['id'];
                $item->qty = $product['qty'] ;
                $item->total = $product['total'];
                $item->price = Product::find($product['id'])->price;
                $item->cart_id  = $cart->id;

                $item->save();
            }
        }
        if ($status) {


            return response()->json([
                'status' => true,
                'type' => 4,
                'message' => 'Order Added Successfully',
                'url'=>route('orders.show',$order->id),
            ]);
        } else {

            return response()->json(['error' => ['error'=>'حدث خطأ ما '],'msg'=>'حدث خطأ ما '], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Model\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $page_title = '  Order Details';
        $page_description = $order->name;
        // dd($order->carts->items[0]->product->ref_id);
        return view('admin.order.show', compact('page_title', 'page_description', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Model\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order, Request $request)
    {
      $page_title = ' Edit Order';
        $page_description = $order->name;
        
        return view('admin.order.catEdit', compact('page_title', 'page_description', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $orderStatus = $order->status;
        $order->fill($request->all());
        if ($request->status != $orderStatus) {
        $notify = new Notification();
        $notify->user_id = $order->user_id;
        $title = 'Order Status Changed';
        $notify->title = $title;
        $notify->sub_title = $title;
        $msg = 'Your Order Status Changed From ' . $orderStatus . ' To ' . $request->status;;
        $notify->message = $msg;
        $notify->save();
            $devices = Device::where('user_id', $order->user_id)->get('player_id');
            $arr = [];
            foreach ($devices as $device) {
                $arr[] = $device->player_id;
            }
        $onesignal = parent::notfiy($msg, $title, $title, $arr,$order->id);

        }

        $status = $order->update();

        if ($status) {


            if ($order->email != null) {
                \Mail::to($order->email)->send(new OrderShipped($order, 'تم تحديث طلبك'));
            }

            return response()->json([
                'status' => true,
                'type' => $type ?? null,
                'message' => 'تم تعديل الطلب بنجاح',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'فشل الحفظ رجاء محاوله مرة أخرى',
            ]);
        }
    }



    public function statusBulk(Request $request)
    {
        $status = $request->status;
        if ($request->select){
            foreach ($request->select as $item) {
                $order = Order::find($item);
                $old = $order->status;
                $order->status = $status;
                $order->update();
                $notify = new Notification();
                $notify->user_id = $order->user_id;
                $title = 'Order Status Changed';
                $notify->title = $title;
                $notify->sub_title = $title;
                $msg = 'Your Order Status Changed From ' . $old . ' To ' . $request->status;;
                $notify->message = $msg;
                $notify->save();
                $devices = Device::where('user_id', $order->user_id)->get('player_id');
                $arr = [];
                foreach ($devices as $device) {
                    $arr[] = $device->player_id;
                }

                $onesignal = parent::notfiy($msg, $title, $title, $arr,$order->id);
            }
        }

       return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, Request $request)
    {
        $order = Order::findorfail($request->id);
        if ($order->orders != null) {
            foreach ($order->orders as $sub) {
//                $sub->delete();
            }


        }
        $order->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حدف الطلب  بنجاح',
            'id' => $request->id,
        ]);
    }


    public function download($type)
    {
        return Excel::download(new OrderExport, 'orders.' . $type);
    }


    public function sendemail(Order $order)
    {
        $status = \Mail::to($order->email)
            ->send(new OrderShipped($order));
        dd($status);
    }


    public function updateBulk(Request $request)
    {
        if (!$request->has('check')) {
            return redirect()->back()->with('error', 'يرجى تحديث عناصر');

        }
        foreach ($request->check as $id) {
            $order = Order::findorfail($id);
            $order->fill($request->all());
            $order->update();
        }
        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاج');

    }

    public function status($id, Request $request)
    {
        $data = [$request->key =>$request->value];

        $order = Order::findorfail($id);

        $order->fill($data);

        $status = $order->update();
        if ($status) {
            return response()->json([
                'status' => true,
                'type' => 3,
                'message' => 'تم تعديل الطلب بنجاح',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'فشل الحفظ رجاء محاوله مرة أخرى',
            ]);

        }
    }

}
