<?php

namespace App\Http\Resources\App\Attrabiute;

use Illuminate\Http\Resources\Json\JsonResource;

class AttrabiuteResource extends JsonResource
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
                'data' => AttrabiuteValueResource::collection($this->values),
            ];
    }
}
