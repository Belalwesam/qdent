<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable  = [
        'user_id',	'street_address',	'address_line2'	,'city'	,'state',	'country'	,'zip'	,'nearby'
    ];


    public function user(){
        return $this->belongsTo('App\User','user_id');
    }


}
