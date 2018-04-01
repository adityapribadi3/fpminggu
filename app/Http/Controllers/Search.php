<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\P3;

class Search extends Controller
{
    public function search(Request $request)
    {
      $keyword = $request->keyword;

      $ret = Product::where('product_name','LIKE',"%$keyword%")
            ->orWhere('product_description','LIKE',"%$keyword%")
            ->orWhereHas('productdetails', function ($query) use ($keyword) {
              $query->where('value', 'LIKE', "%$keyword%");
            })->paginate(12);

      foreach($ret as $re){
        $re->productdetails;
      }

      if(count($ret)>0)
      {
        return response()->json($ret,200);
      }
      else
      {
          return response(['msg' => 'Your keyword does not match with any of our data'],400);
      }
    }
}
