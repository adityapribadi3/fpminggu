<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserAddress;

class UserAddressController extends Controller
{
  public function getUserAddress()
  {
  $user = JWTAuth::toUser();
  return $user->useraddress;
}

public function insertUserAddress(Request $request){
  try{
  $user = JWTAuth::toUser();
  $data = new UserAddress();
  $data['name'] = $request->input('name');
  $data['address'] = $request->input('address');
  $data['user_id'] = $user->['id'];
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

public function deleteUserAddress(Request $request){
try{
  $task = UserAddress::where('id','=',$request->input('id'))->delete();

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

public function updateUserAddress(Request $request){
try{
  $user = JWTAuth::toUser();
  $task = UserAddress::where('id','=',$request->input('id'))
          ->update([
          'name' => $request->input('name'),
          'address' => $request->input('address'),
          'user_id' => $user->input('id')
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
