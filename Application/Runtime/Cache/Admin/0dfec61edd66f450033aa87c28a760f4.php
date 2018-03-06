<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/Hui/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Public/Hui/lib/respond.min.js"></script>
<![endif]-->
<link href="/Public/Hui/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/Public/Hui/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/Public/Hui/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Public/Hui/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Public/Hui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>易的博客后台</title>
</head>
<body>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action='<?php echo U();?>' method="post">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input  name="username" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input  name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name ="captcha" id="captcha" class="input-text size-L" type="text" placeholder="验证码"  onclick="if(this.value=='验证码:'){this.value='';}" value="验证码:" style="width:150px;">
          <img id="img" src="<?php echo U('Admin/Login/getcaptcha');?>"> <a id="kanbuq" href="javascript:;">看不清，换一张</a> </div>
      </div>
      <!--<div class="row cl">-->
        <!--<div class="formControls col-xs-8 col-xs-offset-3">-->
          <!--<label for="online">-->
            <!--<input type="checkbox" name="online" id="online" value="">-->
            <!--使我保持登录状态</label>-->
        <!--</div>-->
      <!--</div>-->
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript" src="/Public/Hui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Hui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Public/Hui/lib/layer/2.4/layer.js"></script>
</body>
<script>
  //点击更换二维码
  $("#kanbuq").click(function () {
      $('#img').attr({ src: "<?php echo U('Admin/Login/getcaptcha').'?time='.time();?>", alt: "captcha" });
  })
  $("#img").click(function () {
      $(this).attr({ src: "<?php echo U('Admin/Login/getcaptcha').'?time='.time();?>", alt: "captcha" });
  })
  //失去焦点 验证二维码
    $("#captcha").blur(
        function () {
            if($(this).val() === ''){
                $(this).val('验证码:')
            }else{
                var cap = $(this).val();
                var url = "<?php echo U('Admin/Login/checkcaptcha');?>";
                $.get(url,{'cap':cap},function (data) {
                    data.msg == '1'?layer.msg('验证码正确'):layer.msg('验证码错误');
                },'json')
            }
        }
    )
</script>
</html>