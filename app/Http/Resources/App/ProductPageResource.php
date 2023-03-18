<?php

namespace App\Http\Resources\App;

use App\Model\Favorite;
use App\Model\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        dd($this->brands);
        $is_favorite = false;
        $fav = Favorite::where('product_id',$this->id)->where('user_id',$request->user()->id ?? null)->first();
//        dd($fav);
        if($fav != null){
            $is_favorite = true;
        }

        if ($this->price_offer != null){
            $percent = (($this->price - $this->price_offer)*100) /$this->price ;
            $percent = rand($percent,2);

            $percent .= '% OFF';

        }else{
            $percent = $this->price_offer;
        }
        // get similar products
        $similar_products = Product::where('category_id',$this->category_id)->where('id','!=',$this->id)->get();
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'category'=>$this->category->name  ?? null,
            'sub_category'=>$this->sub_category->name  ?? null,
            'stock'=>$this->stock,
            'is_new'=>$this->is_new,
            'is_offer'=>$this->is_offer,
            'price'=>$this->price,
            'video'=>$this->video,
            'rate'=>$this->rates->avg('rate') ?? 0,
            'rate_count'=>$this->rates->count() ?? 0,
            'price_offer'=>$this->price_offer,
            'percent_offer'=>$percent,
            'is_favorite'=>$is_favorite,
            'brand'=>$this->brands->name ?? null,
            'brand_img'=>$this->brands != null ? $this->brands->img() :  null,
            'barcode'=>$this->barcode,
            'images'=>ImagesItemResource::collection($this->images),
            'created_at'=>$this->created_at,
            'reviews'=>RateResource::collection($this->rates),
            'similar_product'=>ProductItemResource::collection($similar_products),
        ];
    }
}
