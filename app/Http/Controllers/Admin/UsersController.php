<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Model\Event;
use App\Model\EventAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd('users');

        $page_title = __("List of Users ");
        $page_description = __("View all Users");
        $data =  User::query();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '  <a href="' . route('user.edit', $data) . '" data-href="' . route('user.edit', $data) . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Edit">
                                                     <i class="fa fa-edit"></i> </a>';


                    $button .= '<a href="javascript:;" data-href="' . route('users.UserDelete', $data->id) . '" data-entity_id="' . $data->id . '" data-token="' . csrf_token() . '" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-trash"></i>
                        </a>';

                    $button .= '  <a href="' . route('users.events', $data) . '" class="btn btn-warning">Events</a>';

                    return $button;
                })->addColumn('order', function ($data) {
                    $button = ' <a href="/admin/orders?user_id=' . $data->id . '" data-href="/admin/orders?user_id=' . $data->id . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title=" Show All Product">
                     <i class="fa fa-eye"></i>' . $data->orders->count() . '</a>';
                    return $button;
                })->addColumn('created_at', function ($data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d');
                })
                ->rawColumns(['action', 'order'])
                ->make(true);
        }
        return view('admin.users.datatables', compact('page_title', 'page_description', 'data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create user form
        $page_title = __("Create User");
        $page_description = __("Create New User");
        return view('admin.users.create', compact('page_title', 'page_description'));
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
        $validator = \Validator::make($request->all(), [
            'phone' => ['numeric', 'min:10', 'unique:users'],
            'password' => ['string', 'min:6'],
            'email' => ['email', 'unique:users', 'email'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->messages()->first()
            ], 403);
        }

        $user = new User();
        $user->name = $request->name;
        $user->phone  = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if ($request->img != null) {
            $path = $request->img->store('Users/imgs');
            $path  =  ($path);
            $user->img = $path;
        }
        $status =  $user->save();
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
    public function edit(User $user)
    {
        // Edit User
        $page_title = __("Edit User");
        $page_description = __("Edit User");
        return view('admin.users.catEdit', compact('page_title', 'page_description', 'user'));
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
        // Update User Form

        $validator = \Validator::make($request->all(), [
            'phone' => ['string', 'min:10', 'unique:users'],
            'password' => ['string', 'min:6'],
            'email' => ['string', 'unique:users', 'email'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->messages()->first()
            ], 403);
        }

        if ($request->password == null) {
            if ($request->img != null) {
                $path = $request->img->store('Users/imgs');
                $path  =  asset('Heart/storage/app/' . $path);
                $user->img = $path;
            }
            $user->name = $request->name;
            $user->phone  = $request->phone;
            $user->email = $request->email;
            $status =  $user->update();
        } else {
            $user->password = bcrypt($request->password);
            if ($request->img != null) {
                $path = $request->img->store('Users/imgs');
                $path  =  asset('Heart/storage/app/' . $path);
                $user->img = $path;
            }
            $user->name = $request->name;
            $user->phone  = $request->phone;
            $user->email = $request->email;
            $status =  $user->update();
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function events($id)
    {
        $user = User::query()->find($id);
        $interested = EventAttendance::query()->where('user_id', $id)->pluck('event_id');
        $events = Event::query()->whereIn('id', $interested)->get();

        return view('admin.users.events', compact('events', 'user'));
    }
}
