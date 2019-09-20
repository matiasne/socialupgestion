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
        'amount',
    ];

    protected $with =['paydeskEntries'];
    

    public function conceptoReferido(){

        if($this->enum_type == "SALE"){
            return Sale::findOrFail($this->child_table_id);
        }
        if($this->enum_type == "SUBSCRIPTION"){
            return Subscription::findOrFail($this->child_table_id);
        }
    }

    public function paydeskEntries()
    {
        return $this->hasMany('App\PaydeskEntry');
    }

    public function commerces()
    {
        return $this->belongsTo('App\Commmerce');
    }


}
