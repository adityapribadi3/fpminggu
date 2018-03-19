<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use App\Cart;
use JWTAuth;

class OrderController extends Controller
{
  public function getOrder()
  {
    $user = JWTAuth::toUser();
    return $user->orders;
  }

public function insertOrder(Request $request){
  try{
    $user = JWTAuth::toUser();
    $cart = Cart::where()->get();
    $data = new Order();
    $data['user_id'] = $user['id'];
    $data['order_status'] = $request->input('order_status');
    $data['order_date'] = $request->input('order_date');
    $data['payment_date'] = $request->input('payment_date');
    $data['payment_amount'] = $request->input('payment_amount');
    $data['max_payment_date'] = $request->input('max_payment_date');
    $data['payment_status'] = $request->input('payment_status');
    $data['shipment_date'] = $request->input('shipment_date');
    $data['shipment_tracking_number'] = $request->input('shipment_tracking_number');
    $res = $data->save();

    $cart = Cart::where('user_id', $user['id'])->get();

    foreach($cart as $it){
      OrderItem::create([
        'order_id' => $data->id,
        'product_id' => $it['product_id'],
        'qty' => $it['qty'],
        'price' => $it['price'],
        'additional_information' => $it['additional_information']
      ]);
    }

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

 public function deleteOrder(Request $request){
 try{
  $user = JWTAuth::toUser();
  $task =  Order::where('id','=',$user->['id'])->delete();

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

 public function updateOrder(Request $request){
 try{
   $user = JWTAuth::toUser();
   $task =  Order::where('id','=',$user['id'])
           ->update([

           'user_id' => $user['id'],
           'order_status' => $request->input('order_status'),
           'order_date' => $request->input('order_date'),
           'total_price' => $request->input('total_price'),
           'payment_date' => $request->input('payment_date'),
           'payment_amount' => $request->input('payment_amount'),
           'max_payment_date' => $request->input('max_payment_date'),
           'payment_status' => $request->input('payment_status'),
           'shipment_date' = $request->input('shipment_date'),
           'shipment_tracking_number' = $request->input('shipment_tracking_number')

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
