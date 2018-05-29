<?php

namespace app\admin\model;

use think\Model;

class UserLogin extends Model
{
    protected $autoWriteTimestamp = true;//本模型内部允许自动添加时间戳
    protected $updateTime = false;
    protected $createTime = 'login_time';


}