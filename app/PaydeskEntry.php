<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaydeskEntry extends Model
{   
    protected $fillable = [
        'paydesk_id',
        'payment_id',
        'amount',        
        'enum_pay_with',
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
