<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class InterstedResource extends JsonResource
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
            'username'=>@$this->user->name,
            'avatar'=>@$this->user->icon != null ? asset('qdent/storage/app/'.@$this->user->icon) :  'https://cdn.vectorstock.com/i/1000x1000/00/25/arabic-man-profile-avatar-icon-arab-businessman-vector-19510025.webp',
            'created_at'=>$this->created_at,
        ];
    }
}
