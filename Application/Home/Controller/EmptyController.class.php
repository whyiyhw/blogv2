<?php
namespace Home\Controller;
use Think\Controller;
class EmptyController extends Controller
{
	//定义空方法 防止误操作
    public function index(){
        redirect(U("Home/Index/index"));
    }
}