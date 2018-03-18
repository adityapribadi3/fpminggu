<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public $incrementing = false;
    protected $table = 'paymentmethods';
    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function Userpaymentmethods(){
    return $this->belongsTo('App\UserPaymentMethod','payment_id');
  }
}
