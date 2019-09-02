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
        'status',
        'total_cost',
    ];


    public function entrys()
    {
        return $this->belongsTo('App\Entry');
    }
}
