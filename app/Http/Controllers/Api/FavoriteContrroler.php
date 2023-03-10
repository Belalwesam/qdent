<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\App\ProductItemResource;
use App\Http\Resources\Master\Item\MasterResource;
use App\Model\Favorite;
use App\Model\Product;
use Illuminate\Http\Request;

class FavoriteContrroler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id= $request->user()->id;
        $ar =collect();
        $favorite = Favorite::where('user_id',$id)->latest('created_at')->with('product')->get();
        foreach ($favorite as $item){
            if ($item->product != null){
                $ar->push($item->product);

            }

        }
        $favorite = ProductItemResource::collection($ar);
        return parent::json('200',true,'Data received',$favorite); //
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
        $validator = \Validator::make($request->all(), [
            'id' => [ 'required'],

        ]);
        if($validator->fails()){
            return Parent::json('422','false',$validator->messages()->first() ,$validator->messages());
        }
        $id = $request->id;
        $favorite = Favorite::where('user_id',$request->user()->id)->where('product_id',$id)->first();
//        dd($favorite);
        if ($favorite != null){
            return  parent::json('403',false,'This item already exists');
        }
        if (Product::find($id) == null ){
                return  parent::json('404',false,'Item not found');

        }
        $fav = new Favorite();
        $fav->user_id = $request->user()->id;
        $fav->product_id = $id;
        $status = $fav->save();
        if ($status){
            return parent::json('200',true,'Successfully added to favourites');

        }else{
            return parent::json('500',false,'Something went wrong, Please try again');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $favorite = Favorite::where('user_id',$request->user()->id)->where('product_id',$id)->first();
        if($favorite == null){
            return parent::json('403',false,'Item not found in favourites ');

        }
        $favorite->delete();

//        $favorite = FavoriteResource::collection($favorite);
        return parent::json('200',true,'The item has been removed from the favourites successfully');
    }
}
