<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = ['product_id'	,'cart_id'	,'qty'	,'price',	'total'	];

    public function cart(){

        return $this->belongsTo('App\Model\Cart');
    }
    public function product(){

        return $this->belongsTo('App\Model\Product');
    }


}
