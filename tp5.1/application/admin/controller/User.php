<?php


namespace app\admin\controller;

//访问路径：http://localhost/tp5.1/public/admin/user/create
//出现错误：模板文件不存在:E:\wamp\www\tp5.1\application\admin\view\user\user.html

use think\Controller;
use app\model\User as UserModel;

class User extends Controller
{


// 创建用户数据页面
    public function create()
    {

        //return $this->fetch('user');//加载模板，会自动找到view下的user的user.html
        return view('user');//加载模板，会自动找到view下的user的user.html
    }

// 新增用户数据
    public function add()
    {

        $user = new UserModel;
//        $user = Db::table('user');
        if ($user->allowField(true)->save($_POST)) {//input('post.'))为表单提交的数据
            return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
        } else {
            return $user->getError();
        }
    }

    // model的助手函数新增用户数据
    public function add3()
    {
        // 使用model助手函数实例化User模型
        $user = model('User');
        //$user = new UserModel;作用与上句相同

        // 模型对象赋值
        $user->data([
            'nickname' => 'test2',
            'email' => '150@qq.com',
            'birthday' => '321'
        ]);
        if ($user->save()) {
            return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
        } else {
            return $user->getError();
        }
    }
    public function test0()
    {
        return '------';
    }
    public function test1()
    {
        $result =  \Db::connect('db_config1')->table('tp_role')->select();
        return json($result);
    }
}

