<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Middleware\CheckForm;
// use Illuminate\Http\UploadedFile
use Illuminate\Support\Facades\Auth;

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

        dump( __DIR__);
        // dd(__DIR__);
        // dd(123456);
        // $url = action('HomeController@index');
    }

    public function demo()
    {
        echo 'backend_demo';
        $str = '4515216s541';
        if(!preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9a-zA-Z]+$/', $str)) {
            echo '假的';
        } else {
            echo '真的';
        }
        date_default_timezone_set('Asia/Shanghai');
        $provider = 885544;
        $m = date('m');
        $d = date('d');
        $h = date('h:i');
        echo date("Y-m-d H:i:s");                   
        echo "【众汇金融】您的MT4账户{$provider}于{$m}月{$d}日{$h}更换了密码。如非本人操作，请及时登录MyZFX修改密码。";
        echo "<hr/>";
        $arr['errMsg'] = 123;
        
        echo isset($arr['errMsg']) ? $arr['errMsg'] : 'error';
    }
   

    public function testmiddleware(CheckForm $request)
    {
        dd($request);
        // echo 'lkfjadlkfjs';
    }




    //测试表单验证
    public function fromvalid(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:5',
            'body' => 'required'
        ]);


    }

    public function urltest(Request $request) 
    {   
        dump($request->input('id'));
        dump($request->path());
        dump($request->url());
        dump($request->fullUrl());

        dump($request->all());
        dump($request->name);
    }

    // public function agentlist()
    // {
    //     new Agent::get
    // }


    /**
     * 创建响应
     * 响应方法都是可链式调用的
     * 为响应增加 Cookie
     * @return array
     */
    public function redir() 
    {
        
        // return response('Hello World', 200)
        //           ->header('Content-Type', 'text/plain')
        //           ->cookie('name', 'kinross', 2);
        // return Redirect('about');

        // return redirect()->action('PostController@about');


        $arr = null;
        if($arr == null) {
            dump($arr);
        }

        dump(date('Y-m-d H:i:s', time()));
        $length = 8;
        $str = substr(md5(substr(uniqid(),-6)), 0, $length);
        dump($str);

        $strLength = strlen($str);
        dump($strLength);
        $re = []; //定义接受字符串的数组
        for ($x = 0; $x < strlen($str); $x++) {
            // echo "数字是：$x <br>";
            $re[] = substr($str,$x,1); //将单个字符存到数组当中
        }

        dump($re);

        // $str = substr(md5(time()), 0, $length);//md5加密，time()当前时间戳  
        // dump($str);  

        $str='abcdefghjkmnpqrstuvwxyz23456789';  
        // $randStr = str_shuffle($str);//打乱字符串  
        // $rands= substr($randStr,0,$length);//substr(string,start,length);返回字符串的一部分  

        $str = substr(str_shuffle($str), 0, $length);

        dump($str);  

        
    }

    public function welcome()
    {
        $users = DB::table('posts')->paginate(5);
        return view('welcome', ['lists' => $users]);
    }


    public function redis(Request $request)
    {
        // $value = $request->session()->put('hunan_sy', 'long_kinross');
        $value = $request->session()->get('hunan_sy');
        dump($value);

        $data = $request->session()->all();
        dump($data);

    
        Redis::set('name', 'Taylor');
        echo Redis::get('name');
    }

    public function phpinfo()
    {    
        $user = Auth::user();
        dump($user);

        if(Auth::check()) {
            echo 123;
        }

        if (Auth::attempt(['email' => '576722269@qq.com', 'password' => 'kinross219219'])) {
            // 认证通过...
            echo 'success';
        }

        $data = DB::table('posts')->where('title', '=', 'this is test')->get();
        dump($data);
        echo "<hr/>";
        $item = DB::table('posts')->limit(10)->get();
        dump($item);
        dump($item->toJson());
        // phpinfo(); 
    }


    public function authuser()
    {
        $user = Auth::user();
        dump($user);
    }

    public function mactest()
    {
        echo "试试 mac上的git提交";
        echo "试试拉取"；
        echo "试试拉取"；
        echo "Mac pc端编辑"；
        echo “mac test”；
        echo "mac test"；
    }





}
