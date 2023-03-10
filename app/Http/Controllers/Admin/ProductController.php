<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Carbon\Carbon;
use App\Model\User;
use App\Model\Brand;
use App\Model\Image;
use Image as ImageS;
use App\Model\Product;
use App\Model\Category;
use App\Model\Attrabiute;
use App\Model\MobileToken;
use App\Model\Notification;
use App\Model\Sub_Category;
use App\Exports\OrderExport;
use Illuminate\Http\Request;
use App\Model\AttrabiutValue;
use App\Exports\ProductExport;
use App\Model\ProductAttrabiute;
use App\Models\ProductAttrabuit;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $status = null)
    {
        $page_title = __("ALl Products");
        $page_description = __(' ALl Products ');
        if ($request->has('category_id')) {
            $category_id = $request->category_id;
            $data = Product::where('category_id', $category_id);
            $category = Category::find($category_id);
            $page_title = __("ALl Products of ") . $category->name;
            $page_description = __("ALl Products of ") . $category->name;
        } elseif ($request->has('sub_category_id')) {
            $sub_category_id = $request->sub_category_id;
            $data = Product::where('sub_category_id', $sub_category_id);
            $sub_category = Sub_Category::find($sub_category_id);
            $page_title = __("ALl Products of ") . $sub_category->name;
            $page_description = __("ALl Products of ") . $sub_category->name;
        } else {
            $data = Product::query();
        }
        if ($request->ajax()) {
            $data = $data->orderBy('id', 'desc')->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '  <a href="' . route('product.edit', $data) . '" data-href="' . route('product.edit', $data) . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Edit">
                                                     <i class="fa fa-edit"></i> </a>';
                    $button .= '<a href="javascript:;" data-href="' . route('product.delete', $data->id) . '" data-entity_id="' . $data->id . '" data-token="' . csrf_token() . '" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                            <i class="fa fa-trash"></i>
                        </a>';
                    return $button;
                })->addColumn('category', function ($data) {
                    return $data->category->name ?? "Deleted";
                })->addColumn('status', function ($data) {
                    return $data->status();
                })
                ->rawColumns(['action', 'category', 'status'])
                ->make(true);
        }

        return view('admin.product.datatables', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add new Product");
        $page_description = __('create product');
        $categories = Category::all();
        $subCategories = Sub_Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('page_title', 'page_description', 'categories', 'brands', 'subCategories',));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => ['required'],
            'name' => ['required', 'unique:products'],
            'ref_id' => ['required', 'unique:products'],
            'price' => ['required'],
            'category_id' => ['required'],
            //            'image' => [ 'required', 'image','mimes:jpeg,png,jpg,gif,svg|max:2048'],

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first()
            ], 403);
        }

        $product = new Product();
        $product->fill($request->all());
        if ($request->has('is_new') and $request->is_new == "on") {
            $product->is_new = 1;
        }
        if ($request->has('is_offer') and $request->is_offer == "on") {
            $product->is_offer = 1;
        }
        $status = $product->save();
        if ($request->has('preloaded')) {
            $imags = Image::where('product_id', $product->id)->get('id')->toArray();
            foreach ($imags as $img) {
                if (!in_array($img['id'], $request->preloaded)) {
                    Image::where('id', $img['id'])->delete();
                }
            }
        }
        if ($request->has('images')) {
            foreach ($request->file('images') as $index => $img) {
                $path = $img->store('imageS');

                // decrese image size and quality

                //                $image = Image::make(('swipy/storage/app/ImageS'.$path));
                //                $image->resize(300, null, function ($constraint) {
                //                    $constraint->aspectRatio();
                //                });
                //                $image->save();

                $img = new Image();
                $img->src = $path;
                $img->product_id = $product->id;
                $img->save();
            }
        }

        if ($request->has('attr')) {
            foreach ($request->attr as $key1 => $attr) {
                foreach ($attr as $key => $value) {
                    $attrabiute = new ProductAttrabiute();
                    $attrabiute->product_id = $product->id;
                    $attrabiute->attribute_id = $key1;
                    $attrabiute->attribute_value_id = $key;
                    $attrabiute->save();
                }
            }
        }

        $users_ids = User::query()->pluck('id');

        foreach ($users_ids as $id) {
            $notification = Notification::query()->create([
                'title' => 'منتج جديد',
                'sub_title' => 'منتج جديد',
                'message' => 'تم إضافة منتج جديد',
                'user_id' => $id
            ]);
        }

        $users = MobileToken::query()->whereIn('user_id', $users_ids)->pluck('token')->toArray();

        $this->fcmNotification($users, 'منتج جديد', 'منتج جديد', 'تم إضافة منتج جديد');

        if ($status) {
            return response()->json([
                'status' => true,
                'message' => 'Added Successfully   ',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Saved Fail, Please try again     ',
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param \App\Model\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Request $request)
    {
        $product = Product::findorfail($request->id);
        $page_title = 'Product Details';
        $page_description = $product->name;
        return view('admin.product.catEdit', compact('page_title', 'page_description', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Model\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Request $request)
    {
        $page_title = ' Edit Product';
        $page_description = $product->name;
        $categories = Category::all();
        $subCategories = Sub_Category::where('category_id', $product->category_id)->get();
        $brands = Brand::all();
        //        $category_attr = Attrabiute::query()->where('category_id', $product->category_id)->get();
        $sub = \App\Model\Sub_Category::with('values')->findorfail($product->sub_category_id);
        $category_attr = $sub->values;

        return view('admin.product.catEdit', compact('page_title', 'page_description', 'product', 'brands', 'categories', 'subCategories', 'category_attr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'description' => ['required'],
            'name' => ['required'],
            'price' => ['required'],
            'category_id' => ['required'],

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first()
            ], 403);
        }

        //unique name and ignore start from here
        $nameCheck = Product::where('name', $request->name)->first();
        if ($nameCheck) {
            if ($nameCheck->id == $request->id) {
                if ($request->has('preloaded')) {
                    $imags = Image::where('product_id', $product->id)->get('id')->toArray();
                    foreach ($imags as $img) {
                        if (!in_array($img['id'], $request->preloaded)) {
                            Image::where('id', $img['id'])->delete();
                        }
                    }
                }
                $product->fill($request->all());
                if ($request->has('is_new') and $request->is_new == "on") {
                    $product->is_new = 1;
                }
                if ($request->has('is_offer') and $request->is_offer == "on") {
                    $product->is_offer = 1;
                }

                $status = $product->update();
                if ($request->has('images')) {
                    foreach ($request->file('images') as $index => $img) {

                        // reduce image before upload
                        $path = $img->store('img');
                        $img = new Image();
                        $img->src = $path;
                        $img->product_id = $product->id;
                        $img->save();
                        $type = 3;
                    }
                }
                if ($status) {
                    return response()->json([
                        'status' => true,
                        'type' => $type ?? null,
                        'message' => 'Updated Successfully',
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Saved Fail, Please try again',
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
            if ($request->has('preloaded')) {
                $imags = Image::where('product_id', $product->id)->get('id')->toArray();
                foreach ($imags as $img) {
                    if (!in_array($img['id'], $request->preloaded)) {
                        Image::where('id', $img['id'])->delete();
                    }
                }
            }
            $product->fill($request->all());
            if ($request->has('is_new') and $request->is_new == "on") {
                $product->is_new = 1;
            }
            if ($request->has('is_offer') and $request->is_offer == "on") {
                $product->is_offer = 1;
            }
            $status = $product->update();
            if ($request->has('images')) {
                foreach ($request->file('images') as $index => $img) {
                    // reduce image before upload
                    $path = $img->store('img');
                    $img = new Image();
                    $img->src = $path;
                    $img->product_id = $product->id;
                    $img->save();
                    $type = 3;
                }
            }
            if ($status) {
                return response()->json([
                    'status' => true,
                    'type' => $type ?? null,
                    'message' => 'Updated Successfully',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Saved Fail, Please try again',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {
        $product = Product::findorfail($request->id);
        if ($product->orders != null) {
            foreach ($product->orders as $sub) {
                //                $sub->delete();
            }
        }
        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfully   ',
            'id' => $request->id,
            'type' => 3,
        ]);
    }


    public function deleteImg($id)
    {
        $img = Image::find($id);
        $img->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حدف الصورة  بنجاح',
            'id' => $id
        ]);
    }


    public function download($type)
    {

        $date = '2018-06-15 11:54:07';
        return Excel::download(new ProductExport, 'products.' . $type);
    }

    public function getSub_attrabiute($id)
    {
        $attrabiutes = AttrabiutValue::where('attribute_id', $id)->get();
        //        dd($attrabiutes);
        return view('admin.product.attrabiute', compact('attrabiutes'))->render();
    }
}
