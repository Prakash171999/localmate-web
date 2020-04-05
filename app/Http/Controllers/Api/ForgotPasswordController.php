<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    | 
    */

    use SendsPasswordResetEmails;

    // protected function sendResetLinkResponse(Request $request, $response)
    // {
    //     $data = ['success'=> $response];
    //     return response(['message'=> $data]);
    // }

    // protected function sendResetLinkFailedResponse(Request $request, $response)
    // {
    //     $datas = ['fail'=> $response];
    //     return response(['error'=> $datas], 422);
    // }

}
