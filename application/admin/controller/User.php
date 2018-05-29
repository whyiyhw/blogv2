<?php

namespace app\admin\controller;

use think\Request;
use \think\Validate;
use \think\Log;
use \think\Db;

class User extends Base
{
    public function userInfo()
    {
        $info = DB::table('db_user_info')->where(['user_id' => 1])->find();
        $info['user_path'] = addslashes($info['user_path']);
        return $this->fetch('user/info', ['title' => '用户信息', 'data' => $info]);
    }

    public function addInfo(Request $request)
    {
        $is_change = DB::table('db_user_info')->where(['id' => $request->param('id')])->find();

        $res = DB::table('db_user_info')->where(['id' => $request->param('id')])->update($request->param());

        if ($res === false) {
            return parent::ajaxReturn('', 0, '保存失败');
        }

        if ($is_change['user_path'] !== $request->param('user_path')) {
            //删除之前保存的图片
            Log::init([
                'type'  =>  'File',
                'path'  =>  APP_PATH.'logs/images/'
            ]);
            if (is_file($is_change['user_path'])) {
                if (!unlink($is_change['user_path'])) {
                    //记录日志 图片资源删除失败
                    Log::record('图片资源删除失败','error');
                }
                return parent::ajaxReturn();
            }
            //记录日志 图片资源未找到
            Log::record('图片资源未找到','error');

        }
        return parent::ajaxReturn();
    }

}