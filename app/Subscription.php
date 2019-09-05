<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
   
        protected $fillable = [
            'commerce_id', 
            'client_id',
            'employe_id',
            'start_date',
            'period',
            'enum_start_payment',
            'enum_status',
            'total_cost',
            'enum_pay_with'
        ];

        public function commerce(){
            return $this->belongsTo('App\Commerce');    
        }       

        public function clients(){    
            return $this->belongsTo('App\Client');            
        }      

        public function services(){
            return $this->belongsToMany('App\Service');
        }

        public function payments(){
            return Payment::where('child_table_id',$this->id)->where('enum_type','SUBSCRIPTION');
        }
}
