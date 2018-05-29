<?php
namespace app\admin\controller;

use think\Request;

class Image extends Base
{
    public function _initialize(Request $request = null)
    {
        parent::_initialize();
    }

    public function uploadOne(Request $request)
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');

        // 移动到框架应用根目录/public/uploads/ 目录下
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                // 成功上传后 获取上传信息
                // 输出 jpg
//                echo $info->getExtension();
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $file_path = 'uploads' . DS . $info->getSaveName();
                return parent::ajaxReturn(['file_path' => $file_path]);
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
//                echo $info->getFilename();
            } else {
                // 上传失败获取错误信息
                return parent::ajaxReturn("", 0, $file->getError());
            }
        }
    }

    public function del(Request $request)
    {
        $path = $request->param('file_name');

        if (is_file($path)) {
            if (unlink($path)) {
                return parent::ajaxReturn();
            }
            return parent::ajaxReturn('',0,'删除失败了');
        }
        return parent::ajaxReturn('',0,'未找到该资源');
    }
}