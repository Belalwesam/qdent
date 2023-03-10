<?php

namespace App\Http\Resources\App;

use App\Http\Resources\App\Attrabiute\AttrabiuteValueResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'icon'=>asset('qdent/storage/app/'.$this->icon ),
            'attributes'=>AttrabiuteValueResource::collection($this->values),
        ];
    }
}
