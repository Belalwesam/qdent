<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';
    protected $fillable = ['title',	'type',	'value',	'expire_at'	,'description','code'	];
}
