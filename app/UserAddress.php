<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'user_addresses';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function useraddress(){
      return $this->belongsTo('App\User','user_id');
    }

    public function order(){
      return $this->belongsTo('App\Order','shipment_address_id');
    }

    protected $fillable = [
        'id','user_id','name','phone','address'
    ];
}
