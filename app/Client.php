<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'commerce_id',
        'name', 
        'address', 
        'phone_number',
        'positive_credit',
        'email',
    ];

    public function currentAccount()
    {
        return $this->belongsTo('App\CurrentAcount');
    }

}
