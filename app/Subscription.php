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
            'total_cost'
        ];

        public function commerce(){

            return $this->belongsTo('App\Commerce');
    
        }       

        public function clients(){
    
            return $this->belongsTo('App\Client');
            
        }

        public function employes(){
    
            return $this->belongsTo('App\Employe');
            
        }     

        public function services(){

            return $this->belongsToMany('App\Service');

        }
}
