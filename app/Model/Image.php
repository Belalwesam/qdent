<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'product_id','src','event_id'
    ];


    public function img(){
        return asset('/storage/app/'.$this->src);
    }
}
