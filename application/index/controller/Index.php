<?php
namespace app\index\controller;

use think\Request;
use think\Db;
use think\Cache;
use think\Url;

class Index extends Base
{
    public function vueIndex()
    {
        return $this->fetch('vue_index');
    }

    public function index(Request $request)
    {
        $page = $request->param('page')?$request->param('page'): 1;

        if(!Cache::get('indexPage'.$page)){
            $list = Db::table('db_article')->field('id,title,cate_id,description,tag,path_url,create_time')->order('sort desc')->paginate(3);
            Cache::set('indexPage'.$page,$list);
        }

        $this->assign('list', Cache::get('indexPage'.$page));
        return $this->fetch('index',['title'=>'首页']);
    }


    public function articleDetail(Request $request)
    {
        $id = $request->param('id');

        if ($id) {

            if (!Cache::get('article'.$id)){

                $res = Db::table('db_article')->where(['id'=>$id])->find();
                if (!$res) {
                    redirect(Url::build('index/index'));
                }
                Cache::set('article'.$id,$res);
            }

            return $this->fetch('article',['title'=>'博文列表','data'=>Cache::get('article'.$id)]);
        }
    }

    public function category(Request $request)
    {
        $cateName = $request->param('cate');

        //一级缓存
        if (!Cache::get('indexCategoryWhere'.$cateName)){
            $id = Db::table('db_category')->field('id')->where(['name'=>$cateName])->find()['id'];

            $ids = Db::table('db_category')->field('id')->where(['f_id'=>$id])->select();

            foreach ($ids as $k){
                $all_id[] =$k['id'];
            }

            Cache::set('indexCategoryWhere'.$cateName,$all_id);
        }

        $where['cate_id'] = ['in', Cache::get('indexCategoryWhere'.$cateName)];

        //二级缓存
        $page = $request->param('page');
        if (!$page){
            $page = 1;
        }

        if(!Cache::get('indexCategory'.$cateName.'page'.$page)){

            $list = Db::table('db_article')->field('id,title,cate_id,description,tag,path_url,create_time')->where($where)->order('sort desc')->paginate(3);

            Cache::set('indexCategory'.$cateName.'page'.$page,$list);
        }


        $this->assign('list', Cache::get('indexCategory'.$cateName.'page'.$page));
        return $this->fetch('index',['title'=>'文章分类']);
    }

    public function vue()
    {
        return $this->fetch('vue');
    }

    public function tag(Request $request)
    {
        $tagName = $request->param('tag');

        $page    = $request->param('page')?$request->param('page'):1;

        if(!Cache::get('indexTag'.$tagName.'page'.$page)){

            $list = Db::table('db_article')
                ->field('id,title,cate_id,description,tag,path_url,create_time')
                ->where(['tag'=>$tagName])
                ->order('sort desc')
                ->paginate(3);

            Cache::set('indexTag'.$tagName.'page'.$page,$list);
        }

        $this->assign('list', Cache::get('indexTag'.$tagName.'page'.$page));
        return $this->fetch('index',['title'=>$tagName]);
    }

    public function search(Request $request)
    {
        $keyword = $request->param('top-search')?$request->param('top-search'):'';
        $page    = $request->param('page')?$request->param('page'):1;
        if ($keyword === '') {
            redirect(Url::build('index/index'));
        }

        if(!Cache::get('indexSearch'.$keyword.'page'.$page)){

            $map['title']=['like','%'.$keyword.'%'];

            $list = Db::table('db_article')
                ->field('id,title,cate_id,description,tag,path_url,create_time')
                ->where($map)
                ->order('sort desc')
                ->paginate(3);

            Cache::set('indexSearch'.$keyword.'page'.$page,$list);
        }

        $this->assign('list', Cache::get('indexSearch'.$keyword.'page'.$page));
        return $this->fetch('index',['title'=>$keyword]);
    }
}
