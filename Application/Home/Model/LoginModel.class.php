<?php
namespace Home\Model;
use Think\Model;
class LoginModel extends Model
{
    protected $fields=array('id','username','password','salt','status','email');

    public function checkRegist($username, $password,$email)
    {
        if($username && $password && $email) {

            $salt = mt_rand(100000,999999);
            $password = md5(md5($password).$salt);
            $list =array(
                'username'=>$username,
                'password'=>$password,
                'salt'    =>$salt,
                'email'   =>$email,
                'status'  =>1,
            );
            return $this->add($list);
        }else{
            return false;
        }
    }

    public function checkLogin($username, $password)
    {
        if($username && $password) {

            $info = $this->where('status = 1'.' and username='."'$username'")->find();
            /*dump($info);
            dump(md5(md5($password).'659840'));die;*/
            if($info){
                if($info['password'] === md5(md5($password).$info['salt'])){
                    cookie('user',$username);
                    return true;
                }
            }
            return false;
        }else{
            return false;
        }
    }




}