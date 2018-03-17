<?php
namespace App\Http\Proxy;

class TokenProxy {

    protected $http;

    public function __construct(\GuzzleHttp\Client $http)
    {
        $this->http = $http;
    }
    /**
     * @desc 用来做代理登陆获取token
     * @Date: 2018-03-17
     * @return mixed
     */
    public function proxy($grantType, array $data = []) 
    {   
        $param = array_merge($data, [
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'grant_type' => $grantType,
            // 'scope' => '',
        ]);

        $response = $this->http->post('http://laravelvueelement.com:8080/oauth/token', [
            'form_params' => $param
        ]);
        $token = json_decode((string) $response->getBody(), true);
        return response()->json([
            'token' => $token['access_token'],
            'expires_in' => $token['expires_in']
        ])->cookie('refreshToken', $token['refresh_token'], 86399, null, null, false, true);
    }


    public function login($email, $password)
    {   
         if(Auth()->attempt(['email' => $email, 'password' => $password, 'is_active' => 1])) {
             return $this->proxy('password', [
                 'username' => $email,
                 'password' => $password,
                 'scope' => ''
             ]);
         }

        return response()->json([
            'status'=> false,
            'msg' => '登陆失败',
        ],421);
    }
}