<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use App\Cart;
use JWTAuth;

class OrderController extends Controller
{
  public function getReqOrder()
  {
    $user = JWTAuth::toUser();
    return $user->orders->where('order_status','Menunggu Pembayaran');
  }

  public function getOrder()
  {
    $user = JWTAuth::toUser();
    return $user->orders->where('order_status','On Process');
  }

  public function getOrderDetails(Request $request,$id)
  {
    $user = JWTAuth::toUser();
    $orders = $user->orders->where('id',$id);

    $order_items = array($orders);

    foreach($orders as $order){
      array_push($order_items, $order->orderitems);
    }

    return $orders;
  }

public function insertOrder(Request $request){
  try{
    $user = JWTAuth::toUser();
    // $data = new Order();
    // $data['user_id'] = $user['id'];
    // $data['order_status'] = $request->input('order_status');
    // $data['total_price'] = $request->input('total_price');
    // $data['payment_status'] = $request->input('payment_status');
    //  = $data->save();

    $id = Order::insertGetId([
      'user_id' => $user['id'],
      'order_status' => $request->input('order_status'),
      'total_price' => $request->input('total_price'),
      'payment_status' => $request->input('payment_status'),
      'shipment_address_id' => $request->input('shipment_address_id')
    ]);

    $cart = $user->cart;

    foreach($cart as $it){
      OrderItem::create([
        'order_id' => $id,
        'product_id' => $it['product_id'],
        'qty' => $it['qty'],
        'price' => $it['price'],
        'additional_information' => $it['additional_information']
      ]);
    }

  if(!$id){
    return response([
      'msg'=>'fail'
    ],400);
  }else{
    return response([
      'msg'=>'Order has been placed, please check your dashboard.',

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
  $task =  Order::where('id','=',$user['id'])->delete();

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
   $task =  Order::where('id','=',$user['id'])->update([

           'user_id' => $user['id'],
           'order_status' => $request->input('order_status'),
           'order_date' => $request->input('order_date'),
           'total_price' => $request->input('total_price'),
           'payment_date' => $request->input('payment_date'),
           'payment_amount' => $request->input('payment_amount'),
           'max_payment_date' => $request->input('max_payment_date'),
           'payment_status' => $request->input('payment_status'),
           'shipment_date' => $request->input('shipment_date'),
           'shipment_tracking_number' => $request->input('shipment_tracking_number')
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
