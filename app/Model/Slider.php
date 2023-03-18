<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'name','img','url','type'
    ];

    public function img(){
        return asset('rooz/storage/app/'.$this->img);

    }
}
