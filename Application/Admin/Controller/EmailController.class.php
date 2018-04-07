<?php
namespace Admin\Controller;
class EmailController extends CommentController {
    //邮件列表展示
    public function index()
    {
        $count = M("email")->count("id");
        $page = new \Think\Page($count,C("Email_page"));
        //获取分页导航数据
        $page->setConfig('prev',"上一页");
        $page->setConfig('next',"下一页");
        $show = $page->show();
        //获取当前的页码
        $p = intval(I('get.p'));
        //获取具体的数据
        $date = M("email")->order("appointment_time")->Page($p, C("Email_page"))->select();
        //分页结束
        $this->assign("list",$date);
        $this->assign("page",$show);
        $this->display();
    }

    public function add()
    {
        if(IS_POST){

        }else{
            $this->display();
        }
    }
}