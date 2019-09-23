<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentAcountEgress extends Model
{
    protected $fillable = [
        'current_acount_id',
        'mount',        
        'description',
    ];
    
    public function currentAcount()
    {
        return $this->belongsTo('App\CurrentAcount');
    }

}
