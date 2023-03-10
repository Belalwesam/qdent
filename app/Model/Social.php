<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = ['name','url','icon'];


    public function img(){

        return asset('storage/app/'.$this->img);

    }
}
