<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $fillable = [
        'name','description','image','price','price_offer','stock','category_id','sub_category_id','is_new','is_offer',
        'status','views','endOffer','video','ref_id','barcode','brand_id'
    ];

    // Attrabiutes Values
    public function ProductAttrabiute()
    {
        return $this->hasMany('App\Model\ProductAttrabiute','product_id');
    }

    public function category(){
        return $this->belongsTo('App\Model\Category','category_id');
    }
    public function sub_category(){
        return $this->belongsTo('App\Model\Sub_Category','sub_category_id');
    }

    public function images(){
        return $this->hasMany('App\Model\Image','product_id');
    }
    public function rates(){
        return $this->hasMany('App\Model\Rate');
    }

    public function brands(){
        return $this->belongsTo('App\Model\Brand','brand_id');
    }
    public function span(){
        if($this->status == 1){
            $span = 'success ';
        }elseif ($this->status == 0) {
            $span = 'danger';
        }elseif ($this->status == 2) {
            $span = 'info';
        }

        return $span;
    }
    public function status(){
        if($this->status == 1){
            $span = 'Active ';
        }elseif ($this->status == 2) {
            $span = 'InActive';
        }elseif ($this->status == 3) {
            $span = 'Out Of Stock';
        }else{
            $span = 'InActive';

        }

        return $span ?? $this->status;
    }




    public function is_wish(){
        if (Auth::check()){
            $wish = Wishlist::where('user_id',Auth::user()->id)->where('product_id',$this->id)->first();
            if ($wish == null){
                return false;
            }else{
                return true;

            }
        }
        return false;
}
    public function price_tax(){
        return round((15 / 100) * $this->price + $this->price,2);
}

}
