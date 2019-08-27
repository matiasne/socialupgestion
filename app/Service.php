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
        'commerce_id',
        'category_id'
    ];

    public function commerce(){

        return $this->belongsTo('App\Commerce');

    }

    public function categories(){

        return $this->belongsTo('App\Category');
        
    }

}
