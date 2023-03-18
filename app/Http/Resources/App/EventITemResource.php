<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class EventITemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'date' => $this->date,
            'from' => $this->from,
            'to' => $this->to,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'img' => count($this->images) == 0 ? '' : asset('qdent/storage/app/' . $this->images->first()->src),
            'created_at' => $this->created_at,
        ];
    }
}
