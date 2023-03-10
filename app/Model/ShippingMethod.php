<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    //
    protected $table    = 'shippingmethods';

    protected $fillable = ['name', 'days', 'price', 'status','description','img'];

}
