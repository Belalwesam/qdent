<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // check if img is 404 or not

        return
            [
                'id'=>$this->id,
                'username'=>$this->user->name,
                'rate'=>$this->rate,
                'comment'=>$this->comment,
//                'avatar'=>$this->user->img != null ? asset('qdent/storage/app/'.$this->user->img) :  'https://cdn.vectorstock.com/i/1000x1000/00/25/arabic-man-profile-avatar-icon-arab-businessman-vector-19510025.webp',
                'avatar'=> asset('qdent/storage/app/'.$this->user->img),
                'created_at'=>$this->created_at,
            ];
    }
}
