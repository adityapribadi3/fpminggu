<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class Search extends Controller
{
    public function search(Request $request)
    {
      $keyword = $request->keyword;

      $ret = Product::where('product_name','LIKE',"%$keyword%")
            ->orWhere('product_description','LIKE',"%$keyword%")
            ->orWhereHas('productdetails', function ($query) use ($keyword) {
              $query->where('value', 'LIKE', "%$keyword%");
            })->paginatete(12);

      return $ret;
    }
}
