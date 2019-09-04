<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesServicesDetail extends Model
{
    //
    protected $fillable = [
        'sale_id',
        'service_id',
        'service_amount',
        'service_price'
    ];

    protected $with = ['service'];

    public function sale(){
        return $this->belongsTo("App\Sale");
    }

    
    public function service(){
        return $this->belongsTo("App\Service",'service_id');
    }   
}
