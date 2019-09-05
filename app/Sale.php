<?php

namespace App;
use App\Payment;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'client_id',
        'commerce_id',
        'employe_id',
        'creation_date',
        'description',
        'total_cost',
        'enum_status',
        'enum_pay_with'
    ];

    protected $with = ['productsDetails'];


    public function commerce(){
        return $this->belongsTo("App\Commerce");
    }

    public function payments(){
        return Payment::where('child_table_id',$this->id)->where('enum_type','SALE');
    }

    
    public function productsDetails(){
        return $this->hasMany("App\SalesProductsDetail");
    }

    public function servicesDetails(){
        return $this->hasMany("App\SalesServicesDetail");
    }
}
