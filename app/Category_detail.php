<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_detail extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'categorydetails';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    protected $fillable = [
        'id','category_id','key'
    ];

    public function products(){
      return $this->hasMany('App\Product');
    }

    public function categorydetails(){
      return $this->belongsTo('App\Categories','parent_category_id');
    }
}
