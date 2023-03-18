<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //

    protected $fillable = ['product_id','user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
     public function product(){
        return $this->belongsTo('App\Model\Product');
    }
}
