<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public $incrementing = false;
    protected $table = 'categories';
    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";
}
