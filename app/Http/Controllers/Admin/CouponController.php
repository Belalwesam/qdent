<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'كوبونات الخصم ';
        $page_description = '';
        $coupons =  Coupon::all();
        return view('admin.coupon.datatables', compact('page_title', 'page_description','coupons'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = ' انشاء كوبونات الخصم ';
        $page_description = 'جديد';
        return view('admin.coupon.create', compact('page_title', 'page_description'));

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
            'title' => [ 'required'],
            'code' => [ 'required'],
            'value' => [ 'required'],

        ]);
        if($validator->fails()){
            return response()->json([
                'status'  => false,
                'message' =>$validator->messages()->first()
            ],403);
        }
        $coupon = new coupon();
        $coupon->fill($request->all());
        if($request->has('icon')){
            $path = $request->file('icon')->store('icon');
            $brand->icon = $path;

        }
        if($coupon->save()){
            return response()->json([
                'status'  => true,
                'message' => 'تم اضافة الكوبون بنجاح',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'فشل الحفظ رجاء محاوله مرة أخرى',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon,Request $request)
    {
        $coupon = Coupon::findorfail($request->id);
        $page_title = 'تعديل الكوبون';
        $page_description = $coupon->name;
        return view('admin.coupon.catEdit', compact('page_title', 'page_description','coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $coupon = Coupon::findorfail($request->id);
        $coupon->fill($request->all());

        if($coupon->update()){
            return response()->json([
                'status'  => true,
                'message' => 'تم تحديث الكوبون بنجاح',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'فشل النعديل رجاء محاوله مرة أخرى',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon,Request $request)
    {
        $coupon = Coupon::findorfail($request->id);


        $coupon->delete();
        return response()->json([
            'status'  => true,
            'message' => 'تم حدف الكوبون  بنجاح',
            'id'    => $request->id,
        ]);

    }
}
