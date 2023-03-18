<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Sub_Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Sub Categories';
        $page_description = 'Sub Categories table';
        $data = Sub_Category::all();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '  <a href="' . route('subcategory.edit', $data) . '" data-href="' . route('subcategory.edit', $data) . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Edit">
                                                     <i class="fa fa-edit"></i> </a>';

                    $button .= '<a href="javascript:;" data-href="' . route('subcatDelete', $data->id) . '" data-entity_id="' . $data->id . '" data-token="' . csrf_token() . '" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                            <i class="fa fa-trash"></i>
                        </a>';
                    return $button;
                })->addColumn('category', function ($data) {
                    return $data->category->name ?? "Deleted";
                })->addColumn('ProductCount', function ($data) {
                    $button = '(' . $data->products->count() . ') <a href="/admin/product?sub_category_id=' . $data->id . '" data-href="/admin/product?sub_category_id=' . $data->id . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title=" Show All Product">
                     <i class="fa fa-eye"></i>
                        </a>';
                    return $button;
                })
                ->rawColumns(['action', 'category', 'ProductCount'])
                ->make(true);
        }
        return view('admin.sub-category.datatables', compact('page_title', 'page_description'));
    }

    public function get($id)
    {
        $subCategories = Sub_Category::where('category_id', $id)->get();
        return view('admin.sub-category.option', compact('subCategories'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add new SubCategory';
        $page_description = 'Add new SubCategory';
        $categories = Category::all();
        return view('admin.sub-category.create', compact('page_description', 'page_title', 'categories'));
    }

    public function createS($id)
    {
        $page_title = 'Add Category';
        $page_description = 'إدخال التصنيفات سوق';
        $sub_category = Sub_Category::where('category_id', $id)->get();
        $category = Category::find($id);
        return view('admin.sub-category.datatables2', compact('page_title', 'page_description', 'sub_category', 'category'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_categories'
        ]);
        $cat = new Sub_Category();
        $cat->fill($request->all());
        if ($request->has('highlight') && $request->highlight == 'on') {
            $cat->highlight = 1;
        } else {
            $cat->highlight = 0;
        }
        if ($request->has('icon')) {
            $path = $request->file('icon')->store('icon');
            $cat->icon = $path;
        }
        if ($cat->save()) {
            return response()->json([
                'status'  => true,
                'type' => $request->type,
                'message' => 'Added Successfully',
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
     * @param  \App\Haraj\Sub_Category  $sub_Category
     * @return \Illuminate\Http\Response
     */
    public function show(Sub_Category $sub_Category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Haraj\Sub_Category  $sub_Category
     * @return \Illuminate\Http\Response
     */
    public function edit(Sub_Category $sub_Category, $id)
    {
        $sub_Category = Sub_Category::findorfail($id);
        //        dd($sub_Category);
        $categories = Category::all();
        $page_title = 'Edit';
        $page_description = $sub_Category->name;
        return view('admin.sub-category.catEdit', compact('page_title', 'page_description', 'sub_Category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Haraj\Sub_Category  $sub_Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sub_Category $sub_Category)
    {
        // $this->validate($request , [
        //     'name' => 'required|unique:sub_categories,name,'.$sub_Category->id
        // ]);
        $nameCheck = Sub_Category::where('name', $request->name)->first();

        if ($nameCheck) {
            if ($nameCheck->id == $request->id) {
                $sub_Category = Sub_Category::find($request->id);
                $sub_Category->fill($request->all());
                if ($request->has('highlight') && $request->highlight == 'on') {

                    $sub_Category->highlight = 1;
                } else {
                    $sub_Category->highlight = 0;
                }
                if ($request->has('icon')) {
                    $path = $request->file('icon')->store('icon');
                    $sub_Category->icon = $path;
                }
                if ($sub_Category->update()) {
                    return response()->json([
                        'status'  => true,
                        'message' => 'Updated successfully',
                    ]);
                } else {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Saved Fail, Please try again',
                    ], 500);
                }
            } else {
                // Empty data and rules
                $validator = \Validator::make([], []);
                // Add fields and errors
                $validator->errors()->add('name', 'The name is already taken');
                throw new \Illuminate\Validation\ValidationException($validator);
            }
        } else {
            $sub_Category = Sub_Category::find($request->id);
            $sub_Category->fill($request->all());
            if ($request->has('highlight') && $request->highlight == 'on') {

                $sub_Category->highlight = 1;
            } else {
                $sub_Category->highlight = 0;
            }
            if ($request->has('icon')) {
                $path = $request->file('icon')->store('icon');
                $sub_Category->icon = $path;
            }
            if ($sub_Category->update()) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Updated successfully',
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Saved Fail, Please try again     ',
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Haraj\Sub_Category  $sub_Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sub_Category $sub_Category, Request $request)
    {
        $category = Sub_Category::findorfail($request->id);

        $category->delete();
        return response()->json([
            'status'  => true,
            'message' => 'Item was deleted',
            'id'    => $request->id,
        ]);
    }
}
