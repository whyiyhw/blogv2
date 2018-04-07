<?php
namespace Admin\Model;
use \Think\Model;
class CommentModel extends Model
{
    public function listDate($where, $pagesize = 1,$order = 0)
    {
        //$count定义了总数量
        if($order === 0 ){
            $dates = $this->where($where)->select();
        }else{
            $dates = $this->where($where)->order($order)->select();
        }

        $count = count($dates);

        //调用TP方法去获得分页导航
        $page = new \Think\Page($count, $pagesize);
        //获取分页导航数据
        $page->setConfig('prev',"上一页");
        $page->setConfig('next',"下一页");
        $show = $page->show();

        //获取当前的页码
        $p = intval(I('get.p'));
        //获取具体的数据

        if($order === 0 ){
            $date = $this->where($where)->Page($p, $pagesize)->select();
        }else{
            $date = $this->where($where)->order($order)->Page($p, $pagesize)->select();
        }
        #dump($this->getLastSql());
        #返回分页数据

        return $date = array('pagestr' => $show, 'date' => $date,'dates'=>$dates);
    }

    public function getDataById($id)
    {
        return $this->find($id);
    }

}