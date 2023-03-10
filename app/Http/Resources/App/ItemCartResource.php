<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemCartResource extends JsonResource
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
                'product_id' => $this->product_id,
                'product_name' => $this->product->name ?? 'deleted',
                'price' => $this->price ?? 0,
                'product_image' => $this->product->image ?? '',
                'quantity' => $this->quantity,
                'total' => $this->total,

            ];
    }
}
