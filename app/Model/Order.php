<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Order extends Model
{

    protected $fillable = ['user_id'	,'street_address',	'address_line2'	,'city'	,'state',	'country'	,'zip'	,'nearby',
        'payment_status','status','total','name','phone','email','shippingmethod_id'];


    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function address(){
        return $this->street_address.' '.$this->address_line2.' '.$this->city.' '.$this->state.' '.$this->country.' '.$this->zip;
    }

    public function shippingmethod(){
        return $this->belongsTo('App\Model\ShippingMethod','shippingmethod_id');
    }
    public function carts(){
        return $this->hasOne('App\Model\Cart');
    }


    public function total_price(){
        $total = $this->total;
        $shipping_price = $this->shippingmethod->price ?? 0;
        return $total + $shipping_price;
    }
    public function span(){
        $span = 'primary';
        if($this->status == 'pending'){
            $span = 'secondary ';
        }elseif ($this->status == 'processing') {
            $span = 'primary';
        }elseif ($this->status == 'delivered') {
            $span = 'info';
        }elseif ($this->status == 'canceled') {
            $span = 'danger';
        }elseif ($this->status == 'completed') {
            $span = 'success ';
        }

        return $span;
    }

    public function statusAr(){
        if($this->status == 'pending'){
            $span = 'بإنتظار القبول   ';
        }elseif ($this->status == 'accepted') {
            $span = 'مقبول ';
        }elseif ($this->status == 'canceled') {
            $span = 'ملغاه';
        }elseif ($this->status == 'complete') {
            $span = 'مكتملة ';
        }

        return $span;
    }


    public function date_human($date){
        $time = Carbon::make($date);
        $since = $time->diffForHumans();
        return $since;
    }

    public function created_date(){
        return Carbon::make($this->created_at)->format('Y-M-D');

    }

    public function payment(){
        if($this->payment_status == 'unpaid'){
            $span = 'غير مدفوعة';
        }elseif ($this->payment_status == 'paid') {
            $span = 'مدفوعة ';
        }

        return $span ?? $this->payment_status;
    }

    public function spanPayment(){
        $span = 'unpaid';
        if($this->payment_status == 'unpaid'){
            $span = 'danger ';
        }elseif ($this->payment_status == 'paid') {
            $span = 'success';
        }

        return $span;
    }

    public function delviery(){
        if($this->delivery_status == 'placed'){
            $span = 'استلام الطلب';
        }elseif ($this->delivery_status == 'accepted') {
            $span = 'الطلب مقبول ';
        }elseif ($this->delivery_status == 'packed') {
            $span = ' الطلب جاهز للشحن ';
        }elseif ($this->delivery_status == 'shipped') {
            $span = 'الطلب مشحون  ';
        }
        elseif ($this->delivery_status == 'delivered') {
            $span = 'الطلب واصل ';
        }

        return $span ?? $this->delivery_status;
    }

}
