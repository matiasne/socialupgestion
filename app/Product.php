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
        'id_commerce',
        'id_provider',
        'id_category'

    ];

    public function commerce(){

        return $this->belongsTo('App\Commerce', 'id_commerce');

    }

    public function categories(){

        return $this->belongsTo('App\Category', 'id_category');
        
    }

    public function providers(){

        return $this->belongsTo('App\Provider', 'id_provider');
        
    }
}
