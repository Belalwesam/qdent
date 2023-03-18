<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoreisItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'id'=>$this->id,
                'name'=>$this->name,
                'type'=>$this->type,
                'icon'=>asset('qdent/storage/app/'.$this->icon ),
                'subCategory'=>SubCategoryItemResource::collection($this->sub_categories),
            ]
            ;
    }
}
