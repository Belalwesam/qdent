<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\AttrabiutValue;
use App\Model\Sub_Category;
use App\Model\Sub_Category as Attrabiute;
use App\Model\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AttrabiuteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Aِttrabiute ';
        $page_description = 'Detail Aِttrabiute';
        $data =  AttrabiutValue::latest('id')->get();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '  <a href="'.route('attrabiuteValue.edit',$data).'" data-href="'.route('attrabiuteValue.edit',$data).'" data-entity_id="'.$data->id.'"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Edit">
                                                     <i class="fa fa-edit"></i> </a>';
//                    $button .= ' <a href="'.route('getSub-Attr',$data->id).'" data-href="'.route('getSub-Attr',$data->id).'" data-entity_id="'.$data->id.'"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="اضافة تصنيف فرعي">
//                     <i class="fa fa-plus"></i>
//                        </a>';
                    $button .= '<a href="javascript:;" data-href="'.route('attrabiuteValue.deletes',$data->id).'" data-entity_id="'.$data->id.'" data-token="'.csrf_token().'" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                            <i class="fa fa-trash"></i>
                        </a>';
                    return $button;
                })->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="id[]" class="checkboxes" value="' . $data->id . '" />';

                })->addColumn('sub_category', function ($data) {
                    return $data->sub_category->name ?? '-';
                })->rawColumns(['action','sub_category'])
                ->make(true);
        }

        return view('admin.attrabiute.datatables', compact('page_title', 'page_description'));
    }


    public function get($id,Request $request)
    {
        $attrabiute =  Attrabiute::with('values')->findorfail($id);
        $page_title = 'Add Value for  ';
        $page_description = $attrabiute->name;
        $data = $attrabiute->values;
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '  <a href="' . route('attrabiuteValue.edit', $data) . '" data-href="' . route('attrabiuteValue.edit', $data) . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Edit">
                                                     <i class="fa fa-edit"></i> </a>';

                    $button .= '<a href="javascript:;" data-href="'.route('attrabiuteValue.deletes',$data->id).'" data-entity_id="'.$data->id.'" data-token="'.csrf_token().'" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                            <i class="fa fa-trash"></i>
                        </a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.attrabiute.datatablesAdd', compact('page_title', 'page_description','attrabiute'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add attrabiute ';
        $page_description = ' Add new attrabiute   ';
        $categories = Sub_Category::all();
        return view('admin.attrabiute.create',compact('page_description','page_title','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $cat = new Attrabiute();
        $cat->fill($request->all());
        if($request->has('icon')){
            $path = $request->file('icon')->store('icon');
            $cat->icon = $path;

        }
        if($cat->save()){
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
     * @param  \App\Model\Attrabiute  $attrabiute
     * @return \Illuminate\Http\Response
     */
    public function show(Attrabiute $attrabiute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Attrabiute  $attrabiute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attrabiute $attrabiute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Attrabiute  $attrabiute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attrabiute $attrabiute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Attrabiute  $attrabiute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attrabiute $attrabiute,Request $request)
    {
        $attrabiute = Attrabiute::findorfail($request->id);
        if($attrabiute->values != null) {
            foreach ($attrabiute->values as $sub) {
                $sub->delete();
            }

        }
        if($attrabiute->products != null) {
        foreach ($attrabiute->products as $sub) {
            $sub->delete();
        }

    }
        $attrabiute->delete();
        return response()->json([
            'status'  => true,
            'message' => 'Item Was Deleted',
            'id'    => $request->id,
        ]);
    }
}
