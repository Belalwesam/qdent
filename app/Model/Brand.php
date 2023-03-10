<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name','img','status'
    ];
    public function img(){
        return asset('qdent/storage/app/'.$this->img);
    }
}
