<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{   
    protected $fillable = [
        'total',
        'payment_id'
    ];
    
    public function cajas()
    {
        return $this->belongsTo('App\Caja');
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }
}
