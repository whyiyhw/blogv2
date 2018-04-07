<?php

namespace Admin\Controller;
class CategoryController extends CommentController
{
    public function index()
    {
        #分类列表详情
        $model = D('Category');
        $category = $model->getCategory();
        $this->assign('category', $category);

        #加上一个分页列表
        #拿到文章列表
        $model = D('Category');
        $data = $model->listDate('id>0',5);
        #dump($data['pagestr']);die;
        $this->assign('data', $data);

        $this->display();
    }

    #增加分类
    public function add()
    {
        if (IS_POST) {
            $model = D('Category');
            #dump($model);die;
            $data = $model->create();
            if (!$data) {
                $this->error($model->getError());
            }
            #dump($data);die;
            #需要判断 如果当前分类及其子分类下不存在此分类 才能添加
            $obj = $model->checkfenlei($data);
            if (!$obj) {
                $this->error('该分类下已存在此分类！');
            }
            $res = $model->add($data);
            if (!$res) {
                $this->error('添加失败！');
            }
            $this->success('添加成功！', 'index');
        } else {
            $model = D('Category');
            $category = $model->getCategory();
            $this->assign('category', $category);
            $this->display();
        }
    }

    #删除分类
    public function del($id)
    {
        $id = intval($id);
        if ($id <= 0) {
            $this->error('参数错误！');
        }
        $model = D('Category');
        $res = $model->dels($id);
        #dump($res);die;
        if (!$res) {
            $this->error('该分类下存在子分类，无法删除！');
        }
        $this->success('删除成功！','/Admin/Category/index/p/0');
    }


    //编辑页面
    public function edit()
    {
        if (IS_POST) {
            #实现更新操作
            $model = D('Category');

            $data = $model->create();
            if (!$data) {
                $this->error($model->getError());
            }
            #dump($data);die;
            $res = $model->update($data);
            #dump($res);die;
            if($res ===1){
                $this->error('该分类下已存在此分类');
            }elseif ($res ===2){
                $this->error('修改失败');
            }
            $this->success('修改成功！','index');
        } else {
            $id = intval(I('get.id'));
            if ($id <= 0) {
                $this->error('参数错误！');
            }

            $model = D('Category');
            $category = $model->getCategory();
            $this->assign('category', $category);

            $res = $model->find($id);
            if (!$res) {
                $this->error('参数错误！');
            }
            $this->assign('res', $res);
            $this->display();
        }
    }

}