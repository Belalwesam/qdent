<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_title = 'الصفحات  ';
        $page_description = '';
        $pages =  Page::all();
        return view('admin.page.datatables', compact('page_title', 'page_description','pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = ' انشاء صفحة ';
        $page_description = 'جديدة';
        return view('admin.page.create', compact('page_title', 'page_description'));
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
            'content' => [ 'required'],
            'slug' => [ 'required'],

        ]);
        $slug  = (Str::slug($request->slug));
        if($validator->fails()){
            return response()->json([
                'status'  => false,
                'message' =>$validator->messages()->first()
            ],403);
        }
        $page = new Page();
        $page->slug = $slug;
        $page->fill($request->all());

        if($page->save()){
            return response()->json([
                'status'  => true,
                'message' => 'تم اضافة الصفحة بنجاح',
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
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page,Request $request)
    {
        $page = Page::findorfail($request->id);
        $page_title = 'تعديل الصفحة';
        $page_description = $page->title;
        return view('admin.page.catEdit', compact('page_title', 'page_description','page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $page = Page::findorfail($request->id);
        $slug  = (Str::slug($request->slug));

        $page->fill($request->all());
        $page->slug = $slug;
        if($page->update()){
            return response()->json([
                'status'  => true,
                'message' => 'تم تحديث الصفحة بنجاح',
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
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
