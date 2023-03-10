<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sub_Category extends Model
{
    protected $fillable = [
        'name','icon','category_id','highlight'
    ];
    protected $table = 'sub_categories';

    public function category(){
        return $this->belongsTo('App\Model\Category','category_id');
    }

    public function products(){
        return  $this->hasMany('App\Model\Product','sub_category_id');
    }
    public function values()
    {
        return $this->hasMany('App\Model\AttrabiutValue','attribute_id');
    }

}
