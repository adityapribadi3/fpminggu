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
}
