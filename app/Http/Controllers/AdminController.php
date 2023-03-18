<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'المدراء';
        $page_description = 'جميع المدراء';
        $users = Admin::orderBy('created_at','desc')->paginate(15);
        return view('admin.admin.datatables',compact('page_title','page_description','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'إضافة مدير';
        $page_description = 'جميع المستخدمين';
        return view('admin.admin.create',compact('page_title','page_description'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin =  new Admin();
        $admin->fill($request->all());
        $admin->role = 1;
        $admin->password = bcrypt($request->password);
        $status = $admin->save();
        if($status == true){
            return response()->json([
                'status'  => true,
                'message' => 'تم اضافة المستخدم بنجاح',
            ]);        }else{
            return response()->json([
                'status'  => false,
                'message' => 'فشل التعديل رجاء محاوله مرة أخرى',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin ,Request $request)
    {

        $page_title = 'المدراء';
        $page_description = 'جميع المدراء';
        $admin = Admin::findorfail($request->id);
        return view('admin.admin.catEdit',compact('page_title','page_description','admin'));
    }
    public function account(Request $request)
    {

        $page_title = 'المدراء';
        $page_description = 'جميع المدراء';
        $admin = Admin::findorfail($request->user()->id);
        return view('admin.admin.catEdit',compact('page_title','page_description','admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $user = $admin;
        if(isset($request->password)) {
            $user->password = bcrypt($request->password);
            $status = $user->update();
        }else {
            $status = $user->update($request->all());
        }
        if($status == true){
            return response()->json([
                'status'  => true,
                'message' => 'تم تعديل المستخدم بنجاح',
            ]);        }else{
            return response()->json([
                'status'  => false,
                'message' => 'فشل التعديل رجاء محاوله مرة أخرى',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin,Request $request)
    {
        $admin = Admin::findorfail($request->id);

        $admin->delete();
        return response()->json([
            'status'  => true,
            'message' => 'تم حدف المدير  بنجاح',
            'id'    => $request->id,
        ]);
    }

    public function logout(Request $request) {
        \Auth::logout();
        return redirect('/admin/login');
    }


}
