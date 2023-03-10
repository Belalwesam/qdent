<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\City;
use App\Model\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = new Region();
        $cat->fill($request->all());

        if($cat->save()){
            return response()->json([
                'status'  => true,
                'type'=>$request->type,
                'message' => 'تم اضافة المنطقة بنجاح',
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
     * @param  \App\Model\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region,Request $request)
    {
        $region = Region::findorfail($request->id);
        $page_title = 'تعديل المنطقة';
        $page_description = $region->name;
        $cities = City::all();
        return view('admin.region.catEdit', compact('page_title', 'page_description','region','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $region->fill($request->all());
        if($region->save()){
            return response()->json([
                'status'  => true,
                'message' => 'تم تحديث المنطقة بنجاح',
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
     * @param  \App\Model\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region ,Request $request)
    {
        $region = Region::findorfail($request->id);
        if($region->sub_categories != null) {
            foreach ($region->sub_categories as $sub) {
                $sub->delete();
            }

        }  if($region->products != null) {
        foreach ($region->products as $sub) {
            $sub->delete();
        }

    }
        $region->delete();
        return response()->json([
            'status'  => true,
            'message' => 'تم حدف المنطقة  بنجاح',
            'id'    => $request->id,
        ]);
    }


}
