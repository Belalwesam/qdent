<?php

namespace App\Http\Resources;

use App\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username'=>$this->username,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'img'=>asset('qdent/storage/app/'.$this->img),


        ];
    }
}
