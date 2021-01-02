<?php

namespace app\controller;

//增删改查
use app\model\User;
use think\Controller;
use think\Db;
use think\db\exception\DataNotFoundException;

class DataTest extends Controller
{
    public function select()
    {
        /*
         * 1.trycatch+findOrFail
         * try {
            $data = Db::table('tp_user')->where('id','127')->findOrFail();
            return json($data);
        }catch (DataNotFoundException $e){
            return '查询不到数据!';
        }*/
        //$data = Db::table('tp_user')->where('id','27')->findOrEmpty();

        //助手函数
        // $data = \db('user')->select();


        /*$data = Db::name('user')->column('username','27');
        return json($data);*/

        /*$user = Db::name('user');
        $data = $user->where('id','27')->find();
        //$data1 = $user->order('id', 'desc')->select();
        //remove是移除上次保存的数据
        $user->removeOption('where')->select();
        $data2 = $user->select();

        //return Db::getLastSql();
        return json($data2);*/

    }
    public function insert()
    {
        $data = [
            'username' => '辉夜',
            'password' => '123',
            'gender' => '女',
            'email' => 'qq@163.com',
            'price' => 90,
            'details' => '123',
            'create_time' => date('Y-m-d H:i:s')
        ];
        $insert = Db::name('user')->insert($data);
        //$insert = Db::name('user')->data($data)->insert();

        //return Db::getLastSql();
        return $insert;

    }
    public function insertAll()
    {
        $data = [
            [
                'username' => '辉夜 1',
                'password' => '123',
                'gender' => '女',
                'email' => 'huiye@163.com',
                'price' => 90,
                'details' => 123,
                'create_time' => date('Y-m-d H:i:s')
            ],
            [
                'username' => '辉夜 2',
                'password' => '123',
                'gender' => '女',
                'email' => 'huiye@163.com',
                'price' => 90,
                'details' => 123,
                'create_time' => date('Y-m-d H:i:s')
            ]
        ];
        Db::name('user')->insertAll($data);
    }
    public function update()
    {
        $data = [
            'username' => '路飞',
            'id'       => 20,
            'email'    => Db::raw('UPPER(email)'),
            'price'    => Db::raw('price-3')
        ];
        $update = Db::name('user')->update($data);
        return $update;
    }
    public function delete()
    {
        Db::name('user')->delete([233,234,225,235,236,237]);
    }

    public function getNoModelData()
    {
        //$data = Db::table('tp_user')->select();
        $data = Db::name('user')->select();
        return json($data);
    }
    public function getModelData()
    {
        $data = User::select();
        return json($data);
    }

}