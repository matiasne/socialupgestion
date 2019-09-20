<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paydesk extends Model
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

    public function paydeskEgresses()
    {
        return $this->hasMany('App\PaydeskEgress');
    }
    public function paydeskEntries()
    {
        return $this->hasMany('App\PaydeskEntry');
    }
    public function closing()
    {
        return $this->hasMany('App\Closing');
    }
}
