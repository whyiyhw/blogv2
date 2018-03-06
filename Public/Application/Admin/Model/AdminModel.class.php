<?php
namespace Admin\Model;
class AdminModel extends CommentModel
{
    //实现字段的定义功能 需要将每一个字段都写入
    protected $fields = array(
        'id','a_username','a_password','a_time',
    );
    protected $_map = array(
        'username'=>'a_username',
        'password'=>'a_password',
    );
    //进行自动验证
    protected $_validate = array(
        array('a_username','checkName','名称错误',1,'callback',3),
        array('a_password','checkPass','密码错误',1,'callback',3),
    );
    public function checkName($name)
    {
        #拿到用户名
        $data = $this->find();
        #dump($data);dump($name);die;
        if($name ===$data['a_username']){
            return true;
        }
        $this->error='账号错误';
        return false;
    }
    function checkPass($pass)
    {
        $data = $this->find();
        if(md5($pass)=== $data['a_password']){
            //dump($data);dump(md5($pass));die;
            return true;
        }
        $this->error="$pass";
        return false;
    }
    function checkCaptcha($code,$is_reset = 0)
    {
        $config= $is_reset?[]:['reset'=>false];
        $Verify = new \Think\Verify($config);
        return $Verify->check($code);
    }

}