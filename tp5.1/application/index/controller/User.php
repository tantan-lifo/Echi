<?php


namespace app\index\controller;
use think\captcha\Captcha;
use app\index\controller\Base;
//use think\Session;
use think\facade\Session;
use think\Validate;
use think\Request;
use app\index\model\User as UserModel;
class User extends Base
{
    public function login()
    {
        $this -> alreadyLogin();    //防止重复登录
        return view();
        //return $this->view->fetch();

    }
    public function checkLogin(Request $request)
    {
        //初始返回参数
        $status = 0;
        $result = '';
        $data = $request -> param();

        $rule = [
            'name|姓名' => 'require',
            'password|密码' => 'require',
            'verify|验证码' => 'require|captcha',
        ];
        $msg = [
            'name' => ['require'=>'用户名不能为空，请检查'],
            'password' => ['require'=> '密码不能为空，请检查'],
            'verify' => [
                'require'=>'验证码不能为空，请检查',
                'captcha'=>'验证码错误'
            ],
        ];

        $result = $this -> validate($data,$rule,$msg);
        //return ['status'=>$status, 'message'=>$result,'data'=>$data];
        if(true === $result){
            $map = [
                'name' => $data['name'],
                'password' => $data['password']
            ];

            //查询用户信息
            $user = UserModel::get($map);
            if(null === $user){
                $result = '没有该用户,请检查';
            }else{
                $status = 1;
                $result = '验证通过，点击[确定]进入';
            //设置用户登录信息用session
                /*Session::set('user_id',$user['id']);
                Session::set('user_info.name',$user['name']);*/
                Session::set('user_id',$user->id);
                Session::set('user_info',$user->getData());
            }


        }
        return ['status'=>$status, 'message'=>$result, 'data'=>$data];

    }

    public function logout()
    {
        Session::delete('user_id');
        Session::delete('user_info');
        $this -> success('注销登录，正在返回','user/login');
    }
}