<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\lessons;
use App\Http\Controllers\Controller;
use App\User;
use Response;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'الطالبات';
        $page_description = 'جدول بقائمة الطالبات';
        $users = User::orderBy('id','desc')->paginate(15);
        if($request->ajax())
        {
            if (isset($request->value)){
                $keyword = $request->value;
               $users= User::where(function ($query) use($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('id', 'like', '%' . $keyword . '%')
                        ->orWhere('phone', 'like', '%' . $keyword . '%');
                })->where('type',1)
                    ->paginate(50);
            }
            return view('admin.user.table', compact('users'))->render();

        }
        return view('admin.user.datatables', compact('page_title', 'page_description','users'));

    }

    public function search( $value = null,Request $request){



    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'إضافة طالبة';
        $page_description = ' جديدة ';
        return view('admin.user.create', compact('page_title', 'page_description'));

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
            'username' => [ 'string','unique:users'],
            'password' => [ 'string','min:6'],
            'name' => [ 'required'],
        ]);
        $user = new User();
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        if ($request->img != null){
            $path = $request->img->store('Users/imgs');
            $path  =  asset('Heart/storage/app/' . $path);
            $user->img = $path;
        }
        $status =  $user->save();

        if($status){
            return response()->json([
                'status'  => true,
                'message' => 'تم اضافة العميل  بنجاح',
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,$id)
    {
        $user = User::findorfail($id);
        $page_title = 'تعديل الطالبة';
        $page_description =  $user->name;
        return view('admin.user.catEdit', compact('page_title', 'page_description','user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'username' => [ 'string','unique:users'],
            'password' => [ 'string','min:6'],
        ]);
        if ($request->password == null){
            if ($request->img != null){
                $path = $request->img->store('Users/imgs');
                $path  =  asset('Heart/storage/app/' . $path);
                $user->img = $path;
            }
            $user->name = $request->name;
            $user->phone  = $request->phone;
            $status =  $user->update();

        }else{
            $user->password = bcrypt($request->password);
            if ($request->img != null){
                $path = $request->img->store('Users/imgs');
                $path  =  asset('Heart/storage/app/' . $path);
                $user->img = $path;
            }
            $user->name = $request->name;
            $user->phone  = $request->phone;
            $user->email = $request->email;
           $status =  $user->update();
        }
        if($status){
            return response()->json([
                'status'  => true,
                'message' => 'تم تعديل المستخدم بنجاح',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'فشل الحفظ رجاء محاوله مرة أخرى',
            ]);
        }
    }


    public function userOrders(User $user,$id,Request $request){
        $orders = Order::where('user_id',$id)->orderBy('created_at','desc')->paginate(15);
        $user = User::findorfail($id);
        $page_title = 'كل الطلبات';
//        dd($user);
        $page_description = '   الطلبات لعميل '.$user->name;
        if($request->ajax())
        {
            return view('admin.order.table', compact('orders'))->render();
        }
        return  view('admin.order.datatables',compact('page_description','page_title','orders'));
    }


    public function userLessons(User $user,$id,Request $request){
        $lessons = lessons::where('user_id',$id)->get();
        $user = User::findorfail($id);

        $page_title = 'كل الدروس';
        $page_description = 'الدروس   للطالب'.$user->name;
        $lessons =  lessons::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(15);
        if($request->ajax())
        {
            return view('edu.lessons.table', compact('lessons'))->render();
        }
        return view('edu.lessons.datatables', compact('page_title', 'page_description','lessons'));
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,$id ,Request $request)
    {
        $status = User::destroy($request->id);
//        $category->delete();
        return response()->json([
            'status'  => true,
            'message' => 'تم حدف الشرط  بنجاح',
            'id'    => $request->id,
        ]);
    }


    public function download($type = 1)
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=users.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];

        if($type == 1 ) {
            $list = User::where('type',1)->get()->toArray();
        }elseif ($type == 2){
            $list = User::where('type',2)->with('car')->get()->toArray();

        }else{
            $list = User::where('type',3)->with('Teacher')->get()->toArray();

        }
        foreach ($list as $l){

        }
//        dd(            $list = User::where('type',2)->with('car')->take(15)->get());
        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function() use ($list)
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers); //use Illuminate\Support\Facades\Response;

    }
}
