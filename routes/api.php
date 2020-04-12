<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Routes for registraion and login 
Route::post('/register','Api\AuthController@register');
Route::post('/login','Api\AuthController@login');

//Routes for storing driver locations
// Route::post('/driverLocation','Api\AuthController@driverLocation');

//Storing and updating the drivers co-ordinates
Route::post('/driverLocation', 'Api\AuthController@driverLocation');

//Routes for forgot password and reset password
Route::post('/password/email', 'Api\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'Api\ResetPasswordController@reset');


Route::post('/drivercoordinates','Api\AuthController@drivercoordinates');

// Route::match(['get','post'],'/update/{email}','Api\AuthController@updatePassword');

