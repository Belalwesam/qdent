<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    //
    protected $fillable = ['name','text','sub_title','is_ads'];

    public function images(){
        return $this->hasMany('App\Model\Image');
    }
    public function likes(){
        return $this->hasMany('App\Model\Like');
    }
}
