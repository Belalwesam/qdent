<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = ' Brands';
        $page_description = 'List of all brands';
        $brands =  Brand::all();
        return view('admin.brand.datatables', compact('page_title', 'page_description','brands'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = '  Create Brand';
        $page_description = '   Create new brand';
        return view('admin.brand.create', compact('page_title', 'page_description'));
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
            'name' => [ 'required'],
            'icon' => [ 'required'],

        ]);
        if($validator->fails()){
            return response()->json([
                'status'  => false,
                'message' =>$validator->messages()->first()
            ],403);
        }
        $brand = new Brand();
        $brand->fill($request->all());
        if($request->has('icon')){
            $path = $request->file('icon')->store('icon');
            $brand->img = $path;

        }
        if($brand->save()){
            return response()->json([
                'status'  => true,
                'message' => 'Brand created successfully',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => '     Could not create brand',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand,Request $request)
    {
        $brand = Brand::findorfail($request->id);
        $page_title = ' Edit Brand';
        $page_description = $brand->name;
        return view('admin.brand.catEdit', compact('page_title', 'page_description','brand'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $brand = Brand::findorfail($request->id);
        $brand->fill($request->all());
        if($request->has('icon')){
            $path = $request->file('icon')->store('icon');
            $brand->img = $path;

        }

        if($brand->update()){
            return response()->json([
                'status'  => true,
                'message' => '   Brand updated successfully',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => '     Could not update brand',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand,Request $request)
    {
        $brand = Brand::findorfail($request->id);
        if($brand->sub_categories != null) {
            foreach ($brand->sub_categories as $sub) {
                $sub->delete();
            }

        }  if($brand->products != null) {
        foreach ($brand->products as $sub) {
            $sub->delete();
        }

    }
        $brand->delete();
        return response()->json([
            'status'  => true,
            'message' => '    Brand deleted successfully',
            'id'    => $request->id,
            'type'    => 3
        ]);
    }
}
