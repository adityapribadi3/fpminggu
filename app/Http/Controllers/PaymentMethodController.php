<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentMethod;

class PaymentMethodController extends Controller
{
  public function getPaymentMethod()
  {
  return PaymentMethod::all();
  }

public function insertPaymentMethod(Request $request){
  try{
  $data = new PaymentMethod();
  $data['payment_name'] = $request->input('payment_name');
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

public function deletePaymentMethod(Request $request){
try{
  $task = PaymentMethod::where('id','=',$request->input('id'))->delete();

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

public function updatePaymentMethod(Request $request){
try{
  $task = UserPaymentMethod::where('id','=',$request->input('id'))
          ->update([
          'payment_name' => $request->input('payment_name')

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
