<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>用户注册</title>
	<link rel="stylesheet" href="/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/login.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/footer.css" type="text/css">
</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
		</div>
	</div>
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>

	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="#"><img src="" alt=""></a></h2>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<!-- 登录主体部分start -->
	<div class="login w990 bc mt10 regist">
		<div class="login_hd">
			<h2>用户注册</h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="<?php echo U('regist');?>" method="post">
					<ul>
						<li>
							<label for="">用户名：</label>
							<input type="text" class="txt" name="username" />
							<p>3-20位字符，可由中文、字母、数字和下划线组成</p>
						</li>
						<li>
							<label for="">密码：</label>
							<input type="password" class="txt" name="password" />
							<p>6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号</p>
						</li>
						<li>
							<label for="">注册邮箱：</label>
							<input type="text" class="txt" name="email" />
							<p> <span><font color="pink">请在激活注册地址后登录</font></span></p>
						</li>
						<li class="checkcode">
							<label >验证码：</label>
							<input type="text"  name="checkcode" />
							<img src="<?php echo U('image');?>" alt="" />
							<span>看不清？<a href="javascript:" id="change">换一张</a></span>
						</li>
						<li>
							<button type="submit">注册 >></button>
						</li>
					</ul>
				</form>

				
			</div>
			
			<!--<div class="mobile fl">
			&lt;!&ndash;	<p><strong>手机快速注册</strong><br />这个功能太贵了</p>
				<p><strong>有钱了再开发</strong></p>&ndash;&gt;
			</div>-->

		</div>
	</div>
	<!-- 登录主体部分end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt15">
		<p class="links">
			<a href="javascript:">关于我们</a> |
			<a href="javascript:">友情链接</a> |
		</p>
		<p class="copyright">
			© 易
		</p>
		<p class="auth">
			<a href=""><img src="" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->

</body>
</html>
<script src="/Public/Home/js/vendor/jquery-2.1.4.min.js"></script>
<script>
    $('#change').click(function (){
        var date = new Date();
        var time = date.getTime();
        $(this).parent().prev().attr('src',"<?php echo U('image','id='.time);?>");
    });



</script>