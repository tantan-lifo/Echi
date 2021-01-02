<?php


namespace app\index\controller;


use app\index\model\User;
//use app\model\User ;
use think\Controller;
class Content extends Controller
{
    public function comment()
    {
        return view('two');
    }
    public function add()
    {
        $user = new User();
//        $user = Db::table('user');
        if ($user->allowField(true)->save($_POST)) {//input('post.'))为表单提交的数据
            return $this->success('留言成功!','index/index/index');
        } else {
            return $user->getError();
        }
    }
    public function image()
    {

    }
    public function manager()
    {

    }
}