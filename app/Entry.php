<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{   
    protected $fillable = [
        'total',
        'payment_id',
        'caja_id',
        'description'
    ];
    
    public function cajas()
    {
        return $this->belongsTo('App\Caja');
    }

    public function payments(){
        return $this->belongsTo('App\Payment');
    }
}
