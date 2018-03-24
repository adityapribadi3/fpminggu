<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserAddress;
use JWTAuth;

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

  $data['user_id'] = $user['id'];
  $data['name'] = $request->input('name');
  $data['address'] = $request->input('address');
  $data['phone'] = $request->input('phone');
  $res = $data->save();

  if(!$res){
    return response([
      'msg'=>'fail'
    ],400);
  }else{
    return response([
      'msg'=>'Added new address',

    ],200);
  }
}catch(Exception $error){
  return response([
    'msg'=>'fail'
  ],400);
}
}

public function deleteUserAddress(Request $request, $id){
try{
  $task = UserAddress::where('id','=',$id)->delete();

  if($task==0){
    return response([
      'msg'=>'fail'
    ],400);
  }else{
    return response([
      'msg'=>'Address deleted'
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
  $task = UserAddress::where('id','=',$user['id'])
          ->update([
          'name' => $request->input('name'),
          'address' => $request->input('address'),
          'user_id' => $user['id']
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
