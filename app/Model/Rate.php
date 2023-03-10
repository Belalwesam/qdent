<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rate';

    protected $fillable = [
        'user_id', 'product_id', 'rate', 'comment'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }

}

