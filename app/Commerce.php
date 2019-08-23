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

    public function productos(){

        return $this->hasMany('App\Product');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    
}
