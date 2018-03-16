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
}
