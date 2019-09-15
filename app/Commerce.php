<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commerce extends Model
{
    //

    
    
    protected $fillable = [
        'name', 
        'address', 
        'latitud',
        'longitud',
        'description',
        'email',
        'phone_number',
        'img',
    ];


    protected $with = ['products','services','clients','employees','categories','providers','cajas'];


    public function products(){

        return $this->hasMany('App\Product');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('rol');
    }

    public function employees() {
        return $this->users()->wherePivot('rol', 'EMPLOYEE');
    }

    public function admins() {
        return $this->users()->wherePivot('rol', 'ADMIN');
    }


    public function clients(){
        return $this->hasMany("App\Client");        
    }

    public function categories(){
        return $this->hasMany("App\Category");
    }

    public function providers(){
        return $this->hasMany("App\Provider");
    }

    public function sales(){
        return $this->hasMany("App\Sale");
    }

    public function subscription(){
        return $this->hasMany("App\Subscription");
    }

    public function services(){
        return $this->hasMany("App\Service");
    }
    
    public function cajas(){
        return $this->hasMany("App\Caja");
    }

    public function payments(){
        return $this->hasMany("App\Payment");
    }
}
