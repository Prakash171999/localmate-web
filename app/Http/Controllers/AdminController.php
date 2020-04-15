<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function logout(){
        return redirect('/')->with('flash_message_success', 'Successfully Logged Out');
    }


    public function adminlogin(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            // dd($data); die;

            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'isAdmin'=>['1']])){    
                return view('auth.register');
               
            }
            else{
                return redirect('/')->with('flash_message_error', 'Invalid email or password');
            }
        }
        else{
            return view('admin');
        }
    }
}