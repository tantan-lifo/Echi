<?php


namespace app\regist\model;


use think\Controller;
use think\Model;

class Client extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'tp_client';
}