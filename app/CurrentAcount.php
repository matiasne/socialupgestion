<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CurrentAcount extends Model
{
    protected $fillable = [
        'user_id', 
        'document_a', 
        'document_b', 
        'balance'
    ];

    // A message belongs to a sender
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
