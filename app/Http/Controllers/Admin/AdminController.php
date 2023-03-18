<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'المدراء';
        $page_description = 'جدول بقائمة المدراء';
        $users = Admin::orderBy('created_at', 'desc')->paginate(15);
        //        dd('asd');
        if ($request->ajax()) {
            if (isset($request->value)) {
                $keyword = $request->value;
                $users = Admin::where(function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('id', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%');
                })->paginate(50);
            }
            return view('admin.admin.table', compact('users'))->render();
        }
        return view('admin.admin.datatables', compact('page_title', 'page_description', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'إضافة مدير';
        $page_description = ' أضافة مسؤول ';
        return view('admin.admin.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['string', 'min:10', 'unique:users'],
            'password' => ['string', 'min:6'],
            'email' => ['string', 'unique:users', 'email'],
        ]);
        $user = new Admin();
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        if ($request->img != null) {
            $path = $request->img->store('Users/imgs');
            $path  =  asset('Heart/storage/app/' . $path);
            $user->img = $path;
        }
        $status =  $user->save();

        if ($status) {
            return response()->json([
                'status'  => true,
                'message' => 'تم اضافة المدير  بنجاح',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'فشل الحفظ رجاء محاوله مرة أخرى',
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
    public function edit(Admin $admin, $id)
    {
        $user = Admin::findorfail($id);
        $page_title = 'تعديل المدير';
        $page_description =  $user->name;
        return view('admin.admin.catEdit', compact('page_title', 'page_description', 'user'));
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
        $validator = Validator::make($request->all(), [
            'phone' => ['string', 'min:10', 'unique:users'],
            'password' => ['string', 'min:6'],
            'email' => ['string', 'unique:users', 'email'],
        ]);
        $user = Admin::findorfail($request->id);
        if ($request->password == null) {
            if ($request->img != null) {
                $path = $request->img->store('Users/imgs');
                $path  =  asset('Heart/storage/app/' . $path);
                $user->img = $path;
            }
            $user->name = $request->name;
            /* $user->phone  = $request->phone; */
            $user->email = $request->email;
            $status =  $user->save();
        } else {
            $user->password = bcrypt($request->password);
            if ($request->img != null) {
                $path = $request->img->store('Users/imgs');
                $path  =  asset('Heart/storage/app/' . $path);
                $user->img = $path;
            }
            $user->name = $request->name;
            /* $user->phone  = $request->phone; */
            $user->email = $request->email;
            $status =  $user->save();
        }
        if ($status) {
            return response()->json([
                'status'  => true,
                'message' => 'تم تعديل المستخدم بنجاح',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'فشل الحفظ رجاء محاوله مرة أخرى',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
    }
}
