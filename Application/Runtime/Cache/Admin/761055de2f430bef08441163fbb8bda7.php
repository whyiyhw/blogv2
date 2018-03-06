<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>博文编辑</title>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/Hui/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/Public/Hui/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/Hui/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Hui/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Hui/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/Public/Hui/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/Public/Hui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
</head>
<body>
<div id="page">
    <!-- start page title -->
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i>
        首页
        <span class="c-gray en">&gt;</span>
        博文管理
        <span class="c-gray en">&gt;</span>
        博文编辑
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
    </nav>
    <!-- end page title -->

    <!-- START CONTENT -->
    <div class="page-container">

        <form class="form form-horizontal" id="form-article-add"  method="post" action="<?php echo U('edit');?>">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>标题：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text"  placeholder="文章标题"  name="a_name" value="<?php echo ($data["a_name"]); ?>">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box">
                        <select name="c_id" class="select">
                            <option value="0">任意</option>
                            <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cat["id"]); ?>" <?php if(($data["c_id"]) == $cat["id"]): ?>selected='selected'<?php endif; ?>><?php echo (str_repeat('---',$cat["lev"])); echo ($cat["c_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>状态：</label>
                <div class="formControls col-xs-8 col-sm-9">
                            <span class="select-box">
                                <select name="a_status" class="select">
                                    <option value="1" <?php if(($data["a_status"]) == "1"): ?>selected='selected'<?php endif; ?>>草稿</option>
                                    <option value="2" <?php if(($data["a_status"]) == "2"): ?>selected='selected'<?php endif; ?>>公开</option>
                                    <option value="3" <?php if(($data["a_status"]) == "3"): ?>selected='selected'<?php endif; ?>>隐藏</option>
                                </select>
                            </span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>推荐指数：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input name="a_sort" type="text" class="input-text" style="width:100px" value="<?php echo ($data["a_sort"]); ?>">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>标签：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input name="a_title" type="text" class="input-text" style="width:100px" value="<?php echo ($data["a_title"]); ?>">
                </div>
            </div>

            <!-- START jWYSIWYG TEXT EDITOR -->
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>内容：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <script id="editor" name="a_content" type="text/plain" style="width:736px;height:300px;"><?php echo ($data["a_content"]); ?></script>
                    <script type="text/javascript" charset="utf-8" src="/Public/Ueditor/ueditor.config.js"></script>
                    <script type="text/javascript" charset="utf-8" src="/Public/Ueditor/ueditor.all.min.js"> </script>
                    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
                    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
                    <script type="text/javascript" charset="utf-8" src="/Public/Ueditor/lang/zh-cn/zh-cn.js"></script>
                </div>
            </div>
            <!-- END jWYSIWYG TEXT EDITOR -->
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <input type="hidden" name='id' value="<?php echo ($data["id"]); ?>">
                    <button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont"></i> 提交</button>
                </div>
            </div>
            <!--<div class="button-box" style="z-index: 460;">-->
            <!--<input type="submit" name="button" id="button" value="提交" class="st-button">-->
            <!--</div>-->
        </form>


    </div>
    <!-- END CONTENT -->
</div>
</body>
</html>
<script>
    UE.getEditor('editor');
</script>