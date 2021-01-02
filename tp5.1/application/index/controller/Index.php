<?php


namespace app\index\controller;
use app\index\controller\Base;
//use think\Controller;
use think\captcha\Captcha;
class Index extends Base
{
    public function index()
    {
        $this -> isLogin();
        return view();
    }
    public function hi()
    {
        return '---------';
    }
}