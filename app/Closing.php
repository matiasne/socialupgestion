<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Closing extends Model
{
    protected $fillable = [
        'total'
    ];

    public function cajas()
    {
        return $this->belongsTo('App\Caja');
    }

}
