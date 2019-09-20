<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaydeskEgress extends Model
{   
    protected $fillable = [
        'paydesk_id',
        'payment_id',
        'total',
        'description'
    ];

    public function paydesks()
    {
        return $this->belongsTo('App\Paydesk');
    }
    
    public function payments(){
        return $this->belongsTo('App\Payment');
    }
}
