<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $fillable = [
        'name_rol',
    ];

    public function usuarios(){
        return $this->hasMany('App\User');
    }
}
