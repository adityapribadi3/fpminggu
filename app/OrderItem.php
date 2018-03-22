<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'order_items';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function orderitems(){
      return $this->belongsTo('App\Order','id');
    }

    public function products(){
      return $this->belongsTo('App\Product','product_id');
    }

    protected $fillable = [
        'id','order_id','product_id','price','qty','additional_information'
    ];
}
