<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $incrementing = false;
    protected $table = 'carts';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function user(){
      return $this->belongsTo('App\User','user_id');
    }

    public function products(){
      return $this->hasMany('App\Product','id');
    }
}
