<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
                'name' => '#'.$this->id,
                'price' => $this->total,
                'quantity' => $this->carts->items->sum('quantity'),
                'status' => $this->status,
                'payment_status' => $this->payment_status,
                'total' => $this->total_price(),
                'username' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'street_address' => $this->street_address,
                'city' => $this->city,
                'country' => $this->country,
                'address_line_2' => $this->address_line2,
                'zip_code' => $this->zip,
                'shipping_method_id' => $this->shipping_method_id,
                'shipping_method' => $this->shipping_method->name ?? '',
                'items' => $this->carts->items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'name' => $item->product->name ?? '',
                        'price' => $item->price ,
                        'quantity' => $item->quantity,
                        'image' => $item->product != null  ? asset('qdent/storage/app/'.$item->product->images->first()->src) : null,
                        'total' => $item->total,
                    ];
                }),
                'created_at' => $this->created_at->diffForHumans(),
            ];
    }
}
