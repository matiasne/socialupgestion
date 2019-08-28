<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{


    protected $fillable = [
        'name',
        'commerce_id',
        'surname', 
        'position'
    ];

    public function commerce(){
        return $this->belongsTo("App\Commerce");
    }
}
