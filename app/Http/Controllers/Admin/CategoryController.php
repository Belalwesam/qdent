<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Haraj\Sub_Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Categories ';
        $page_description = 'Detail Categories';
        $data =  Category::latest('id')->get();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '  <a href="' . route('category.edit', $data) . '" data-href="' . route('category.edit', $data) . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Edit">
                                                     <i class="fa fa-edit"></i> </a>';
                    $button .= ' <a href="' . route('getSub-Cat', $data->id) . '" data-href="' . route('getSub-Cat', $data->id) . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Add sub cateogy  ">
                     <i class="fa fa-plus"></i>
                        </a>';
                    $button .= ' <a href="/admin/product?category_id=' . $data->id . '" data-href="/admin/product?category=' . $data->id . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title=" Show All Product">
                     <i class="fa fa-eye"></i>
                        </a>';
                    $button .= '<a href="javascript:;" data-href="' . route('catDelete', $data->id) . '" data-entity_id="' . $data->id . '" data-token="' . csrf_token() . '" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-trash"></i>
                        </a>';
                    return $button;
                })->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="category_id[]" class="checkboxes" value="' . $data->id . '" />';
                })->addColumn('sub_category', function ($data) {
                    $sub_category = \App\Model\Sub_Category::where('category_id', $data->id)->get();
                    $sub_category_name = '';
                    foreach ($sub_category as $sub_cat) {
                        $sub_category_name .= '<a href="/admin/product?sub_category=' . $sub_cat->id . '">' . $sub_cat->name . '</a>';
                    }
                    return $sub_category_name;
                })->rawColumns(['action', 'checkbox', 'sub_category'])->make(true);
        }

        return view('admin.category.datatables', compact('page_title', 'page_description'));
    }

    public function get($id, Request $request)
    {
        $category =  Category::with('sub_categories')->findorfail($id);
        $page_title = 'Add sub category for  ';
        $page_description = $category->name;
        $data = $category->sub_categories;
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '  <a href="' . route('subcategory.edit', $data) . '" data-href="' . route('subcategory.edit', $data) . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Edit">
                                                     <i class="fa fa-edit"></i> </a>';

                    $button .= '<a href="javascript:;" data-href="' . route('subcatDelete', $data->id) . '" data-entity_id="' . $data->id . '" data-token="' . csrf_token() . '" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                            <i class="fa fa-trash"></i>
                        </a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.category.datatablesAdd', compact('page_title', 'page_description', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Category ';
        $page_description = ' Add new Category   ';
        return view('admin.category.create', compact('page_description', 'page_title'));
    }

    public function get_attrabiute($id)
    {

        $sub =  \App\Model\Sub_Category::with('values')->findorfail($id);
        $attrabiutes = $sub->values;
        //        dd($attrabiutes);
        return view('admin.product.attrabiute', compact('attrabiutes', 'sub'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* throw ValidationException::withMessages(['field_name' => 'This value is incorrect']); */
        $this->validate($request, [
            'name' => 'unique:categories'
        ]);
        $cat = new Category();
        $cat->fill($request->all());
        if ($request->has('icon')) {
            $path = $request->file('icon')->store('icon');
            $cat->icon = $path;
        }
        if ($request->has('highlight') && $request->highlight == 'on') {

            $cat->highlight = 1;
        } else {
            $cat->highlight = 0;
        }
        if ($cat->save()) {
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
     * @param  \App\Haraj\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Haraj\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Request  $request)
    {
        $page_title = 'Edit Category ';
        $page_description = $category->name;
        return view('admin.category.catEdit', compact('page_title', 'page_description', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Haraj\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        /*  $this->validate($request , [
            'name' => 'unique:categories,name,'.$category->id
        ]); */
        $nameCheck = Category::where('name', $request->name)->first();

        if ($nameCheck) {
            if ($nameCheck->id == $request->id) {
                $category = Category::findorfail($request->id);
                $category->fill($request->all());
                if ($request->has('icon')) {
                    $path = $request->file('icon')->store('icon');
                    $category->icon = $path;
                }
                if ($request->has('highlight') && $request->highlight == 'on') {

                    $category->highlight = 1;
                } else {
                    $category->highlight = 0;
                }
                if ($category->update()) {
                    return response()->json([
                        'status'  => true,
                        'message' => 'Updated Successfully',
                    ]);
                } else {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Updated Fail, Please try again     ',
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
            $category = Category::findorfail($request->id);
            $category->fill($request->all());
            if ($request->has('icon')) {
                $path = $request->file('icon')->store('icon');
                $category->icon = $path;
            }
            if ($request->has('highlight') && $request->highlight == 'on') {

                $category->highlight = 1;
            } else {
                $category->highlight = 0;
            }
            if ($category->update()) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Updated Successfully',
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Updated Fail, Please try again     ',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Haraj\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request  $request, $id)

    {
        $category = Category::findorfail($request->id);
        if ($category->sub_categories != null) {
            foreach ($category->sub_categories as $sub) {
                $sub->delete();
            }
        }
        if ($category->products != null) {
            foreach ($category->products as $sub) {
                $sub->delete();
            }
        }
        $category->delete();
        return response()->json([
            'status'  => true,
            'message' => 'Item Was Deleted',
            'id'    => $request->id,
            'type' => 3
        ]);
    }
}
