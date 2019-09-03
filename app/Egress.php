<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egress extends Model
{   
    protected $fillable = [
        'caja_id',
        'total',
        'description'
    ];

    public function cajas()
    {
        return $this->belongsTo('App\Caja');
    }
}
