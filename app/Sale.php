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
    ];

    public function products(){
        return $this->belongsToMany("App\Product");
    }

    public function commerce(){
        return $this->belongsTo("App\Commerce");
    }

    public function payments(){
        return Payment::where('child_table',$this->id)->where('enum_type','SALE');
    }

    
}
