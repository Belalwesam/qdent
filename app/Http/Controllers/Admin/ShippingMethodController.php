<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\ShippingMethod;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Categories ';
        $page_description = 'Detail Categories';
        $data =  ShippingMethod::latest('id')->get();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '  <a href="'.route('shippingmethod.edit',$data).'" data-href="'.route('shippingmethod.edit',$data).'" data-entity_id="'.$data->id.'"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Edit">
                                                     <i class="fa fa-edit"></i> </a>';

                    $button .= '<a href="javascript:;" data-href="'.route('shippingmethod.deletes',$data->id).'" data-entity_id="'.$data->id.'" data-token="'.csrf_token().'" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-trash"></i>
                        </a>';
                    return $button;

                })->rawColumns(['action'])->make(true);

        }

        return view('admin.shippingmethod.datatables', compact('page_title', 'page_description'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Shipping Method';
        $page_description = 'Add Shipping Method';
        return view('admin.shippingmethod.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'days' => 'required',
        ]);

        $shippingMethod = ShippingMethod::create($request->all());
        if($request->has('img')){
            $path = $request->file('img')->store('ShippimngMethod');
            $shippingMethod->img = $path;
            $shippingMethod->save();
        }

        if ($shippingMethod) {
            return response()->json([
                'status'  => true,
                'message' => 'Added Successfully   ',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'Saved Fail, Please try again     ',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ShippingMethod  $shippingMethod
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingMethod $shippingMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ShippingMethod  $shippingMethod
     * @return \Illuminate\Http\Response
     */
    public function edit( $shippingMethod)
    {
        //
        $shippingMethod = ShippingMethod::find($shippingMethod);
        $page_title = 'Shipping Method';
        $page_description = 'Edit Shipping Method';
        return view('admin.shippingmethod.catEdit', compact('page_title', 'page_description','shippingMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ShippingMethod  $shippingMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingMethod $shippingMethod)
    {
        //
        $validator = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'days' => 'required',
        ]);
        $shippingMethod = ShippingMethod::find($request->id);
        $shippingMethod->fill($request->all());
        if ($request->has('status') and $request->status == 'on') {
            $shippingMethod->status = 1;
        }else{
            $shippingMethod->status = 0;
        }
        if($request->has('img')){
            $path = $request->file('img')->store('ShippimngMethod');
            $shippingMethod->img = $path;

        }
        $status = $shippingMethod->update();
        if ($status) {
            return response()->json([
                'status'  => true,
                'message' => 'Updated Successfully   ',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'Updated Fail, Please try again     ',
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ShippingMethod  $shippingMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingMethod $shippingMethod,Request $request)
    {
        //
        $shippingMethod = ShippingMethod::find($request->id);
        $status = $shippingMethod->delete();
        if ($status) {
            return response()->json([
                'status'  => true,
                'message' => 'Deleted Successfully   ',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'Deleted Fail, Please try again     ',
            ]);
        }
    }
}
