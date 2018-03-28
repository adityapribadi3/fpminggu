<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;

class ProductController extends Controller
{
  public function getProduct(Request $request, $name)
  {
    $cat_id = Categories::where('category_name','=',$name)->first()->id;
    $products = Product::where('category_id','=',$cat_id)->paginate(12);

    $res = array();

    foreach ($products as $product) {
      array_push($res, $product->productdetails);
    }

    return $products;
  }

  public function getTopProduct()
  {
    $products = Product::orderBy('product_sold','DESC')->paginate(6);

    foreach($products as $product){
      $product->productdetails;
    }
    return $products;
  }

  public function validateQty(Request $request, $id, $qty){
    $stock = Product::find($id)->value('product_qty');
    $productname = Product::find($id)->value('product_name');
    $integer_qty = (int)$qty;

    if($stock>=$integer_qty){
      return response(['msg'=>'enough'],200);
    } else {
      return response(['msg'=>'Our stock for '.$productname.' is not enough'],400);
    }

  }

  public function getProductById(Request $request,$id)
  {
    $product = Product::where('id',$id)->first();
    $product_details = $product->productdetails;

    return $product;
  }

public function insertProduct(Request $request){
  try{
  $data = new Product();
  $data['product_name'] = $request->input('product_name');
  $data['product_price'] = $request->input('product_price');
  $data['product_description'] = $request->input('product_description');
  $data['product_qty'] = $request->input('product_qty');
  $data['product_img'] = $request->input('product_img');
  $data['category_id'] = $request->input('category_id');
  $data['product_sold'] = $request->input('product_sold');
  $res = $data->save();

  if($res==0){
    return response([
      'msg'=>'fail'
    ],400);
  }else{
    return response([
      'msg'=>'success',

    ],200);
  }
}catch(Exception $error){
   return response([
     'msg'=>'fail'
   ],400);
 }
 }

 public function deleteProduct(Request $request){
 try{
  $task = Product::where('id','=',$request->input('id'))->delete();

   if($task==0){
     return response([
       'msg'=>'fail'
     ],400);
   }else{
     return response([
       'msg'=>'success'
     ],200);
   }
 }catch(Exception $error){
   return response([
     'msg'=>'fail'
   ],400);
 }
 }

 public function updateProduct(Request $request){
 try{
  $task = Product::where('id','=',$request->input('id'))
           ->update([

           'product_name' => $request->input('product_name'),
           'product_price' => $request->input('product_price'),
           'product_description' => $request->input('product_description'),
           'product_qty' => $request->input('product_qty'),
           'product_img' => $request->input('product_img'),
           'category_id' => $request->input('category_id'),
           'product_sold' => $request->input('product_sold')

                   ]);

           if($task==0){
             return response([
               'msg'=>'fail'
             ],400);
           }else{
             return response([
               'msg'=>'success'
             ],200);
           }
         }catch(Exception $error){
           return response([
             'msg'=>'fail'
           ],400);
         }
 }
}
