<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $fillable = [
        'name',        
        'commerce_id', 
        'total'
    ];

    public function commerce()
    {
        return $this->belongsTo('App\Commerce');
    }

    public function egress()
    {
        return $this->hasMany('App\Egress');
    }
    public function entry()
    {
        return $this->hasMany('App\Entry');
    }
    public function closing()
    {
        return $this->hasMany('App\Closing');
    }
}
