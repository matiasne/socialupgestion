<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    //
    protected $fillable = [
        'id_commerce',
        'name',         
    ];

    public function commerce(){

        return $this->belongsTo('App\Commerce', 'id_commerce');
        
    }
}
