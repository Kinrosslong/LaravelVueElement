<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; //复制测试的
use Illuminate\Auth\AuthenticationException; //复制测试的

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // return parent::render($request, $exception); //原laravel5.5 原生代码


        // 参数验证错误的异常，我们需要返回 400 的 http code 和一句错误信息 这些是复制的 原文没有的 可以删除
        // if ($exception instanceof ValidationException) {
        //     return response(['error' => array_first(array_collapse($exception->errors()))], 400);
        // }
        // // 用户认证的异常，我们需要返回 401 的 http code 和错误信息 这些是复制的 原文没有的 可以删除
        // if ($exception instanceof UnauthorizedHttpException) { 
        //     return response($exception->getMessage(), 401); 
        // }

        //判断如果是Ajax请求就走这里
        if($request->ajax()) {
//        if(Request()->ajax()) { //这里也是可以的
            return response()->json([
                'status'=> $exception->status,
                'msg' => $exception->getMessage(),
                'errors' => $exception->errors(),
            ], $exception->status);
        }

        return parent::render($request, $exception);
    }


    //抄袭代码 这个应该是验证用户权限验证
    // protected function unauthenticated($request, AuthenticationException $exception)
    // {

    //     if($request->expectsJson()){
    //         $response=response()->json([
    //                 'status'=>3,
    //                 'msg' => $exception->getMessage(),
    //                 'errors'=>[],
    //             ], 200);
    //     }else{
    //         $response=redirect()->guest(route('login'));
    //     }
    //     return $response;
    // }

    // 抄袭代码 这个是验证提交参数
    // protected function invalidJson($request, ValidationException $exception)
    // {
    //     return response()->json([
    //         'status'=> $exception->status,
    //         'msg' => $exception->getMessage(),
    //         'errors' => $exception->errors(),
    //     ], $exception->status);
    // }
    
}
