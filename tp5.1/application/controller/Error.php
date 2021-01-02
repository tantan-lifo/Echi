<?php


namespace app\controller;


use think\Request;

class Error
{
    public function index()
    {
        return '当前控制器不存在';
    }
}