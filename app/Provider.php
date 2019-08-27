<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //
    protected $fillable = [
        'commerce_id',
        'name',         
    ];

    public function commerce(){

        return $this->belongsTo('App\Commerce');
        
    }
}
