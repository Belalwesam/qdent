<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippinMethodResource extends JsonResource
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
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'status' => $this->status, // 1 = active, 0 = inactive  //
                'days' => $this->days,
                'img' => $this->img != null ? asset('qdent/storage/app/'.$this->img) : null,
            ];
    }
}
