<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    public $incrementing = false;
    protected $table = 'shipments';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";
}
