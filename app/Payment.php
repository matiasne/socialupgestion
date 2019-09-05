<?php

namespace App;

use App\Sale;
use App\Subscription;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'commerce_id',
        'client_id', 
        'child_table_id', 
        'enum_type',
        'enum_status',
        'total_cost',
    ];

    public function conceptoReferido(){

        if($this->enum_type == "SALE"){
            return Sale::findOrFail($this->child_table_id);
        }
        if($this->enum_type == "SUBSCRIPTION"){
            return Subscription::findOrFail($this->child_table_id);
        }
    }


    public function entries()
    {
        return $this->hasMany('App\Entry');
    }

    public function egresses()
    {
        return $this->hasMany('App\Egress');
    }

    public function commerces()
    {
        return $this->belongsTo('App\Commmerce');
    }


}
