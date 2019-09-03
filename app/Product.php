<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'stock',
        'price',
        'code',
        'commerce_id',
        'provider_id',
        'category_id',
        'imgproduct'

    ];

    public function commerce(){

        return $this->belongsTo('App\Commerce');

    }

    public function categories(){

        return $this->belongsTo('App\Category');
        
    }

    public function providers(){

        return $this->belongsTo('App\Provider');
    }

    public function sales(){
        return $this->belongsToMany('App\Sale');
    }

    public function salesDetail(){
        return $this->hasMany("App\SalesProductsDetail");
    }
}
