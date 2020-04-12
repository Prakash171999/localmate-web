<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\driverlocations;
use Exception;
use Illuminate\Support\Facades\DB;
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

//     public function updatePassword($email=null,Request $request){
//     try{
            
//         $validator = Validator::make($request->all(), [
//             'email' => 'required|unique:users|max:60',
//             'password' => 'required|string|min:8',
//         ]);
        
//         // $var = User::where(['id'])->get();

//         if ($validator->fails()) {
//             return response()->json(['errors' => $validator->errors()],400);
//         }
//         $Udate = User::find($email);
//         $Udate->fullname = $request->input('fullname');
//         $Udate->password = Hash::make($request->input('password'));
//         $Udate->save();
//         return response()->json(['data' => 'updated successfully'],200);
//     }catch(Exception $e){
//         return response()->json(['errors' => 'Bad Request'], 400);
//     }
//   }



    
    // API for storing the drivers latitude and longitude in database table.
    public function driverLocation(Request $request){
        $validatedLocationData = Validator::make($request->all(), [
            'd_latitude' => 'required|max:60',
            'd_longitude' => 'required|max:60',
        ]);
        if($validatedLocationData->fails()){
            return response()->json($validatedLocationData->errors()->toArray());
        }
        $Dlocation = driverlocations::where("U_id", "=", $request->input("U_id"))->first();
        if($Dlocation){
            // $Dlocation->update($request->all());
            return response()->json(['message' => 'Locations already exists.']);
        }   
        else{
		    $Dlocation = new driverlocations();
            $Dlocation->d_latitude = $request->input('d_latitude');
            $Dlocation->d_longitude = $request->input('d_longitude');
            $Dlocation->isOnline = $request->input('isOnline');
            $Dlocation->U_id = $request->input('U_id');
            $Dlocation->save();
            // returning response
            return response()->json(['location' => $Dlocation]);
        }       
    }

    //Getting the driver locations data
    public function drivercoordinates()
    {
        // $coordinates = driverlocations::all();
        // return response()->json($coordinates);    

        $Locations = DB::table('users')
            ->join('driverlocations', 'users.id', '=' , 'driverlocations.U_id')
            ->select('users.fullname','users.phoneno','driverlocations.d_latitude','driverlocations.d_longitude')
            ->where('driverlocations.isOnline', '=', "1")
            ->get();
            
            return response()->json($Locations);
    }

}

