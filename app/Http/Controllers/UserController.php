<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
 public function getUserAccount(){
 return User::all();
}

public function insertUserAccount(Request $request){
 try{
 $data = new User();
 $data['password'] = $request->input('password');
 $data['email'] = $request->input('email');
 $data['name'] = $request->input('name');
 $data['phone'] = $request->input('phone');
 $data['position'] = $request->input('position');
 $data['success_trans'] = $request->input('success_trans');
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
 $task = UserAccount::where('id','=',$request->input('id'))
         ->update([

         'password' => $request->input('password'),
         'email' => $request->input('email'),
         'name' => $request->input('name'),
         'phone' => $request->input('phone'),
         'position' => $request->input('position'),
         'success_trans' => $request->input('success_trans')
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
