<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    protected $fillable = ['user_id', 'player_id', 'device'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
