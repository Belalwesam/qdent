<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Interested extends Model
{
    protected $fillable = [
        'user_id', 'event_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function event()
    {
        return $this->belongsTo('App\Model\Event');
    }

}
