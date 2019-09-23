<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentAcount extends Model
{
    protected $fillable = [
        'client_id', 
        'document_a', 
        'document_b', 
        'balance'
    ];

    // A message belongs to a sender
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function egresses()
    {
        return $this->hasMany('App\CurrentAcountEgress','current_acount_id');
    }
    public function entries()
    {
        return $this->hasMany('App\CurrentAcountEntry','current_acount_id');
    }
}
