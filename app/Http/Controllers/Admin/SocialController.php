<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'تواصل الاجتماعي   ';
        $page_description = 'اضافة ايقونة تواصل اجتماعي  ';
        $socials =  Social::all();
        return view('admin.social.datatables', compact('page_title', 'page_description','socials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = ' أضف ايقونة جديد  ';
        $page_description = '   ';
        return view('admin.social.create', compact('page_title', 'page_description'));
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
            'url' => [ 'required'],
            'name' => [ 'required'],
            'img' => [ 'required','image','mimes:jpeg,png,jpg,gif,svg|max:2048'],

        ]);
        if($validator->fails()){
            return response()->json([
                'status'  => false,
                'message' =>$validator->messages()->first()
            ],403);
        }
        $social = new Social();
        $social->fill($request->all());
        if($request->has('icon')){
            $path = $request->file('icon')->store('icon');
            $social->icon = $path;

        }
        if($social->save()){
            return response()->json([
                'status'  => true,
                'message' => 'تم اضافة الموقع بنجاح',
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
     * @param  \App\Model\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show(Social $social,Request $request)
    {
        $social = Social::findorfail($request->id);
        $page_title = 'تعديل الموقع';
        $page_description = $social->name;
        return view('admin.social.catEdit', compact('page_title', 'page_description','social'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function edit(Social $social,Request $request)
    {
        $social = Social::findorfail($request->id);
        $page_title = 'تعديل الموقع';
        $page_description = $social->name;
        return view('admin.slider.catEdit', compact('page_title', 'page_description','social'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social $social)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social $social,Request $request)
    {
        $social = Social::findorfail($request->id);


        $social->delete();
        return response()->json([
            'status'  => true,
            'message' => 'تم حدف الموقع  بنجاح',
            'id'    => $request->id,
        ]);
    }
}
