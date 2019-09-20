<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaydeskEntry extends Model
{   
    protected $fillable = [
        'total',
        'payment_id',
        'paydesk_id',
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
