<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TalentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->gallery == null){
            $gallery = [];
        }else{
            $gallery = ImageResource::collection($this->gallery);
        }
        return [
            'id'=>$this->id,
            'name'=>$this->user->name,
            'title'=>$this->name,
            'description'=>$this->description ,
            'gallery'=>$gallery ,

        ];

    }
}
