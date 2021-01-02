<?php


namespace app\controller;


use think\Controller;

class Before extends Controller
{
    protected $flag=true;
    protected $beforeActionList=
        [
        'first',
        'second'=>['except'=>'one'],
        'third'=>['only'=>'one,two']
        ];
    protected function first()
    {
        echo 'first!';
    }
    protected function second()
    {
        echo 'second!';
    }
    protected function third()
    {
        echo 'third!';
    }
    public function index()
    {
        if($this->flag) {
            $this->success('注册成功！', '../');
        }else{
            $this->error('失败！');
        }

        return 'index';
    }
    public function _empty($name)
    {
        return '此方法不存在:'.$name;
    }
    public function one()
    {
        return 'one!';
    }
    public function two()
    {
        return 'two!';
    }
    public function three()
    {
        return 'third!';
    }
}