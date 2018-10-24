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

Route::middleware('auth:api')->get('/student',function(Request $request){
    return $request->student();
});
Route::middleware('auth:api')->get('/studentlist',function(Request $request){
    return $request->studentlist();
});

Route::apiResources(['user'=>'API\UserController']);
Route::apiResources(['student'=>'API\StudentController']);
Route::apiResources(['studentlist'=>'API\StudentListController']);

Route::get('profile','API\StudentController@student');
// Route::put('profile','API\StudentController@updateProfile');
