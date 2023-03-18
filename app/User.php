<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $guard = 'drivers-web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',	'name',	'password'	,'phone',	'status',	'img',	'email', 'social_token', 'social_provider'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'events'
    ];

    protected $appends = ['events_count'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function devices()
    {
        return $this->hasMany('App\Model\Device');
    }

    // orders
    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }


    public function span(){
        $span = 'primary';
        if($this->status == 'inactive'){
            $span = 'warning';
        }elseif ($this->status == 'active') {
            $span = 'success';
        }

        return $span;
    }

    public function avatar(){
        return $this->belongsTo('App\Image','img');
    }

    public function rateTable(){
        return $this->hasOne('App\Rate','user_id');
    }


    public function addresses(){
        return $this->hasMany('App\Model\Address');
    }

    public function events()
    {
        return $this->hasMany('App\Model\EventAttendance', 'user_id');
    }

    public function getEventsCountAttribute()
    {
        return count($this->events);
    }
}
