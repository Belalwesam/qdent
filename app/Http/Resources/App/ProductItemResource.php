<?php

namespace App\Http\Resources\App;

use App\Model\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
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

        return
            [
                'id'=>$this->id,
                'name'=>$this->name,
                'description'=>$this->description,
                'category'=>$this->category->name  ?? null,
                'category_id'=>$this->category->id  ?? null,
                'category_Type'=>$this->category->type  ?? null,
                'sub_category'=>$this->sub_category->name  ?? null,
                'sub_category_id'=>$this->sub_category->id  ?? null,
                'stock'=>$this->stock,
                'is_new'=>$this->is_new,
                'is_offer'=>$this->is_offer,
                'price'=>$this->price,
                'rate'=>4,
                'video'=>$this->video,
                'percent_offer'=>$percent,
                'price_offer'=>$this->price_offer,
                'img'=>$this->images->first() ? asset('qdent/storage/app/'.$this->images->first()->src) : null,
                'created_at'=>$this->created_at,
                'is_favorite'=>$is_favorite,
            ];
    }
}
