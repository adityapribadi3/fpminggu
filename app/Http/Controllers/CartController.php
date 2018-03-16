<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

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
  $data['user_id'] = $user->input['id'];
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

public function deleteCart(Request $request){
try{
  $task = Cart::where('id','=',$request->input('id'))->delete();

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
  $task = Cart::where('id','=',$request->input('id'))
          ->update([
          'user_id' => $request->input('id')
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
