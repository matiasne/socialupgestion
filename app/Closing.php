<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Closing extends Model
{
    protected $fillable = [
        'caja_id',
        'date_closing'
    ];

    public function cajas()
    {
        return $this->belongsTo('App\Caja');
    }

}
