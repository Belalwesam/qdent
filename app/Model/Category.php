<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name','icon','type','highlight'
    ];
    protected $table = 'categories';


    public function sub_categories(){
        return  $this->hasMany('App\Model\Sub_Category','category_id');
    }


    public function products(){
        return  $this->hasMany('App\Model\Product','category_id');
    }

    public function img(){

        return 'rooz/storage/app/'.$this->icon;
    }

}
