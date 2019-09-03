<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'client_id',
        'commerce_id',
        'employe_id',
        'creation_date',
        'description',
        'total_cost',
        'enum_estatus'
    ];

    protected $with = ['productsDetails'];


    public function commerce(){
        return $this->belongsTo("App\Commerce");
    }

    public function productsDetails(){
        return $this->hasMany("App\SalesProductsDetail");
    }
}
