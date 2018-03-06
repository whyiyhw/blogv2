<?php

namespace Admin\Model;


class CategoryModel extends CommentModel
{
    protected $fields = array(
        'id', 'c_name', 'c_parent_id', 'c_sort',
    );
    protected $_map = array(
        'name' => 'c_name',
        'parent_id' => 'c_parent_id',
        'sort' => 'c_sort',
    );
    protected $_validate = array(
        array('c_name', 'require', '名称不能为空', 1, 'regex'),
    );

    #得到无限极分类
    public function getCategory($id = 0)
    {
        $data = $this->select();

        return $this->getFenlei($data,$id);
    }

    protected function getFenlei($data, $parentId = 0, $lev = 1)
    {
        static $arr = array();
        foreach ($data as $key => $value) {
            if ($value['c_parent_id'] == $parentId) {
                $value['lev'] = $lev;
                $arr[] = $value;
                $this->getFenlei($data, $value['id'], $lev + 1);
            }
        }
        return $arr;
    }

    public function checkfenlei($date)
    {
        $c_name = trim($date['c_name']);
        $id = $date['c_parent_id'];
        #dump($c_name);die;
        $res = $this->getCategory($id);
        #增加一个分类名不能等于本身
        $res[]= $this->find($id);
        foreach ($res as $key=>$value){
            if($value['c_name']===$c_name){
                #dump($value['c_name']);die;
                return false;
            }
        }
        #dump($res);die;
        return true;
    }

    public function dels($id)
    {
        //进行删除之前需要判断该分类下是否存在子分类 不存在才能删除
        $res=$this->getCategory($id);
        if($res){
            return false;
        };
        return $this->delete($id);
    }

    public function update($data)
    {
        #dump($data);die;
        if(!$this->checkfenlei($data)){
            return 1;
        }
        $res = $this->save($data);
        #dump($res);die;
        if($res === false){
            return 2;
        }
        return true;
    }


}