<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $title   = trim(addslashes(I('get.title')));
        $c_name  = trim(addslashes(I('get.c_name')));
        $c_id      = I('get.id');
        $where = '';
        if(!empty($c_id)&&$c_id<=0){
            $this->error('参数错误!');
        }else{
            if($c_id !== ''){
                $where = 'c_id ='."$c_id";
            }
        }
        //标题搜索
        if(!empty($title)){
            $where = 'a_title ='."'$title'";
        }
        //分类检索
        if(!empty($c_name)){
            $where = 'a_name ='."'$c_name'";
        }
        //分页静态化
        $page = I('get.p');
        #列表详情
        $model = D('Admin/article');
        if(S('list_fir'.$where.$page) ){
            $data =S('list_fir'.$where.$page);
        }else{
            $data  = $model->listDate($where,5,"a_publishtime desc");
            S('list_fir'.$where.$page,$data,360000);
        }

        foreach($data['date'] as $k => $v){
            $data['date'][$k]['a_content'] =  strip_tags(htmlspecialchars_decode($v['a_content']));
        }
        $this->assign('data', $data);
        #最近两条博文
        $new = $model->field('id,a_name')->order("a_publishtime desc")->limit(2)->select();
        $this->assign('new', $new);
        #分类详情
        $model = D('Admin/category');
        $category = $model->getCategory();
        $this->assign('category', $category);
        //页面展示
        $this->display();
    }

    public  function article()
    {
        $model = D('Admin/Article');
        $id = intval(I('get.id'));
        $cat =$model->getDataById($id);
        $this->assign('cat', $cat);

        $model = D('Admin/category');
        $category = $model->getCategory();
        $this->assign('category', $category);

        $this->display();
    }

    public function addstra()
    {

        if(!$_POST) exit;
        $id  = I('post.id');
        if(!$id) exit;
        $ip  = $_SERVER["REMOTE_ADDR"];
        $data = json_decode(cookie($id));
        if( in_array($ip,$data)){
            echo json_encode(['status'=>2,'msg'=>'已经点过赞了哦']);
        }else{
            if ($data) $data = [];
            $data[] = $ip;
            if(M('article')->where('id = '.$id)->setInc('a_zan') !== false ){
                echo json_encode(['status'=>1,'msg'=>'成功点赞']);
                cookie($id,json_encode($data));
            }else{
                echo json_encode(['status'=>2,'msg'=>'点赞失败']);
            }
        }
    }

    //聊天室
    public function chat()
    {
        $this->display();
    }

}