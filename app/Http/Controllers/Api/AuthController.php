<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function register(Request $request)
   {
        $validatedData = Validator::make($request->all(), [
            'fullname' => 'required|max:60',
            'phoneno' => 'required|min:10',
            'dob' => 'required', 'date',
            'email' => 'email|required|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if($validatedData->fails()){
            return response()->json($validatedData->errors()->toArray());
        } else {
            $user = new User();
            $user->fullname = $request->input('fullname');
            $user->phoneno = $request->input('phoneno');
            $user->dob = $request->input('dob');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();
            //generating accesstoken with name authToken
            $accessToken = $user->createToken('authToken')->accessToken;
            // returning response containing user object and access token.
            return response()->json(['user' => $user,'access_token'=>$accessToken]);

        }        
    }
   public function login(Request $request)
   {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' =>'required',
            'driver_id' =>''
        ]);
        //checks if the data is valid. if the data is not valid it returns -ve response
        if(!auth()->attempt($loginData)){
            return response(['message'=>'Invalid credentials']);
        }
        //when the data is valid generate token
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['user' => auth()->user(), 'access_token' => $accessToken]);
   }

   public function test(){
       return response()->json(['foo' => 'bar']);
   }
}
