<?php

namespace App\Http\Resources\App;

use App\Model\Like;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $is_like = false;
        $like = Like::where('user_id',$request->user()->id ?? null )->where('feed_id', $this->id)->first();
//        dd($fav);
        if($like != null){
            $is_like = true;
        }
        return [
            'id'=>$this->id,
            'title'=>$this->name,
            'sub_title'=>$this->sub_title,
            'img'=>asset('qdent/storage/app/'.$this->images->first()->src ?? ""),
            'created_at'=>$this->created_at,
            'is_ads'=>$this->is_ads,
            'is_like'=>$is_like,
            'likesCount'=>($this->likes->count() ?? 0),
        ];
    }
}
