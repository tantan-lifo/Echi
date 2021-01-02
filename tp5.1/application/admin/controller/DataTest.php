<?php


namespace app\admin\controller;
use app\model\User as ModelUser;

class DataTest
{
    public function select()
    {
        $data = ModelUser::select();
        return json($data);
    }
}