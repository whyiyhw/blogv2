<?php
namespace Admin\Model;
class ArticleModel extends CommentModel
{
    protected $fields = array(
        'id','a_name','a_content','c_id','a_publishtime','a_status','a_sort','a_zan','a_title'
    );
    protected $_validate = array(
        array('a_name', 'require', '标题不能为空', 1, 'regex'),
        array('a_content', 'require', '内容不能为空', 1, 'regex'),
        array('a_sort', 'require', '推荐指数不能为空', 1, 'regex'),
        array('a_title', 'require', '标签不能为空', 1, 'regex'),
    );



}