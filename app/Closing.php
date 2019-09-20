<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Closing extends Model
{
    protected $fillable = [
        'paydesk_id',
        'date_closing'
    ];

    public function paydesks()
    {
        return $this->belongsTo('App\Paydesk');
    }

}
