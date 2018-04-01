<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use JWTAuth;

class CartController extends Controller
{
  public function getCart()
  {
    $user = JWTAuth::toUser();

    $carts = $user->cart;
    $cart_items = array($carts);

    foreach($carts as $cart){
      array_push($cart_items, $cart->product);
    }

    return response($carts,200);
  }

  public function checkCart(){
    $user = JWTAuth::toUser();

    $carts = $user->cart;

    $response_array = array();
    foreach($carts as $cart){
      $product_id = $cart->product_id;
      $stock = Product::find($product_id)->product_qty;
      $name = Product::find($product_id)->product_name;
      if($cart->qty>$stock){
        array_push($response_array,'Our stock for '.$name.' is not enough');
      }
    }
    if(count($carts) == 0){
      return response ([
        'msg' => 'Cart is Empty!'
      ],400);
    }
    if(count($response_array)!=0){
      return response($response_array,400);
    }
    else {
      return response([
        'msg' => 'true'
      ],200);
    }
  }

public function insertCart(Request $request){
    try{
      $res=null;
      $user = JWTAuth::toUser();
      $product = Product::where('id',$request->input('product_id'))->first();

      $exist = Cart::where('user_id',$user['id'])->where('product_id',$request->input('product_id'))->first();
      if($exist){
        Cart::where('user_id',$user['id'])->where('product_id',$request->input('product_id'))->increment('qty');
      } else {
        $data = new Cart();
        $data['user_id'] = $user['id'];
        $data['product_id'] = $request->input('product_id');
        $data['qty'] = $request->input('qty');
        $data['price'] = $product->product_price;
        $res = $data->save();
      }

        return response([
          'msg'=>'Added to cart',
        ],200);

    }catch(Exception $error){
      return response([
        'msg'=>'Fail to update cart'
      ],400);
  }
}

public function deleteCart(Request $request){
  try{
    $user = JWTAuth::toUser();
    $task = Cart::where('user_id','=',$user['id'])->delete();

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

public function deleteItemFromCart(Request $request,$id){
  try{
    $user = JWTAuth::toUser();
    $whereArray = array(
      array(
        'field' => 'user_id',
        'operator' => '=',
        'value' => $user['id']
      ),
      array(
        'field' => 'id',
        'operator' => '=',
        'value' => $id
      )
    );

    $task = Cart::whereArray($whereArray)->delete();

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

public function updateCartQty(Request $request){
  try{
    $user = JWTAuth::toUser();

    $carts = $user->cart;

    $task = $carts->where('product_id','=',$request->input('product_id'))->first()->update([
      'qty' => $request->input('qty')
    ]);

            if($task==0){
              return response([
                'msg'=>'Fail to update qty'
              ],400);
            }else{
              return response([
                'msg'=>'Qty updated'
              ],200);
            }
          }catch(Exception $error){
            return response([
              'msg'=>'fail'
            ],400);
          }
  }
}
