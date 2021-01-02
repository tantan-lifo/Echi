<?php

namespace app\controller;


class HelloWorld
{
    public function index()
    {
        return 'hello,world';
    }
    public function hello($name='Think')
    {
        return 'hello'.$name;
    }

}