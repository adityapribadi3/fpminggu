<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'carts';

    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    public function user(){
      return $this->belongsTo('App\User','user_id');
    }

    public function product(){
      return $this->hasOne('App\Product','id','product_id');
    }

    public function scopeWhereArray($query, $array) {
        foreach($array as $where) {
            $query->where($where['field'], $where['operator'], $where['value']);
        }
        return $query;
    }

    protected $fillable = [
        'id','user_id','product_id','qty','price'
    ];
}
