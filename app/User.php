<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','imguser'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function commerces(){
        return $this->belongsToMany('App\Commerce')->withPivot('enum_rol');
    }

    public function currentAcount(){
        return $this->belongsToMany('App\CurrentAcount');
    }

     // A user can send a message
     public function sent()
     {
         return $this->hasMany(Message::class, 'sender_id');
     }
 
     // A user can also receive a message
     public function received()
     {
         return $this->hasMany(Message::class, 'sent_to_id');
     }
}
