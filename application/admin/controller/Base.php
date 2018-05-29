<?php

namespace app\admin\controller;

use think\Controller;
use think\Session;
use traits\controller\Jump;
use think\Url;
use think\Cache;
use think\Db;

class Base extends Controller
{
    use Jump;

    public function _initialize()
    {
        parent::_initialize();

        if (!Session::has('name', 'admin')) {
            /*
             * 两种或者是更多的方式来做重定向  但实质就做了一件事
             * 给Response对象的属性赋值  并调用对应方法响应
             * 虽然框架使用了function_exists 来做了大量助手函数
             * 这一点 好与不好我也说不清楚,感觉我更适合将关系全部说清楚的方式
             * 你也可以使用 trait来进行跳转逻辑处理 比如说封装自己的跳转类,验证类...
             * redirect();//直接调用Response类的create静态方法
             */
            $this->redirect(Url::build('/adminprov/login'));
            //使用了Jump特效的方法调用redirect类(继承于Response类)
        }

        //开启缓存
        $options = [
            // 缓存类型为File
            'type' => 'File',
            // 缓存有效期为永久有效
            'expire' => 0,
            //缓存前缀
            'prefix' => '',
            // 指定缓存目录
            'path' => APP_PATH . 'runtime/cache/',
        ];
        Cache::connect($options);
        //缓存后台节点
        $this->assign('nodeList', $this->getNodeList());
        //将登陆的用户信息 信息取出
        $user = Db::table('db_user_info')->find();
        $this->assign('userInfo', $user);
    }

    public static function ajaxReturn($info = '', $status = 1, $msg = 'success')
    {
        header('Content-type: application/json');
        $data['data'] = $info;
        $data['status'] = $status;
        $data['msg'] = $msg;
        return json_encode($data);
    }

    public function getNodeList()
    {
        $ids = [];
        if (!Cache::get('adminNode')) {
            $res = Model('Node')->where(['f_id' => 0, 'status' => 1])->order('sort desc')->select();

            foreach ($res as $k => $v) {
                $ids[$k]['f_node'] = $v;
                $outcome = Model('Node')->where(['f_id' => $v['id']])->order('sort desc')->select();


                if ($outcome) {
                    foreach ($outcome as $key => $value) {
                        $ids[$k]['z_node'][] = $value;
                    }
                } else {
                    $ids[$k]['z_node'] = '';
                }

            }
            Cache::set('adminNode', $ids);
        }

        return Cache::get('adminNode');
    }

}