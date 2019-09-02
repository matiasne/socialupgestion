<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesProductsDetail extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'product_amount',
        'product_price'
    ];

    protected $with = ['product'];

    public function sale(){
        return $this->belongsTo("App\Sale");
    }

    
    public function product(){
        return $this->belongsTo("App\Product",'product_id');
    }   
}
