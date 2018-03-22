<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPaymentMethod extends Model
{
    public $incrementing = false;
    public $timestamps = false;
      protected $table = 'Userpaymentmethods';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function paymentmethods(){
      return $this->hasMany('App\PaymentMethod');
    }

    public function Userpaymentmethods(){
      return $this->belongsTo('App\User','user_id');
    }

    protected $fillable = [
      'id','payment_name'
    ];
}
