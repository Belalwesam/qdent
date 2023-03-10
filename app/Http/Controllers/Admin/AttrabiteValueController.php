<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\AttrabiutValue;
use App\Model\Sub_Category;
use Illuminate\Http\Request;

class AttrabiteValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

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
            'name' => 'unique:attrabites_value'
        ]);
        $cat = new AttrabiutValue();
        $cat->fill($request->all());
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
     * @param  \App\Model\AttrabiutValue  $attrabiutValue
     * @return \Illuminate\Http\Response
     */
    public function show(AttrabiutValue $attrabiutValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\AttrabiutValue  $attrabiutValue
     * @return \Illuminate\Http\Response
     */
    public function edit($attrabiutValue)
    {
        //
        $attrabiutValue = AttrabiutValue::find($attrabiutValue);
        $page_title = 'Edit Attribute Value';
        $data = $attrabiutValue;
        $categories = Sub_Category::all();
        return view('admin.attrabiute.catEdit', compact('page_title', 'data', 'categories', 'attrabiutValue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\AttrabiutValue  $attrabiutValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttrabiutValue $attrabiutValue)
    {
        //

        $nameCheck = AttrabiutValue::where('name', $request->name)->first();

        if ($nameCheck) {
            if ($nameCheck->id == $request->id) {
                $attrabiutValue = AttrabiutValue::find($request->id);
                $attrabiutValue->fill($request->all());
                if ($attrabiutValue->update()) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Updated Successfully',
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Updated Fail, Please try again',
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
            $attrabiutValue = AttrabiutValue::find($request->id);
            $attrabiutValue->fill($request->all());
            if ($attrabiutValue->update()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated Successfully',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Updated Fail, Please try again',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\AttrabiutValue  $attrabiutValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttrabiutValue $attrabiutValue, Request $request)
    {
        //
        $attrabiutValue = AttrabiutValue::find($request->id);
        $attrabiutValue->delete();
        return response()->json([
            'status'  => true,
            'message' => 'Item Was Deleted',
            'id'    => $request->id,
            'type' => 3,
        ]);
    }
}
