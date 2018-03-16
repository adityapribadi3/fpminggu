<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $incrementing = false;
    protected $table = 'carts';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    
}
