<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Feed;
use App\Model\Image;
use App\Model\Product;
use App\Model\Sub_Category;
use App\Model\MobileToken;
use App\Model\Notification;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $page_title = __("ALl Fees");
        $page_description = __(' view all feeds ');
        $data = Feed::latest('id')->get();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '  <a href="' . route('feed.edit', $data) . '" data-href="' . route('feed.edit', $data) . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Edit">
                                                     <i class="fa fa-edit"></i> </a>';
                    $button .= '<a href="javascript:;" data-href="' . route('feed.delete', $data->id) . '" data-entity_id="' . $data->id . '" data-token="' . csrf_token() . '" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                            <i class="fa fa-trash"></i>
                        </a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.feed.datatables', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add new Feed");
        $page_description = __('create feed');
        return view('admin.feed.create', compact('page_title', 'page_description'));
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
            'text' => ['required'],
            'name' => ['required', 'unique:feeds'],
            //'image' => [ 'required', 'image','mimes:jpeg,png,jpg,gif,svg|max:2048'],

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->messages()->first()
            ], 403);
        }

        $feed = new Feed();
        $feed->fill($request->all());
        if ($request->has('is_ads') and $request->is_ads == 'on') {
            $feed->is_ads = 1;
        } else {
            $feed->is_ads = 0;
        }
        $status = $feed->save();
        if ($request->has('images')) {
            foreach ($request->file('images') as $index => $img) {
                $path = $img->store('imageS');
                $img = new Image();
                $img->src = $path;
                $img->feed_id = $feed->id;
                $img->save();
            }
        }

        $users_ids = User::query()->pluck('id');

        foreach ($users_ids as $id) {
            $notification = Notification::query()->create([
                'title' => 'تغذية جديد',
                'sub_title' => 'تغذية جديد',
                'message' => 'تم إضافة تغذية جديد',
                'user_id' => $id
            ]);
        }

        $users = MobileToken::query()->whereIn('user_id', $users_ids)->pluck('token')->toArray();

        $this->fcmNotification($users, 'تغذية جديد', 'تغذية جديد', 'تم إضافة تغذية جديد');

        if ($status) {
            return response()->json([
                'status'  => true,
                'message' => 'Added Successfully   ',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Saved Fail, Please try again     ',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function show(Feed $feed)
    {
        //
        $page_title = __("Feed");
        $page_description = __('view feed');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(Feed $feed)
    {
        //
        $page_title = __("Edit Feed");
        $page_description = __('edit feed');
        return view('admin.feed.catEdit', compact('page_title', 'page_description', 'feed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feed $feed)
    {
        //
        $validator = \Validator::make($request->all(), [
            'text' => ['required'],
            'name' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->messages()->first()
            ], 403);
        }

        // unique name evalidation start here
        $nameCheck = Feed::where('name', $request->name)->first();

        if ($nameCheck) {
            if ($nameCheck->id == $request->id) {
                $feed->fill($request->all());
                if ($request->has('is_ads') && $request->is_ads == "on") {
                    $feed->is_ads = 1;
                } else {
                    $feed->is_ads = 0;
                }
                if ($request->has('preloaded')) {
                    $imags = Image::where('feed_id', $feed->id)->get('id')->toArray();
                    foreach ($imags as $img) {
                        if (!in_array($img['id'], $request->preloaded)) {
                            Image::where('id', $img['id'])->delete();
                        }
                    }
                }
                if ($request->has('images')) {
                    foreach ($request->file('images') as $index => $img) {
                        $path = $img->store('imageS');
                        $img = new Image();
                        $img->src = $path;
                        $img->feed_id = $feed->id;
                        $img->save();
                    }
                }
                $status = $feed->update();
                if ($status) {
                    return response()->json([
                        'status'  => true,
                        'message' => 'Updated Successfully   ',
                    ]);
                } else {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Saved Fail, Please try again     ',
                    ]);
                }
            } else {
                // Empty data and rules
                $validator = \Validator::make([], []);

                // Add fields and errors
                $validator->errors()->add('name', 'The name is already taken');

                throw new \Illuminate\Validation\ValidationException($validator);
            }
        } else {
            $feed->fill($request->all());
            if ($request->has('is_ads') && $request->is_ads == "on") {
                $feed->is_ads = 1;
            } else {
                $feed->is_ads = 0;
            }
            if ($request->has('preloaded')) {
                $imags = Image::where('feed_id', $feed->id)->get('id')->toArray();
                foreach ($imags as $img) {
                    if (!in_array($img['id'], $request->preloaded)) {
                        Image::where('id', $img['id'])->delete();
                    }
                }
            }
            if ($request->has('images')) {
                foreach ($request->file('images') as $index => $img) {
                    $path = $img->store('imageS');
                    $img = new Image();
                    $img->src = $path;
                    $img->feed_id = $feed->id;
                    $img->save();
                }
            }
            $status = $feed->update();
            if ($status) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Updated Successfully   ',
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Saved Fail, Please try again     ',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feed $feed, Request $request)
    {
        //
        $feed = Feed::find($request->id);
        $status = $feed->delete();
        if ($status) {
            return response()->json([
                'status'  => true,
                'message' => 'Deleted Successfully   ',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Saved Fail, Please try again     ',
            ]);
        }
    }
}
