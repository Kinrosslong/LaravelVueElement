<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome'); //laravel welcome页面
// });

//去掉vue#号 匹配所以的字符串路由
Route::any('{all}', function () {
    return view('layouts/master'); //路由指向 vue布局文件
})->where(['all' => '.*']);


Route::get('demo', 'PostController@demo');