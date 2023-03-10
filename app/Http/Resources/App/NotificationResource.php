<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
                'title' => $this->title,
                'sub_title' => $this->sub_title,
                'message' => $this->message,
                'created_at' => $this->created_at->diffForHumans(),
            ];
    }
}
