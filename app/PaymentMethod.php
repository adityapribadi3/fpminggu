<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'paymentmethods';
    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    protected $fillable = [
      'id','payment_id','user_id'
    ];

    public function Userpaymentmethods(){
      return $this->belongsTo('App\UserPaymentMethod','payment_id');
    }
}
