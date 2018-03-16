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
}
