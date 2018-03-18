<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $incrementing = false;
    protected $table = 'orderitems';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function orderitems(){
      return $this->belongsTo('App\Order','order_id');
    }

    public function orderitems(){
      return $this->belongsTo('App\Product','product_id');
    }
}
