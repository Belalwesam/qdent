<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class EventPageResource extends JsonResource
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
            'description'=>$this->description,
            'location'=>$this->location,
            'date'=>$this->date,
            'from'=>$this->from,
            'to'=>$this->to,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'images'=>ImagesItemResource::collection($this->images),
            'created_at'=>$this->created_at,
            'interested'=>InterstedResource::collection($this->interested),
            'interestedCount'=>($this->interested->count() ?? 0),
        ];
    }
}
