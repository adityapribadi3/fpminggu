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

    public function categories1(){
      return $this->belongsTo('App\Categories','parent_category_id');
    }

    public function categories(){
      return $this->hasMany('App\Categories');
    }

    public function categorydetails(){
      return $this->hasMany('App\Category_detail');
    }
}
