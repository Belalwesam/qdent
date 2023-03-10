<?php

namespace App\Http\Resources\App\Attrabiute;

use Illuminate\Http\Resources\Json\JsonResource;

class AttrabiuteValueResource extends JsonResource
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
                'attrabiute_id' => $this->attrabiute_id,
                'name' => $this->name,
            ];
    }
}
