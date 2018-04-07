<?php
namespace Admin\Controller;
class ArticleController extends CommentController
{
    public function index()
    {
        #拿到分类列表
        $model = D('Category');
        $category = $model->getCategory();
        $this->assign('category', $category);

        #拿到文章列表
        $model = D('Article');
        $data = $model->listDate([],5);
        $this->assign('count', count($data['dates']));
        $this->assign('data', $data);
        $this->display();
    }

    public function add()
    {
        if (IS_POST) {
            $model = D('Article');
            #dump($model);die;
            $auto = array(
                array('a_publishtime', time(),),
            );
            $data = $model->auto($auto)->create();
            if (!$data) {
                $this->error($model->getError());
            }
            #dump($data);die;
            $res = $model->add($data);
            if (!$res) {
                $this->error('增加失败！');
            } else {
                $this->success('新增成功!', 'index');
            }
        } else {
            $model = D('Category');
            $category = $model->getCategory();
            $this->assign('category', $category);
            $this->display();
        }

    }


    public function edit()
    {
        if (IS_POST) {
            $model = D('Article');
            #dump($model);die;
            $auto = array(
                array('a_publishtime', time(),),
            );
            $data = $model->auto($auto)->create();
            if (!$data) {
                $this->error($model->getError());
            }
            #dump($data);die;
            $res = $model->save($data);
            #dump($res);die;
            if ($res === false) {
                $this->error('更新失败！');
            } else {
                $this->success('更新成功!', 'index');
            }


        } else {
            $id = intval(I('get.id'));
            if ($id <= 0) {
                $this->error('参数错误！');
            }
            #通过ID拿到数据
            $models = D('Article');
            $data = $models->getDataById($id);
            $data['a_content'] = htmlspecialchars_decode($data['a_content']);
            $this->assign('data', $data);

            #拿到分类列表
            $model = D('Category');
            $category = $model->getCategory();
            $this->assign('category', $category);

            $this->display();
        }

    }


    public function del()
    {
        $id = intval(I('get.id'));
        if ($id <= 0) {
            $this->error('参数错误！');
        }
        $model = D('Article');
        $res = $model->delete($id);
        if ($res != 1) {
            $this->error('删除失败！');
        } else {
            $this->success('删除成功!', '/Admin/Article/index/p/0');
        }
    }

}