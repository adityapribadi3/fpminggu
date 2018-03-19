<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use JWTAuth;

class CartController extends Controller
{
  public function getCart()
  {
  $user = JWTAuth::toUser();
  return $user->carts;
  }

public function insertCart(Request $request){
  try{
  $user = JWTAuth::toUser();
  $data = new Cart();
  $data['user_id'] = $user['id'];
  $data['product_id'] = $request->input('product_id');
  $data['qty'] = $request->input('qty');
  $data['price'] = $request->input('price');
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

public function deleteCart(Request $request){
try{
  $user = JWTAuth::toUser();
  $task = Cart::where('id','=',$user['id'])->delete();

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

public function updateCart(Request $request){
try{
  $user = JWTAuth::toUser();
  $task = Cart::where('id','=',$user['id'])
          ->update([
          'user_id' => $user['id'],
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
