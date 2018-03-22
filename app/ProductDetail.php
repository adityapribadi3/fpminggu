<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'product_details';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function productdetails(){
      return $this->belongsTo('App\Product','id');
    }
}
