<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //

    protected $fillable = ['name','description','location','date','lat','lng','from','to'];
    protected $appends = ['attendance_count'];
    protected $hidden = ['attendance'];

    public function images(){
        return $this->hasMany('App\Model\Image');
    }
    public function interested(){
        return $this->hasMany('App\Model\Interested');
    }

    public function attendance()
    {
        return $this->hasMany('App\Model\EventAttendance');
    }

    public function getAttendanceCountAttribute()
    {
        return count($this->attendance);
    }
}
