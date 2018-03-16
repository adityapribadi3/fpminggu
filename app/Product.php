<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;
    protected $table = 'products';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";
}
