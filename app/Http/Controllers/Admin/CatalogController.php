<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Catalog;
use App\Model\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Catalog';
        $page_description = 'Detail Catalog';
        $data =  Catalog::latest('id')->get();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '  <a href="'.route('catalog.edit',$data).'" data-href="'.route('catalog.edit',$data).'" data-entity_id="'.$data->id.'"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Edit">
                                                     <i class="fa fa-edit"></i> </a>';

                    $button .= '<a href="javascript:;" data-href="'.route('catalog.deletes',$data->id).'" data-entity_id="'.$data->id.'" data-token="'.csrf_token().'" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                            <i class="fa fa-trash"></i>
                        </a>';
                    return $button;
                })->editColumn('src', function ($data) {
                    return '<a class="btn btn-sm-secandery" href="' . asset('qdent/storage/app/' . $data->src) . '" width="100px" height="100px"><i class="fa fa-download"></i></a>';
                })
                ->rawColumns(['action','src'])
                ->make(true);
        }

        return view('admin.catalog.datatables', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $page_title = 'Catalog';
       $page_description = 'Add Catalog';

       return view('admin.catalog.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $catalog = new Catalog();
        $catalog->fill($request->all());
        if($request->has('src')){
            $path = $request->file('src')->store('catalog');
            $catalog->src = $path;

        }
        if($catalog->save()){
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
     * @param  \App\Model\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catalog = Catalog::query()->find($id);
        $page_title = 'Catalog';
        $page_description = 'Edit Catalog';
//        dd($catalog);
        return view('admin.catalog.catEdit', compact('page_title', 'page_description', 'catalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $catalog = Catalog::query()->find($id);
        
        $catalog->fill($request->all());
        if ($request->has('src')) {
            $path = $request->file('src')->store('catalog');
            $catalog->src = $path;
        }
        if ($catalog->save()) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog,Request $request)
    {
        //
        $catalog = Catalog::find($request->id);
        if ($catalog->delete()) {
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
