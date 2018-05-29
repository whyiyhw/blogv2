<?php

namespace app\admin\controller;

use app\admin\model\UserLogin;
use \think\Controller;
use \traits\controller\Jump;
use \think\Url;
use \think\Db;
use \think\Request;
use \think\Validate;
use think\Session;

class login extends Controller
{
    use Jump;

    public function show()
    {
        //如果已登录 就直接进首页
        if (Session::has('name', 'admin')) {
            $this->redirect(Url::build('/adminprov/index'));
        }
        return $this->fetch('login');
    }

    public function login(Request $request)
    {

        //取到传递过来的参数 token验证
        $result = Validate::token('__token__', '', ['__token__' => input('post.__token__')]);
        if ($result === false) {
            $this->error('token值不正确', Url::build('/adminprov/login'));
        }

        //连接数据库 查询是否存在该用户是否存在
        $map = ['name' => input('post.user_name', '', 'addslashes')];
        $res = Db::table('db_user')->field('id,salt,password')->where($map)->find();

        //验证账号密码
        if (!$res) {
            $this->error('帐号或密码错误', Url::build('/adminprov/login'));
        }

        if (md5($res['salt'] . input('post.user_password', '', 'md5')) !== $res['password']) {

            $this->error('帐号或密码错误', Url::build('/adminprov/login'));
        }

        //存在就 存入session
        Session::set('name', 'admin', 'admin');

        //拿到ip 根据ip 查到对应的城市
        $ip = $request->ip();
        if ($ip === '127.0.0.1') {
            $city = '本地';
        } else {
            $url = config('xin_lang_ip_api') . $ip;
            $haystack = file_get_contents($url);
            $result = rtrim(substr($haystack, strpos($haystack, '{')), ';');
            $city = json_decode($result)->city;
        }

        //拼接数据 插入user_login 表
        $data = [
            'user_id' => $res['id'],
            'login_adderss' => $city?$city:'未知',
        ];
        $outcome = (new UserLogin($data))->save();
        if ($outcome === false){
            $this->error('登录失败', Url::build('login/login'));
        }
        //重定向
        $this->redirect(Url::build('/adminprov/index'));
    }

    public function loginOut()
    {
        //清空admin作用域下的session
        Session::clear('admin');
        //重定向
        $this->redirect(Url::build('/adminprov/login'));
    }


    //增加后台用户
    public function userAdd()
    {
        $password = md5('123456');
        $salt = mt_rand(111111, 999999);
        $password = md5($salt . $password);
        Db::execute(
            'insert into db_user (name,password,salt,created_time,update_time) values (:name,:password,:salt,:created_time,:update_time)',
            [
                'name' => 'admin',
                'password' => $password,
                'salt' => $salt,
                'created_time' => time(),
                'update_time' => time(),
            ]
        );
    }
}