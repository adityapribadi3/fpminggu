<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductDetail;

class ProductDetailController extends Controller
{
  public function getProductDetail()
  {
  return ProductDetail::all();
}

public function insertProductDetail(Request $request){
  try{
  $data = new ProductDetail();

  $data['product_id'] = $request->input('product_id');
  $data['key'] = $request->input('key');
  $data['value'] = $request->input('value');
  $data->save();

  if($data==0){
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

 public function deleteProductDetail(Request $request){
 try{
  $task = ProductDetail::where('id','=',$request->input('id'))->delete();

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

 public function updateProductDetail(Request $request){
 try{
  $task = ProductDetail::where('id','=',$request->input('id'))
           ->update([

           'product_id' => $request->input('product_id'),
           'key' => $request->input('key'),
           'value' => $request->input('value')

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
