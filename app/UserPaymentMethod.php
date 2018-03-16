<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPaymentMethod extends Model
{
    public $incrementing = false;
      protected $table = 'Userpaymentmethods';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";
}
