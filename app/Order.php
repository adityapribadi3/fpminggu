<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'orders';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function orders(){
      return $this->belongsTo('App\User','user_id');
    }

    public function orderitems(){
      return $this->hasMany('App\OrderItem','order_id');
    }

    public function useraddress(){
      return $this->hasMany('App\UserAddress','id');
    }

    protected $fillable = [
        'id','user_id','order_status','order_date','total_price','payment_date','payment_amount',
        'max_payment_date','payment_status','shipment_date','shipment_status','shipment_tracking_number','shipment_address'
    ];

}
