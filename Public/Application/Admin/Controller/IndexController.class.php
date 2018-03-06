<?php
namespace Admin\Controller;
class IndexController extends CommentController {

    public function index(){
        $this->display();
    }
    public function welcome()
    {
        $id    = session('id');
        $obj   = M('adminLogin');
        $count = $obj->where(['a_username'=>$id])->count("id");
        $data = $obj->where(['a_username'=>$id])->order("login_time desc")->limit(2)->select();
        $this->assign("times",$count);
        $this->assign("first",$data[0]);
        $this->assign("last" ,$data[1]);
        $this->display("Index/welcome");
    }

}