<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $cart = $this->carts->items;
        $img_path = null;
        if ($cart){
            foreach ($cart as $item) {
               if ($item->product) {


                   $img = $item->product->images;
                   if ($img) {
                       $img_path = asset('qdent/storage/app/' . $img->first()->src);
                   }
               }
            }
        }


        return
            [
                'id' => $this->id,
                'name' => '#'.$this->id,
                'price' => $this->total,
                'quantity' => $this->carts->items->sum('quantity'),
                'status' => $this->status,
                'payment_status' => $this->payment_status,
                'created_at' => $this->created_at->diffForHumans(),
                'total' => $this->total_price(),
                'img' => $img_path,
                'created_at' => $this->created_at->diffForHumans(),
            ];
    }
}
