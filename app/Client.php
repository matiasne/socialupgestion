<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'commerce_id',
        'name', 
        'address', 
        'phone_nunmber',
        'email',
    ];
}
