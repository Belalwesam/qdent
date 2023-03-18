<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductAttrabiute extends Model
{
    //
    protected $fillable = ['product_id', 'attribute_value_id','attribute_id'];
    protected $table = 'product_attrbuites';

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }

    public function attribute()
    {
        return $this->belongsTo('App\Model\Attribute');
    }

    public function attributeValue()
    {
        return $this->belongsTo('App\Model\AttributeValue');
    }
}
