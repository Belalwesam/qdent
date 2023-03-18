<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $fillable = ['user_id'	,'order_id'	,];


    public function user(){

        return $this->belongsTo('App\User');
    }
    public function items(){

        return $this->hasMany('App\Model\Item');
    }

    public function order(){

        return $this->belongsTo('App\Model\Order');
    }


}
