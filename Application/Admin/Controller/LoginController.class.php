<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller
{
    //实现后台管理员登录功能
    public function login()
    {
        if(IS_POST){
            //对用户名密码进行验证 使用自动验证
            $model = D('admin');
            $some = $model->create();
            if(!$some){
                $this->error($model->getError());
            }
            //对验证码进行验证
            $code = I('post.captcha');
            $res = $model->checkCaptcha($code,1);
            $rand = rand().time();
            if(!$res){
                $this->error('验证码错误',"login/id/$rand");
            }
            //插入登录详情表
            $res = $model->where(['a_username'=>$some['a_username']])->find();
            $data['user_id'] = $res['id'];
            $data["login_ip"] = $this->get_client_ip();
            $data["login_time"] = time();
            M("adminLogin")->add($data);
            //最后记录session信息进行跳转
            session('user',$some['a_username']);
            session('id',$res['id']);
            $this->success('登陆成功','/Admin/Index/index');
        }else{
            $rand = rand();
            $this->assign('rand',$rand);
            $this->display();
        }

    }

    //登出
    public function loginOut()
    {
        //销毁session
        session(null);
        redirect(U('Login/login'));
    }
    //得到一张验证码
    public function getcaptcha()
    {
        $config=array(
            'fontSize'    =>    18,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    true, // 关闭验证码杂点
            'imageW'      =>    120,    //图片宽
            'imageH'      =>    41,     //图片高
        );
	ob_clean();
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
    //检查验证码 同时返回数据
    public function checkcaptcha()
    {
        $code = I('get.cap');
        if(D('admin')->checkCaptcha($code)){
            echo json_encode([msg=>'1']);
        }else{
            echo json_encode([msg=>'0']);
        }
    }
    //拿到用户真实IP
    public function get_client_ip(){
        $headers = ['HTTP_X_REAL_FORWARDED_FOR',
                    'HTTP_X_FORWARDED_FOR',
                    'HTTP_CLIENT_IP',
                    'REMOTE_ADDR'
        ];
        foreach ($headers as $h){
            $ip = $_SERVER[$h];
            // 有些ip可能隐匿，即为unknown
            if ( isset($ip) && strcasecmp($ip, 'unknown') ){
                break;
            }
        }
        if( $ip ){
            // 可能通过多个代理，其中第一个为真实ip地址
            list($ip) = explode(',', $ip, 2);//最多拿两个值
        }
        return $ip;
    }
}
