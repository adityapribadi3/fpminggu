<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderItem;
use App\Order;
use JWTAuth;

class OrderItemController extends Controller
{
  public function getOrderItem(Request $request,$id)
  {
    $order = Order::find($id);
    $order_items = $order->orderitems;

    foreach($order_items as $item){
      $product = $item->products;
    }

    if($order){
      return response($order,200);
    } else {
      return response([
        'msg' => 'Server Error'
      ],400);
    }
  }

public function insertOrderItem(Request $request){
  try{
  $data = new OrderItem();

  $data['order_id'] = $request->input('order_id');
  $data['product_id'] = $request->input('product_id');
  $data['qty'] = $request->input('qty');
  $data['price'] = $request->input('price');
  $data['additional_information'] = $request->input('additional_information');

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

 public function deleteOrderItem(Request $request){
 try{
  $task = OrderItem::where('id','=',$request->input('id'))->delete();

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

 public function updateOrderItem(Request $request){
 try{
  $task = OrderItem::where('id','=',$request->input('id'))
           ->update([

           'order_id' => $request->input('order_id'),
           'product_id' => $request->input('product_id'),
           'qty' => $request->input('qty'),
           'price' => $request->input('price'),
           'additional_information' => $request->input('additional_information')

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
