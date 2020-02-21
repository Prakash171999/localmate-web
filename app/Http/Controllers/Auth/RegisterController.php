<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Driver;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required', 'string', 'max:255'],
            'phoneno' => ['required', 'integer', 'min:10'],
            'dob' => ['required', 'date'],
            'citizenship_id' => ['required', 'integer'],
            'licence_no' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //storing the form data to the database.   
        if($data['licence_no'] != null){
            $driver = Driver::create([
            'citizenship_id' => $data['citizenship_id'],
            'licence_no' => $data['licence_no'],
            session()->flash('message','Registration successfully done!'),
            ]);
        }

        return User::create([
            'fullname' => $data['fullname'],
            'phoneno' => $data['phoneno'],
            'dob' => $data['dob'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'driver_id' => $driver ? $driver->id : null,
        ]);
    }
    protected function redirectTo()
    {
        /* redirecting the page to registration blade page after the registration*/
        return '/register'; 
    }
}
