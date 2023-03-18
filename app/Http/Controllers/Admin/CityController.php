<?php

namespace App\Http\Controllers\Admin;

use App\Model\City;
use App\Http\Controllers\Controller;
use App\Model\Region;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'إدخال مدينة';
        $page_description = 'This is datatables test page';
        $city = City::all();
        return view('admin.city.datatables', compact('page_title', 'page_description','city'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'إدخال مدن';
        $page_description = 'إدخال مدن ';
        return view('admin.city.create',compact('page_description','page_description'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = new City();
        $cat->fill($request->all());

        if($cat->save()){
            return response()->json([
                'status'  => true,
                'message' => 'تم اضافة المدينة بنجاح',
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
     * @param  \App\admin\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {

        $page_title = 'إدخال منطقة لمدينة';
        $page_description = $city->name;
        $reigons = Region::where('city_id',$city->id)->get();
        return view('admin.region.datatables', compact('page_title', 'page_description','city','reigons'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\admin\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city,Request  $request)
    {
        $page_title = 'تعديل المدن';
        $page_description = $city->name;
        return view('admin.city.catEdit', compact('page_title', 'page_description','city'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\admin\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $city->fill($request->all());
        if($city->save()){
            return response()->json([
                'status'  => true,
                'message' => 'تم تحديث المدينة بنجاح',
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
     * @param  \App\admin\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city,Request $request)
    {
        $city = City::findorfail($request->id);
        if($city->regions != null) {
        foreach ($city->regions as $sub) {
            $sub->delete();
        }

    }
        $city->delete();
        return response()->json([
            'status'  => true,
            'message' => 'تم حدف المدينة  بنجاح',
            'id'    => $request->id,
        ]);
    }

}
