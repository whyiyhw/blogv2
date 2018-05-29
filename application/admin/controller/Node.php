<?php

namespace app\admin\controller;

use think\Request;
use \think\Validate;
use \think\Cache;

class Node extends Base
{
    private $node;

    public function _initialize(Request $request = null)
    {
        parent::_initialize();
        $this->node = model('Node');
    }

    public function add(Request $request)
    {
        if ($request->method() === 'POST') {
            //数据验证 规则 信息  验证数据
            $validate = new Validate([
                'name' => 'require|max:15',
                'f_id' => 'require|number',
                'icon' => 'max:25',
                'sort' => 'require|number'
            ],
                [
                    'name.require' => '节点名不能为空',
                    'name.max' => '节点名最多15个字符',
                    'f_id.number' => '父节点必须是数字',
                    'icon.max' => 'icon最多25个字符',
                    'sort.number' => '排序必须是数字',
                ]);

            $data = input('post.');

            if (!$validate->check($data)) {
                return parent::ajaxReturn('', 0, $validate->getError());
            }

            //数据入库

            $res = $this->node->data($data)->save();

            if ($res) {
                //成功时清除缓存
                Cache::rm('adminNode');

                return parent::ajaxReturn();
            }
            return parent::ajaxReturn('', 0, '新增失败');
        }

        return $this->fetch('add', ['title' => '节点新增']);
    }

    public function edit(Request $request)
    {
        if ($request->method() === 'POST') {
            //数据验证 规则 信息  验证数据
            $validate = new Validate([
                'name' => 'require|max:15',
                'f_id' => 'require|number',
                'icon' => 'max:25',
                'sort' => 'require|number'
            ],
                [
                    'name.require' => '节点名不能为空',
                    'name.max' => '节点名最多15个字符',
                    'f_id.number' => '父节点必须是数字',
                    'icon.max' => 'icon最多25个字符',
                    'sort.number' => '排序必须是数字',
                ]);

            $data = input('post.');

            if (!$validate->check($data)) {
                return parent::ajaxReturn('', 0, $validate->getError());
            }

            //数据入库

            $res = $this->node->save($data, ['id' => $request->param('id')]);

            if ($res) {
                //成功时清除缓存
                Cache::rm('adminNode');

                return parent::ajaxReturn();
            }
            return parent::ajaxReturn('', 0, '新增失败');
        }
        //get 请求
        $id = $request->param()['id'];
        $res = $this->node->where(['id' => $id])->find();
        return $this->fetch('edit', ['title' => '编辑节点', 'data' => $res]);
    }

    public function del(Request $request)
    {
        $id = $request->param()['id'];
//      $id = $request->param('id');

        //如果该分类下没有子分类就可以直接删除
        $outcome = $this->node->where(['f_id' => $id])->find();

        if ($outcome) {
            $this->error('删除失败,此分类下有子分类未删除');
        }


        $res = $this->node->where(['id' => $id])->delete();

        if ($res === false) {
            $this->error('删除失败');
        }
        //成功时清除缓存
        Cache::rm('adminNode');
        $this->success('success');

    }

    public function nodeList(Request $request)
    {
        $where = [];

        if ($request->param('keyword')) {
            $where['name'] = ['like', '%' . input('get.keyword', '', 'addslashes') . '%'];
        }

        $list = $this->node->where($where)->paginate(10);

        // 把分页数据赋值给模板变量list
        $this->assign('list', $list);
        // 渲染模板输出
        return $this->fetch('list', ['title' => '节点列表']);
    }

    //获取父节点
    public function getParentNode()
    {

        $res = $this->node->where(['f_id' => 0])->select();
        if ($res !== false) {
            return parent::ajaxReturn($res);
        }

        //抛出异常
        throw new \think\exception\HttpException(500, '请求error');
    }
}
