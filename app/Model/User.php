<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'edu_users';


    protected $fillable = [
        'user_id', 'country', 'type', 'description', 'video', 'category_id','isAvailable'
    ];
    protected $casts = [
        'category_id' => 'array'
    ];

//    public function sub_category(){
//        return  $this->hasMany('App\Haraj\Sub_Category','category_id');
//    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function lessons()
    {
        return $this->hasMany('App\Edu\lessons','teacher_id','user_id');
    }
    public function category()
    {

        $data = Category::whereIn('id', $this->category_id)
            ->orderByRaw(\DB::raw("FIELD(id, ".implode(",",$this->category_id).")"))
            ->get();
        return $data ?? null;
    }
    public  function nameOfCat(){
        $name = '';
//        dd('asd');
        if ($this->category_id == []){
            return 'لم يتم تحديد مواد';
        }
        $data = Category::select( 'name')
            ->whereIn('id', $this->category_id)
            ->orderByRaw(\DB::raw("FIELD(id, ".implode(",",$this->category_id).")"))
            ->get();
//        dd($data);
        foreach ( $data as $n){
            if ($name == ''){
                $name .=  $n->name;
            }else{
            $name .= ' - '. $n->name;
            }
        }
        return $name ?? null;

    }


    public function isAvaliableNow(){
        return 1;


        Carbon::setLocale('en');
        $day = (Carbon::now()->isoFormat('ddd'));
            $time = (Carbon::now()->isoFormat('H:mm:s'));
            $days =$this->days;
            $d = [
                'Sat'=>'sat','Sun'=>'sun','Mon'=>'mon','Tue'=>'tue','Wed'=>'wed','Thu'=>'thu','Fri'=>'fri'
            ];
            $m = ($d[$day]);
            if($days->$day == 0){
//                dd('asd');
                return 0;
            }else{
//                dd($days->Sat->);
                $start = $days->$m->start ;
                $end = $days->$m->end ;
//                dd($time,$start,$end,$time > $start,$time < $end);

               if ($time > $start && $time < $end){
                   return 1;

               }else{
                   return 0;
               }

            }
//            if ($this->user->days)
        }
        public function days(){
        return $this->hasOne('App\Edu\days','user_id','user_id');
        }

}
