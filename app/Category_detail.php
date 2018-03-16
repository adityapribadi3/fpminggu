<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_detail extends Model
{
    public $incrementing = false;
    protected $table = 'categorydetails';
    
    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";
}
