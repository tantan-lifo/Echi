<?php


namespace app\index\controller;
use app\index\model\User;
use think\view;
use think\Controller;
class Regist extends Controller
{
    public function index()
    {
        /*$view = new view();
        return $view->fetch('index');*/
        return view('index');
    }
    public function regist(){
        //实例化User
        $user = new User();
        //接收前端表单提交的数据
        $user->name = input('post.name');

        $user->password = input('post.password');
//进行规则验证
        $result = $this->validate(
            [
                'name' => $user->name,

                'password' => $user->password,
            ],
            [
                'name' => 'require|max:10',

                'password' => 'require',
            ]);
        if (true !== $result) {
            $this->error($result);
        }
        //写入数据库
        if ($user->save()) {
            return $this->success('注册成功！','app/index/user/login');
        } else {
            return $this->success('注册失败');
        }
    }
}