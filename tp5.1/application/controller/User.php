<?php


namespace app\controller;



use think\Controller;
use app\admin\model\User as UserModel;

class User extends Controller
{
//    // 创建用户数据页面
//    public function create()
//    {
//        return $this->fetch('user');//加载模板，会自动找到view下的user的user.html并显示
//    }

// 创建用户数据页面
    public function create()
    {
        return view('user');//加载模板，会自动找到view下的user的user.html
    }

// 新增用户数据
    public function add()
    {
       // $user = new UserModel;
//        $user = Db::table('user');
//        return json_encode($_POST);
        return 'sss';
//        if ($user->allowField(true)->save($_POST)) {//input('post.'))为表单提交的数据
//            return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
//        } else {
//            return $user->getError();
//        }
    }

    // model的助手函数新增用户数据
    public function add3()
    {
        // 使用model助手函数实例化User模型
        $user = model('User');
// 模型对象赋值
        $user->data([
            'nickname' => 'SWE',
            'email' => 'thinkphp@qq.com'
        ]);
        if ($user->save()) {
            return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
        } else {
            return $user->getError();
        }
    }
}

