<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    public $incrementing = false;
    protected $table = 'useraddress';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";
}
