<?php
use think\Route;

// 注册admin/Login模块
Route::get('adminprov/login','admin/Login/show');
Route::post('adminprov/login','admin/Login/login');
Route::get('adminprov/loginout','admin/Login/loginOut');

//临时增加 添加用户路由 只用一次就ok
//Route::get('adminprov/useradd','admin/Login/userAdd');

//后台首页
Route::get('adminprov/index','admin/Index/index');//后台首页
Route::get('adminprov/cleanAll','admin/Index/cleanAll');//清理缓存
Route::get('adminprov/loginLineTable','admin/Index/loginLineTable');//登陆线性图

//后台节点管理
Route::get('adminprov/node/add','admin/Node/add');
Route::post('adminprov/node/add','admin/Node/add');
Route::get('adminprov/node/list','admin/Node/nodeList');
Route::get('adminprov/node/edit/id/:id','admin/Node/edit');
Route::post('adminprov/node/edit','admin/Node/edit');
Route::get('adminprov/node/del','admin/Node/del');
//获取父节点信息
Route::post('adminprov/node/getParentNode','admin/Node/getParentNode');


//后台博文分类管理
Route::get('adminprov/category/list','admin/Category/categoryList');
Route::get('adminprov/category/add','admin/Category/categoryAdd');
Route::post('adminprov/category/add','admin/Category/categoryAdd');

Route::get('adminprov/category/edit/id/:id','admin/Category/categoryEdit');
Route::post('adminprov/category/edit','admin/Category/categoryEdit');

Route::get('adminprov/category/del','admin/Category/del');
//获取父节点信息
Route::post('adminprov/category/getParentNode','admin/Category/getParentNode');
Route::post('adminprov/category/getAllNode','admin/Category/getAllNode');


//后台博文管理
Route::get('adminprov/article/add','admin/Article/articleAdd');
Route::get('adminprov/article/list','admin/Article/articleList');
Route::post('adminprov/article/add','admin/Article/articleAdd');
Route::get('adminprov/article/edit/id/:id','admin/article/articleEdit');
Route::post('adminprov/article/edit','admin/article/articleEdit');

//后台用户管理
Route::get('adminprov/user/info','admin/User/userInfo');
Route::post('adminprov/user/addInfo','admin/User/addInfo');

//后台图片上传
Route::post('adminprov/upload','admin/Image/uploadOne');
Route::post('adminprov/image/del','admin/Image/del');

//前台首页
Route::get('index/index','index/Index/index');
Route::get('/','index/Index/index');
Route::get('index/articleDetail/id/:id','index/Index/articleDetail');

Route::get('index/category/:cate','index/Index/category');

Route::get('index/index/vue','index/Index/vue');//vue版本

Route::get('index/tag/:tag','index/Index/tag');//标签搜索

Route::get('index/article/search','index/Index/search');

//前台登录
Route::get('/index/login',function(){
    return '未开放';
});


//API
Route::get('api/index/title','api/Index/title');
Route::get('api/index/articleList','api/Index/articleList');
