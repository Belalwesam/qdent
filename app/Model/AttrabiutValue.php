<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttrabiutValue extends Model
{
    //
    protected $fillable = ['name','icon','attribute_id'];

    protected $table = 'attrabites_value';

    public function attrabiute()
    {
        return $this->belongsTo('App\Model\AttrabiutValue');
    }
    public function sub_category()
    {
        return $this->belongsTo('App\Model\Sub_Category','attribute_id');
    }
}
