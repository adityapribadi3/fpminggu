<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";


    public function Userpaymentmethods(){
      return $this->hasMany('App\UserPaymentMethod');
    }

    public function useraddress(){
      return $this->hasMany('App\UserAddress');
    }

    public function orders(){
      return $this->hasMany('App\Order');
    }

    public function cart(){
      return $this->hasMany('App\Cart');
    }





}
