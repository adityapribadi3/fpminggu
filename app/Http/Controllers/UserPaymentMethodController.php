<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPaymentMethod;


class UserPaymentMethodController extends Controller
{
  public function getUserPaymentMethod()
  {
  $user = JWTAuth::toUser();
  return $user->Userpaymentmethods;
  }

public function insertUserPaymentMethod(Request $request){
  try{
  $user = JWTAuth::toUser();
  $data = new UserPaymentMethod();
  $data['user_id'] = $user['id'];
  $data['payment_id'] = $request->input('payment_id');
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

public function deleteUserPaymentMethod(Request $request){
try{
  $user = JWTAuth::toUser();
  $task = UserAccount::where('id','=',$user['id'])->delete();

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

public function updateUserPaymentMethod(Request $request){
try{
  $user = JWTAuth::toUser();
  $task = UserPaymentMethod::where('id','=',$user['id'])
          ->update([
          'user_id' => $user['id'],
          'payment_id' => $request->input('payment_id')

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
