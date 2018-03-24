<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTAuth;

class UserController extends Controller
{
   public function getUserAccount(){
     return User::all();
   }

   public function checkAddress()
   {
     $user = JWTAuth::toUser();
     $addresses = $user->useraddress;

     if(count($addresses)==0)
     {
       return response([
         'msg' => 'Address is empty, please go to Dashboard and add an address!'
       ],400);
     } else {
       return response([
         'msg' => true
       ],200);
     }
   }

public function insertUserAccount(Request $request){
 try{
 $data = new User();
 $data['password'] = Hash::make($request->input('password'));
 $data['email'] = $request->input('email');
 $data['name'] = $request->input('name');
 $data['phone'] = $request->input('phone');
 $data['position'] = $request->input('position');
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

public function deleteUserAccount(Request $request){
try{
 $task = UserAccount::where('id','=',$request->input('id'))->delete();

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

public function updateUserAccount(Request $request){
try{
 $task = User::where('id','=',$request->input('id'))
         ->update([

         'email' => $request->input('email'),
         'name' => $request->input('name'),
         'phone' => $request->input('phone')
                   ]);

         if($task==0){
           return response([
             'msg'=>'Fail to update profile'
           ],400);
         }else{
           return response([
             'msg'=>'Profile Updated'
           ],200);
         }
       }catch(Exception $error){
         return response([
           'msg'=>'fail'
         ],400);
       }
}
}
