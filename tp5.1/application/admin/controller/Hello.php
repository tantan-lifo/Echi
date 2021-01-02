<?php


namespace app\admin\controller;


class Hello
{
    public function hello()
    {
        return 'Hello!';
    }
    public function hi($name)
    {
        return 'hello'.$name;
    }
    public function test()
    {
        echo "1";
    }
}