<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class BackendController extends Controller
{

    public function index()
    {   
        $route = Route::current();

        $name = Route::currentRouteName();

        $action = Route::currentRouteAction();

        // dd($route);
        // dd($name);
        // dd($action);

        echo url("/posts/1");

        // 获取没有查询字符串的当前的 URL ...
        dump (url()->current());

        // 获取包含查询字符串的当前的 URL ...
        dump(url()->full());

        // 获取上一个请求的完整的 URL...
        dump(url()->previous());


        echo URL::current();

        // $url = action('HomeController@index');
    }

    public function demo()
    {
        echo 'backend_demo';
    }
   
}
