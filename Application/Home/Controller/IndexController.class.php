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

        if(!empty($title)){
            $where = 'a_title ='."'$title'";
        }

        if(!empty($c_name)){
            $where = 'a_name ='."'$c_name'";
        }


        #列表详情
        $model = D('Admin/article');
        #dump($model);die;

        $data = $model->listDate($where,2,1);

        foreach($data['date'] as $k => $v){
            $data['date'][$k]['a_content'] =  strip_tags(htmlspecialchars_decode($v['a_content']));

        }
        //$data['date'][0]['a_content'] = strip_tags(htmlspecialchars_decode(($data['date'][0]['a_content'])));
        //$data['date'][1]['a_content'] = strip_tags(htmlspecialchars_decode(($data['date'][1]['a_content'])));
        //dump($data['date'][0]['a_content'] ); die;
        //dump($data['date']);die;
        $this->assign('data', $data);
        #最近两条博文
        $new = $model->order("a_publishtime desc")->limit(2)->select();
        $this->assign('new', $new);

        #分类详情
        $model = D('Admin/category');
        $category = $model->getCategory();
        $this->assign('category', $category);

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
        $ip = $_SERVER["REMOTE_ADDR"];
        if(session("$ip") === 1){
            $this->ajaxretrun =0;
        }else{
            session("$ip",1);
            $this->ajaxretrun = M('article')->setInc('a_zan');
        }
    }

}