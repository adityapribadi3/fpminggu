<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipment;

class ShipmentController extends Controller
{
  public function getShipment()
  {
  return Shipment::all();
}

public function insertShipment(Request $request){
  try{
  $data = new Shipment();
  $data['shipment_date'] = $request->input('shipment_date');
  $data['additional_information'] = $request->input('additional_information');
  $data['order_id'] = $request->input('order_id');
  $data['shipment_tracking_number'] = $request->input('shipment_tracking_number');
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

 public function deleteShipment(Request $request){
 try{
  $task = Shipment::where('id','=',$request->input('id'))->delete();

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

 public function updateShipment(Request $request){
 try{
  $task = Shipment::where('id','=',$request->input('id'))
           ->update([

           'shipment_date' => $request->input('shipment_date'),
           'additional_information' => $request->input('additional_information'),
           'order_id' => $request->input('order_id'),
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
