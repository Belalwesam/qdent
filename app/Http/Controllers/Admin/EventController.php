<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Event;
use App\Model\EventAttendance;
use App\User;
use App\Model\Image;
use App\Model\Product;
use App\Model\MobileToken;
use App\Model\Notification;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = __("ALl Events");
        $page_description = __('view aLl events  ');
        $data = Event::latest('id')->get();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '  <a href="' . route('event.edit', $data) . '" data-href="' . route('event.edit', $data) . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Edit">
                                                     <i class="fa fa-edit"></i> </a>';
                    $button .= '<a href="javascript:;" data-href="'.route('event.delete',$data->id).'" data-entity_id="'.$data->id.'" data-token="'.csrf_token().'" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                            <i class="fa fa-trash"></i>
                        </a>';

                    $button .= '  <a href="' . route('event.interested', $data) . '" class="btn btn-warning" >Interested</a>';

                    return $button;
                })

                ->rawColumns(['action'])
                ->make(true);

        }

        return view('admin.event.datatables', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add new Event");
        $page_description = __('create event');

        return view('admin.event.create', compact('page_title', 'page_description')); //
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
            'description' => [ 'required'],
            'name' => [ 'required'],
            'location' => [ 'required'],
            'date' => [ 'required'],
//            'image' => [ 'required', 'image','mimes:jpeg,png,jpg,gif,svg|max:2048'],

        ]);
        if($validator->fails()){
            return response()->json([
                'status'  => false,
                'message' =>$validator->messages()->first()
            ],403);
        }

        $event = new Event();
        $event->fill($request->all());
        $status = $event->save();
        if($request->has('images')){
            foreach ($request->file('images') as $index=> $img) {
                $path =$img->store('imageS');
                $img = new Image();
                $img->src = $path;
                $img->event_id = $event->id;
                $img->save();
            }
        }

        $users_ids = User::query()->pluck('id');

        foreach ($users_ids as $id){
            $notification = Notification::query()->create([
                'title' => 'حدث جديد',
                'sub_title' => 'حدث جديد',
                'message' => 'تم إضافة حدث جديد',
                'user_id' => $id
            ]);
        }

        $users = MobileToken::query()->whereIn('user_id', $users_ids)->pluck('token')->toArray();

//        dd($users);

        $this->fcmNotification($users, 'حدث جديد', 'حدث جديد', 'تم إضافة حدث جديد');

        if($status){
            return response()->json([
                'status'  => true,
                'message' => 'Added Successfully   ',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'Saved Fail, Please try again     ',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $page_title = 'Edit Event';
        $page_description = $event->name;
        return view('admin.event.catEdit', compact('page_title', 'page_description','event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //

        $event->fill($request->all());
        if ($request->has('preloaded')){
            $imags = Image::where('event_id',$event->id)->get('id')->toArray();
            foreach ($imags as $img){
                if (!in_array($img['id'],$request->preloaded)){
                    Image::where('id',$img['id'])->delete();
                }
            }
        }
        if ($request->has('images')) {
            foreach ($request->file('images') as $index=> $img) {
                $path =$img->store('imageS');
                $img = new Image();
                $img->src = $path;
                $img->event_id = $event->id;
                $img->save();
            }
        }


        $status = $event->update();
        if($status){
            return response()->json([
                'status'  => true,
                'message' => 'Updated Successfully   ',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => 'Saved Fail, Please try again     ',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event ,Request $request)
    {
        //
        $event = Event::find($request->id);
        $event->delete();
        return response()->json([
            'status'  => true,
            'message' => 'Deleted Successfully   ',
            'id'    => $request->id,
            'type'=>3,
        ]);
    }

    public function interested($id)
    {
        $event = Event::query()->find($id);
        $interested = EventAttendance::query()->where('event_id', $id)->pluck('user_id');
        $users = User::query()->whereIn('id', $interested)->get();

        return view('admin.event.interested', compact('users', 'event'));
    }
}
