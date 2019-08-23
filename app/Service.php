<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable = [
        'name', 
        'description', 
        'price',
        'id_commerce',
        'id_category'
    ];

    public function commerce(){

        return $this->belongsTo('App\Commerce', 'id_commerce');

    }

    public function categories(){

        return $this->belongsTo('App\Category', 'id_category');
        
    }

}
