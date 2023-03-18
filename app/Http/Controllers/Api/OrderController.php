<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\App\OrderItemResource;
use App\Http\Resources\App\OrderResource;
use App\Model\Address;
use App\Model\Cart;
use App\Model\Item;
use App\Model\Order;
use App\Model\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Parent_;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $status = $request->status;
        // get all orders
        if ($status =='current') {
            $orders = Order::where('user_id', $request->user()->id)->where('status', '!=', 'canceled')->where('status','!=','completed');
            if ($request->has('name')) {
                $orders = $orders->whereHas('carts',function ($query) use ($request){
                    $query->whereHas('items',function ($query) use ($request){
                        $query->whereHas('product',function ($query) use ($request){
                            $query->where('name','like','%'.$request->name.'%');
                        });
                    });
                });
            }
        } else {
            $orders = Order::where('user_id', $request->user()->id)->where('status', 'canceled')->orwhere('status','completed');
            if ($request->has('name')) {
                $orders = $orders->whereHas('carts',function ($query) use ($request){
                    $query->whereHas('items',function ($query) use ($request){
                        $query->whereHas('product',function ($query) use ($request){
                            $query->where('name','like','%'.$request->name.'%');
                        });
                    });
                });
            }
        }
        $data = OrderItemResource::collection($orders->latest('id')->paginate(15));
        return parent::json('200',true, 'Received Data',$data);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {




    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'items' => [ 'required'],

        ]);
        if($validator->fails()){
            return Parent::json('422','false',$validator->messages()->first() ,$validator->messages());
        }

        $order = new Order();
        $user = $request->user();
        if ($request->has('address_id') and $request->address_id != null){
            $address = Address::find($request->address_id);
            if  ($address != null){
                $address = $address->toArray();
            }

        }elseif($request->has('address')){
            $address = $request->address;
        }
        // Address
        $order->street_address = $address['street_address'];
        $order->address_line2 = $address['address_line2'];
        $order->city = $address['city'];
        $order->state = $address['state'];
        $order->country = $address['country'];
        $order->zip = $address['zip'];
        $order->nearby = $address['nearby'];
        // end address
        $order->user_id = $user->id ;
        $order->name = $user->name;
        $order->phone = $user->phone;
        $order->shippingmethod_id = $request->shippingmethod_id;

        $order->save();
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->order_id = $order->id;
        $cart->save();
        foreach ($request->items as $item){
            $prodduct = Product::findorfail($item['product_id']);
            $cart_item  = new Item() ;
            $cart_item->product_id = $item['product_id'] ;
            $cart_item->qty = $item['qty'];
            $cart_item->price = $prodduct->price ;
            $cart_item->total = $item['qty'] * $prodduct->price;
            $cart_item->cart_id = $cart->id;
          $cart_item->save();
        }

        $order->total =  Item::where('cart_id',$cart->id)->sum('total');
        $order->update();

        return parent::json('200',true,'  Order Placed successfully ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
        $order = OrderResource::make($order);
        return parent::json('200',true,'  Order get data successfully ',$order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $order)
    {
        //

        $order = Order::findorfail($order);
        if ( $request->status == 'canceled' and $order->status == 'pending'){
            $stauts = $order->status = $request->status;
            $order->update();

        }else{
            return parent::json('422','false','  Order cant canceled, because it is already placed  ');
        }

        if ($stauts){
            return parent::json('200',true,'  Order Status Updated successfully ');
        }else{
            return parent::json('422',false,' Order Status Update Failed ');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
