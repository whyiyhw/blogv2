<?php
namespace app\admin\controller;

use think\Request;
use think\Cache;
use think\Db;

class Index extends Base
{
    public function _initialize(Request $request = null)
    {
        parent::_initialize();
    }

    public function index()
    {
        $res = Db::table('db_user_login')->field('login_time,login_adderss')->order('login_time desc')->limit('1,1')->find();

        return $this->fetch('index',['title'=>'首页','time'=>date('Y-m-d',$res['login_time']),'address'=>$res['login_adderss']]);
    }

    //清理所有缓存
    public function cleanAll()
    {
        Cache::clear();
        $this->success('清除缓存成功','/adminprov/index');
    }

    public function loginLineTable()
    {
        //拿到最近七日的登录信息
//        return dump(1111111111);
        foreach ([1,2,3,4,5,6,7] as $key => $value ){
//            return dump($value);
            $start_time = strtotime('-' . $value . ' day');
            $end_time = $value === 1 ?time():strtotime('-' . ($value-1) .' day');
            $res[$key][] = $value;
            $res[$key][] = Db::table('db_user_login')->field('count(*) as num')->where($start_time .' < login_time and login_time < ' . $end_time)->select()['0']['num'];

        }
        return parent::ajaxReturn($res);
    }
}
