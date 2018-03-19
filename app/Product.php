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

    public function cart(){
      return $this->belongsTo('App\Cart','product_id');
    }

    public function category(){
      return $this->belongsTo('App\Category_detail','category_id');
    }

    public function productdetails(){
      return $this->hasMany('App\ProductDetail','product_id');
    }
}
