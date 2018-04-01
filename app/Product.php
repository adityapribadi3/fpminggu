<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'products';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function cart(){
      return $this->belongsTo('App\Cart','product_id');
    }

    public function category(){
      return $this->belongsTo('App\Categories','category_id','id');
    }

    public function productdetails(){
      return $this->hasMany('App\ProductDetail','product_id');
    }

    public function toSearchableArray(){
      $res = $this->toArray();

      $res['category'] = $this->category;
      $res['productdetails'] = $this->productdetails;

      return $res;
    }
}
