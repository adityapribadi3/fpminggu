<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $incrementing = false;
    protected $table = 'orders';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function orders(){
      return $this->belongsTo('App\User','user_id');
    }

    public function orderitems(){
      return $this->hasMany('App\OrderItem');
    }

}
