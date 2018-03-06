<?php
namespace Admin\Controller;
use Think\Controller;
class CommentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        //判断用户是否登录
        if(!session('user')){
            //说明用户没有登录
            $this->error('没有登录',U('Login/login'));
        }
    }
}