<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartItem;

class CartItemController extends Controller
{
  public function getCartItem()
  {
  return CartItem::all();
  }

public function insertCartItem(Request $request){
  try{
  $data = new CartItem();
  $data['cart_id'] = $request->input('cart_id');
  $data['product_id'] = $request->input('product_id');
  $data['qty'] = $request->input('qty');
  $data['price'] = $request->input('price');
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

 public function deleteCartItem(Request $request){
 try{
  $task = CartItem::where('id','=',$request->input('id'))->delete();

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

 public function updateCartItem(Request $request){
 try{
  $task = CartItem::where('id','=',$request->input('id'))
           ->update([
           'cart_id' => $request->input('cart_id'),
           'product_id' => $request->input('product_id'),
           'qty' => $request->input('qty'),
           'price' => $request->input('price')
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
