<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class CatalogResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'src' => asset('qdent/storage/app/'.$this->src),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
