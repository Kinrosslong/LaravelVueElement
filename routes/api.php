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

// Route::get('/posts', 'PostController@index'); get请求
Route::post('/posts', 'PostController@index'); //post请求
Route::get('/posts/{post}', 'PostController@show');
Route::post('/verify', 'PostController@verify'); //测试Laravel validate 表单验证