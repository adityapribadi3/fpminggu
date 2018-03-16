<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShipmentItem;

class ShipmentItemController extends Controller
{
  public function getShipmentItem()
  {
  return ShipmentItem::all();
}

public function insertShipmentItem(Request $request){
  try{
  $data = new ShipmentItem();

  $data['shipment_id'] = $request->input('shipment_id');
  $data['order_item_id'] = $request->input('order_item_id');

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

 public function deleteShipmentItem(Request $request){
 try{
  $task = ShipmentItem::where('id','=',$request->input('id'))->delete();

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

 public function updateShipmentItem(Request $request){
 try{
  $task = ShipmentItem::where('id','=',$request->input('id'))
           ->update([

           'shipment_id' => $request->input('shipment_id'),
           'order_item_id' => $request->input('order_item_id')

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
