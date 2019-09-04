<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'commerce_id',
        'client_id', 
        'child_table', 
        'enum_type',
        'enum_status',
        'total_cost',
    ];


    public function entrys()
    {
        return $this->hasMany('App\Entry');
    }

    public function egress()
    {
        return $this->hasMany('App\Egress');
    }

    public function commerces()
    {
        return $this->belongsTo('App\Commmerce');
    }


}
