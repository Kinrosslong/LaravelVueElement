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

/*
    laravel 原生路径  测试使用
*/
Route::get('/backend', 'BackendController@index');
Route::get('/backend/demo', 'BackendController@demo');
Route::get('/foo/index', function () {
    return 'Hello World';
});

Route::get('tencent/{id}', function ($id = null) {
    return "Tencent ". $id;
});

Route::get('testmiddleware/{age}', 'BackendController@testmiddleware');
Route::get('urltest', 'BackendController@urltest');
Route::get('redir', 'BackendController@redir');
Route::get('welcome', 'BackendController@welcome');
Route::get('redis', 'BackendController@redis');
Route::get('phpinfo', 'BackendController@phpinfo');
Route::get('fromvalid', 'BackendController@fromvalid');
Route::get('demo', 'BackendController@demo');




// Route::get('/posts', 'PostController@index'); //指定路由

//去掉vue#号 匹配所有的字符串路由
Route::any('{all}', function () {
    return view('layouts/master'); //路由指向 vue布局文件
})->where(['all' => '.*']);


// Route::get('demo', 'PostController@demo');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
