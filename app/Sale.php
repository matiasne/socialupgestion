<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'client_id',
        'commerce_id',
        'employe_id',
        'creation_date',
        'description',
        'total_cost'
    ];

    public function products(){
        return $this->belongsToMany("App\Product");
    }

    public function commerce(){
        return $this->belongsTo("App\Commerce");
    }
}
