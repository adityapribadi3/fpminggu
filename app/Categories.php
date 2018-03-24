<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'categories';
    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    protected $fillable = [
        'id','category_name','parent_category_id'
    ];

    public function categorieschild(){
      return $this->belongsTo('App\Categories','parent_category_id','id');
    }

    public function allcategories(){
      return $this->categorieschild()->with('allcategories');
    }

    public function categorydetails(){
      return $this->hasMany('App\Category_detail');
    }
}
