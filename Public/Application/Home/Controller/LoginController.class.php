<?php

namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller
{

    public function login()
    {
        if (IS_GET) {
            $this->display();
        } else {
            $username   = I('post.username');
            $password   = I('post.password');
            $checkcode  = I('post.checkcode');
            #dump($email);

            $obj = new  \Think\Verify();
            if (!$obj->check($checkcode)) {
                $this->error('验证码错误！');
            }
            //实例化模型入库  因为域名问题直接将状态改成1 不然是在邮箱激活后才改

            $res = D('Login')->checkLogin($username, $password);
            #dump($res);die;
            if (!$res) {
                $this->error('信息错误！');
            } else {
                $this->success('ok,2秒后跳转blog页面',U('Index/index'));
            }
        }
    }

    public  function logout()
    {
        cookie('user',null);
        $this->redirect('/');
    }

    public function email()
    {
        //引入邮箱发送文件
            vendor("PHPMailer.class#phpmailer");

            $mail = new \PHPMailer();
            /*服务器相关信息*/
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = 'smtp.163.com';
            //设置发邮件的smtp邮件服务器地址
            $mail->Username = '15827543830';//用户名
            $mail->Password = 'xueyi123';//第三方客户端的密码
            /*内容信息*/
            $mail->IsHTML(true);
            $mail->CharSet = "UTF-8";
            $mail->From = '15827543830@163.com';//发件人邮箱
            $mail->FromName = 'BlogFormYI';//发件人的昵称
            $mail->Subject = '这是博客的激活地址';//发件的主题
            $mail->MsgHTML('<br />地址是<a>47.93.234.180</a>因为域名的备案还没下来，所以暂时要使用IP和统一的验证码753159来访问0.0');//发件的正文

            $mail->AddAddress('1309104549@qq.com');
            $mail->AddAttachment("");//附件
            $mail->Send();
            exit;
    }

    public function image()
    {
        $config = array(
            'fontSize' => 30,    // 验证码字体大小
            'length' => 3, // 验证码位数
            'useNoise' => false, // 关闭验证码杂点
        );
	ob_clean();
        $verify = new \Think\Verify($config);
        $verify->entry();
    }

    public function regist()
    {
        if (IS_GET) {
            $this->display();
        } else {
            $username   = I('post.username');
            $password   = I('post.password');
            $checkcode  = I('post.checkcode');
            $email      = I('post.email');
            #dump($email);

            $obj = new  \Think\Verify();
            if (!$obj->check($checkcode)) {
                $this->error('验证码错误！');
            }

            //实例化模型入库  因为域名问题直接将状态改成1 不然是在邮箱激活后才改
            $res = D('Login')->checkRegist($username, $password,$email);
            #dump($res);die;
            if (!$res) {
                $this->error('信息错误！');
            } else {
                $this->success('ok,2秒后跳转登录页面',U('login'));
            }
        }

    }

    public function qqslogin()
    {
        require_once("./Public/qq/API/qqConnectAPI.php");
        $qc = new \QC();
        $qc->qq_login();
    }

    //这是回调函数
    public function qqretrun(){
        require_once("./Public/qq/API/qqConnectAPI.php");
        $qc = new \QC();
        $token  = $qc->qq_callback();//拿到加密的token值
        $openid = $qc->get_openid();//拿到唯一的用户ID
        echo $token.'<br />'.$openid;

        //这里必须要拿着 token和appid去第三方  再次请求用户数据
        $qc = new \QC($token,$openid);
        $user = $qc->get_user_info();//才能拿到
        dump($user);
        //这个时候已经拿到了用户数据就可以 从用户数据中取出昵称  唯一的openid
        //加上 自定义字段对用户数据进行一个入库操作 之后就是跳转到自定义页面
    }


}

?>
