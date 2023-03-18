<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id', 'feed_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function feed()
    {
        return $this->belongsTo('App\Model\Feed');
    }

}
