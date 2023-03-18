<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attrabiute extends Model
{
    //

    protected $fillable = ['name','icon'];

    protected $table = 'attributes';

    public function values()
    {
        return $this->hasMany('App\Model\AttrabiutValue','attribute_id');
    }
}
