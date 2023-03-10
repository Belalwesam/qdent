<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable = ['user_id', 'title', 'sub_title', 'message', 'data'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
