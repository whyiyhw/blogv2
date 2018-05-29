<?php
namespace app\admin\controller;

use think\Request;
use think\Validate;
use traits\controller\Jump;
use think\Log;

class Article extends Base
{
    use Jump;

    private $article;

    public function _initialize(Request $request = null)
    {
        parent::_initialize();
        $this->article = model('Article');
    }

    //博文添加
    public function articleAdd(Request $request)
    {
        if ($request->method() === "POST") {
            //验证数据 插入
            $validate = new Validate([
                'title' => 'require|max:25',
                'cate_id' => 'require',
                'sort' => 'require',
                'description' => 'require|max:50',
                'tag' => 'max:10',
                'sort' => 'require|number',
                'path_url' => 'require|max:100',
                'content' => 'require'
            ]);

            if (!$validate->check($request->param())) {
                return parent::ajaxReturn('', 0, $validate->getError());
            }
            $content = htmlspecialchars($request->param('content'));
            $request->param()['content'] = $content;
            //数据插入
//            return dump($request->param('content'));
            $res = $this->article->data($request->param())->save();

            if (!$res) {
                return parent::ajaxReturn('', 0, '数据添加失败');
            }

            return parent::ajaxReturn();
        }

        return $this->fetch('add', ['title' => '博文添加']);
    }

    public function articleList()
    {
        $list = $this->article->alias('a')
            ->field('a.id,a.title,b.name,a.description,a.tag,a.sort,a.create_time')
            ->join('db_category b', 'a.cate_id = b.id')
            ->paginate(5);

        $this->assign('list', $list);

        return $this->fetch('list', ['title' => '博文列表']);
    }

    public function articleEdit(Request $request)
    {
        if ($request->method() === "POST") {

            //验证数据 插入
            $validate = new Validate([
                'title' => 'require|max:25',
                'cate_id' => 'require',
                'description' => 'require|max:50',
                'tag' => 'max:10',
                'sort' => 'require|number',
                'path_url' => 'require|max:100',
                'content' => 'require'
            ]);

            if (!$validate->check($request->param())) {
                return parent::ajaxReturn('', 0, $validate->getError());
            }

            //数据更新

            //确定图像数据是否一致
            $path_url = $this->article->field('path_url')->where(['id' => $request->param('id')])->find()['path_url'];


//            $content = htmlspecialchars($request->param('content'));
//            $request->param('content') = $content;
//            foreach(input('post.') as $key=>$value){
//                $data[$key] = $value;
//                if ($key = 'content'){
                    $data['cate_id'] = $request->param('cate_id');
                    $data['title'] = $request->param('title');
                    $data['sort'] = $request->param('sort');
                    $data['description'] = $request->param('description');
                    $data['tag'] = $request->param('tag');
                    $data['path_url'] = $request->param('path_url');
                    $data['content'] = htmlspecialchars($request->param('content'));
                    $data['id'] = $request->param('id');
//                }
//            }

            //数据插入
//            return dump($data);

            $res = $this->article->save($data, ['id' => $request->param('id')]);


            if ($res === false) {
                return parent::ajaxReturn('', 0, '数据更新失败');
            }

            //删除之前保存的图片
            if ($path_url !== $request->param('path_url'))
            {
                Log::init([
                    'type'  =>  'File',
                    'path'  =>  APP_PATH.'logs/images/'
                ]);
                if (is_file($path_url)) {
                    if (!unlink($path_url)) {
                        //记录日志 图片资源删除失败
                        Log::record('图片资源删除失败','error');
                    }
                    return parent::ajaxReturn();
                }
                //记录日志 图片资源未找到
                Log::record('图片资源未找到','error');
            }
            return parent::ajaxReturn();
        }

        $data = $this->article->where(['id' => $request->param('id')])->find();
//        return dump($data['path_url']);

        if (!$data) {
            return $this->error('未找到该数据');
        }
        $data['path_save_url'] = addslashes(config('admin_img_path') . $data['path_url']);
        $data['path_url'] = addslashes($data['path_url']);
        $data['content'] = htmlspecialchars_decode(trim($data['content']));
        return $this->fetch('edit', ['title' => '博文编辑', 'list' => $data]);

    }

}