<!doctype html>
<!--vue 初始化页面布局 入口文件-->
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Vue</title>
        <link rel="stylesheet" href="/css/app.css">
        {{--  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">  --}}
        <link rel="alternate icon" type="image/x-icon" href="/favicon.ico"/>
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
