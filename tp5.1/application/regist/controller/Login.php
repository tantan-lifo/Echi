<?php


namespace app\regist\controller;



use app\regist\model\Client;
use think\Controller;
use think\View;

class Login extends Controller
{
    public function index()
    {
        /*$view = new View();
        return $view->fetch('index');*/
        return view('index');
    }

    public function login($user_name = '', $user_passwd = '')
    {
//      var_dump($user_name);die();


        $user = Client::get([
            'user_name' => $user_name,
            'user_passwd' => $user_passwd
        ]);
        if ($user) {
            echo '登录成功';
        } else {
            return $this->error('登录失败');
        }
    }
}

