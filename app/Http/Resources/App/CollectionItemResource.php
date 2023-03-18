<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->price_offer != null){
            $percent   = (($this->price - $this->price_offer)*100) /$this->price ;
            $percent = rand($percent,1).'%';
        }else{
            $percent = null;
        }
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'category'=>$this->category->name  ?? null,
            'sub_category'=>$this->sub_category->name  ?? null,
            'stock'=>$this->stock,
            'is_new'=>$this->is_new,
            'is_offer'=>$this->is_offer,
            'offer'=>$percent,
            'price'=>$this->price,
            'price_offer'=>$this->price_offer,
            'img'=>asset('qdent/storage/app/'.$this->images->first()->src ?? ""),
            'created_at'=>$this->created_at,
        ];
    }
}
