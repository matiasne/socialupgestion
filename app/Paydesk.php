<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paydesk extends Model
{
    protected $fillable = [
        'name',        
        'commerce_id'
    ];

    public function commerce()
    {
        return $this->belongsTo('App\Commerce');
    }

    public function egresses()
    {
        return $this->hasMany('App\PaydeskEgress');
    }
    public function entries()
    {
        return $this->hasMany('App\PaydeskEntry');
    }
    public function closing()
    {
        return $this->hasMany('App\Closing');
    }
}
