<?php
namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Validate;

class Category extends Base
{
    private $category;

    public function _initialize(Request $request = null)
    {
        parent::_initialize();
        $this->category = model('Category');
    }

    public function categoryList()
    {
        $list = $this->category->paginate(10);

        return $this->fetch('list', ['title' => '博文分类列表', 'list' => $list]);
    }

    public function categoryAdd(Request $request)
    {
        if ($request->method() === 'POST') {

            $validate = new Validate([
                'name' => 'require|max:25',
                'f_id' => 'require|number',
                'sort' => 'require|number'
            ],
                [
                    'name.require' => '节点名不能为空',
                    'name.max' => '节点名最多25个字符',
                    'f_id.number' => '父节点必须是数字',
                    'sort.number' => '排序必须是数字',
                ]);

            if (!$validate->check($request->param())) {
                return parent::ajaxReturn('', 0, $validate->getError());
            }

            //数据入库

            $res = $this->category->data($request->param())->save();

            if ($res) {
                return parent::ajaxReturn();
            }

            return parent::ajaxReturn('', 0, '新增失败');
        }

        return $this->fetch('add', ['title' => '博文分类新增']);
    }

    public function categoryEdit(Request $request)
    {
        if ($request->method() === 'POST') {

            $validate = new Validate([
                'name' => 'require|max:25',
                'f_id' => 'require|number',
                'sort' => 'require|number'
            ],
                [
                    'name.require' => '节点名不能为空',
                    'name.max' => '节点名最多25个字符',
                    'f_id.number' => '父节点必须是数字',
                    'sort.number' => '排序必须是数字',
                ]);

            if (!$validate->check($request->param())) {
                return parent::ajaxReturn('', 0, $validate->getError());
            }

            //查询该数据是否存在
            $result = $this->category->where(['id' => $request->param('id')])->find();
            if (!$result) {
                return parent::ajaxReturn('', 0, '无此数据');
            }
            //数据入库
            $res = $this->category->save($request->param(), ['id' => $request->param('id')]);

            if ($res) {
                return parent::ajaxReturn();
            }

            return parent::ajaxReturn('', 0, '编辑失败');
        }

        $data = $this->category->where(['id' => $request->param('id')])->find();

        return $this->fetch('edit', ['title' => '博文分类编辑', 'data' => $data]);
    }

    //获取父节点
    public function getParentNode()
    {

        $res = Db::table('db_category')->where(['f_id' => 0])->select();
        if ($res !== false) {
            return parent::ajaxReturn($res);
        }

        //抛出异常
        throw new \think\exception\HttpException(500, '请求error');
    }

    public function del(Request $request)
    {

        $id = $request->param('id');
        //如果该分类下没有子分类就可以直接删除
        $outcome = $this->category->where(['f_id' => $id])->find();

        if ($outcome) {
            $this->error('删除失败,此分类下有子分类未删除');
        }

        $res = $this->category->where(['id' => $id])->delete();

        if ($res === false) {
            $this->error('删除失败');
        }
        $this->success('success');

    }

    public function getAllNode()
    {
        $res = Db::table('db_category')->select();
        if ($res !== false) {
            return parent::ajaxReturn($res);
        }

        //抛出异常
        throw new \think\exception\HttpException(500, '请求error');
    }
}