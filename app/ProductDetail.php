<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    public $incrementing = false;
    protected $table = 'productdetails';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";
}
