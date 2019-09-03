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
        return $this->belongsTo('App\Entry');
    }

    public function commerces()
    {
        return $this->belongsTo('App\Commmerce');
    }
}
