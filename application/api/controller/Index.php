<?php
namespace app\api\controller;

use think\Request;
use think\Db;
use think\Url;
use think\Controller;

class Index extends Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin:*');

    }

    public function title(Request $request)
    {
//        $res = Db::table('db_category')->where(['f_id'=>0])->select();

        //查找分类
        $p_res = Db::table('db_category')->field('id,name')->where(['f_id'=>0])->select();
        //二维转一维
        $ids = [];
        foreach($p_res as $v){
            $ids[] = $v['id'];
            $data['category'][$v['id']]['name'] = $v['name'];
        }

        $map['f_id'] = ['in',$ids];
        //根据id再次取值
        $z_res = Db::table('db_category')->where($map)->select();

        //进行分组
        foreach($z_res as $key => $v){
            $data['category'][$v['f_id']][$v['f_id']][] = $v;
        }

        foreach($data['category'] as $ks => $vs){
            $vs['f_id'] = (string)$ks;
            $outcome[] = $vs;
        }
        unset($data['category']);
        $data['category'] = $outcome;
        $data['data'] = $z_res;

        return $this->ajaxRetrun($data);
    }

    public function ajaxRetrun($data,$status = 1,$msg = 'success'){
        $map = ['data'=>$data,'status'=> $status,'msg'=>$msg];
        header("Content-Type:application/json");
        return json_encode($map);
    }

    public function articleList(Request $request)
    {
        $where = [];
        $limit = 6;
        $data = [];
        //页数
        if ($request->param('page')) {
            $page = $request->param('page');
            $offset = ($page-1)*6;
            $limit = $offset.','.'6';
        }
        //分类ID
        if ($request->param('cate_id')) {
            $where = ['cate_id' => $request->param('cate_id')];
        }

        $res = Db::table('db_article')
            ->field('id,title,tag,description,path_url,create_time')
            ->where($where)
            ->order('sort desc')
            ->limit($limit)->select();

//        $result = Db::table('db_article')
//            ->field('count(*) as num')
//            ->where($where)
//            ->order('sort desc')
//            ->select();
//        return dump($result);

        foreach ($res as $k=>$v){
            $data[$k]['id'] = $v['id'];
            $data[$k]['title'] = $v['title'];
            $data[$k]['tag'] = strpos($v['tag'],',') !== false?explode($v['tag'],','):$v['tag'];
            $data[$k]['description'] = $v['description'];
            $data[$k]['path_url'] = 'https://www.xueyi777.top/' . $v['path_url'];
            $data[$k]['create_time'] = date('Y-m-d',$v['create_time']);
//            $data[$k]['num'] = $result[0]['num'];
       }

        return $this->ajaxRetrun($data);

    }
}
