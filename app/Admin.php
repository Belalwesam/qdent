<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{        protected $guard = 'web';

    protected $fillable = [
        'name', 'email', 'password','img','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function span(){
        $span = 'primary';
        if($this->status == 'inactive'){
            $span = 'warning';
        }elseif ($this->status == 'active') {
            $span = 'success';
        }

        return $span;
    }

    public function role()
    {
        if ($this->role == 1){
            return 'مسؤول';
        }elseif ($this->role == 2){
            return 'مشرف';
        }elseif ($this->role == 3){
            return 'مراقب';
        }
    }
}
