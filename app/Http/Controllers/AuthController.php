<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /*
    Register User
    */
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'phone' => 'required|numeric',
            'password'=> 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),401);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),

        ]);

        return response([
            'status' => 'success',
            'data' => $user,
        ], 200);
    }

    /*
     Login User
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),401);
        }
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid Credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response([
            'status' => 'success',
            'token' => $token,
        ]);
    }

    /*
     * Logout
     */
    public function logout(){
        try {
            JWTAuth::invalidate();

            return response([
                'status' => 'success',
                'msg' => 'Logged out'
            ], 200);
        }catch (JWTException $e){

            return response([
                'status' => 'fail',
                'msg' => 'Failed to Log Out'
            ], 500);
        }
    }

    public function me() {
      $user = JWTAuth::toUser();
      return response()->json($user, 200);
    }

}
