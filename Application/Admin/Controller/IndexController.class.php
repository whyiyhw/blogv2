<?php
namespace Admin\Controller;
class IndexController extends CommentController {

    public function index(){
        $this->display();
    }
    public function welcome()
    {
        $id    = session('id');
        $obj   = M('adminLogin');
        $count = $obj->where(['a_username'=>$id])->count("id");
        $data = $obj->where(['a_username'=>$id])->order("login_time desc")->limit(2)->select();
        $this->assign("times",$count);
        $this->assign("first",$data[0]);
        $this->assign("last" ,$data[1]);
        $this->display("Index/welcome");
    }

    public function clean()
    {
        $dir = APP_PATH . 'Runtime/Temp';
        if($this->delDirAndFile( $dir )){
            echo json_encode(['status'=>1]);
        }else{
            echo json_encode(['status'=>0]);
        }
    }

    public function delDirAndFile( $dirName )
    {
        if( $handle = opendir( "$dirName" ) ){
            while( false !== ( $item = readdir( $handle ) ) ){
                if( $item != "." && $item != ".." ){
                    if( is_dir( "$dirName/$item" ) ){
                        $this->delDirAndFile( "$dirName/$item" );
                    }else{
                        unlink( "$dirName/$item" );
                    }
                }
            }
            closedir( $handle );
            if( rmdir( $dirName ) )
                return true;
        }
    }

}