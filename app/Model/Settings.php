<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    protected $fillable = [
       	'phone',	'whatsapp'	,'facebook'	,'instagram','email','twitter','privacy',
        'terms','about'
    ];



}
