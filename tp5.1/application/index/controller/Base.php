<?php


namespace app\index\controller;


use think\Controller;
use think\facade\Session;

class Base extends Controller
{
    protected function initialize()
    {
        //继承了Base的控制器会直接调用本条操作(初始化)
        parent::initialize();

        define('USER_ID', Session::has('user_id') ? Session::get('user_id'):null);
        //define('user','name');
    }

    //判断用户是否登陆,放在系统后台入口前面: index/index
    protected function isLogin()
    {
        if (is_null(USER_ID)) { //null即true

            $this -> error('用户未登陆,无权访问',url('user/login'));
            //$this -> error('用户未登陆,无权访问',url('app/hello/hello'));
        }
    }

    //防止用户重复登陆,放在登陆操作前面:user/login
    protected function alreadyLogin(){
        if (!is_null(USER_ID)) {
            $this -> error('用户已经登陆,请勿重复登陆',url('index/index'));
        }
    }
}