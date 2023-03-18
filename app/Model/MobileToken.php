<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MobileToken extends Model
{
    protected $table = 'mobile_tokens';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
