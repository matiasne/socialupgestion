<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commerce extends Model
{
    //
    
    protected $fillable = [
        'name', 
        'address', 
        'phone_number',
    ];

    public function products(){

        return $this->hasMany('App\Product');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function employes(){
        return $this->hasMany("App\Employe");
    }
    
}
