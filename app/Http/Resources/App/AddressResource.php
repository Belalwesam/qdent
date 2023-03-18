<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
                'id'=>$this->id,
                'street_address'=>$this->street_address,
                'address_line2'=>$this->address_line2,
                'city'=>$this->city,
                'state'=>$this->state,
                'country'=>$this->country,
                'zip'=>$this->zip,
                'nearby'=>$this->nearby,
                'created_at'=>$this->created_at,
            ];
    }
}
