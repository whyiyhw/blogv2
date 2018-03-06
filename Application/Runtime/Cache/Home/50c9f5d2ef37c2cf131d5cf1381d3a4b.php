<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>登录blog</title>
	<link rel="stylesheet" href="/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/login.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/footer.css" type="text/css">
</head>
<body>


	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 ></h2>
		</div>
	</div>

	<!-- 页面头部 end -->
	
	<!-- 登录主体部分start -->
	<div class="login w990 bc mt10">
		<div class="login_hd">
			<h2>用户登录||&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo U('Index/index');?>" >To blog首页</a></h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="<?php echo U('Login/login');?>" method="post">
					<ul>
						<li>
							<label >用户名：</label>
							<input type="text" class="txt" name="username" />
						</li>
						<li>
							<label >密码：</label>
							<input type="password" class="txt" name="password" />
							<a href="">忘记密码?</a>
						</li>
						<!--<li>
							<label >邮箱：</label>
							<input type="text" class="txt" name="password" />
							<a href="javascript:">点击获取激活码?</a>
						</li>-->
						<li class="checkcode">
							<label >验证码：</label>
							<input type="text"  name="checkcode" />
							<img src="<?php echo U('image');?>" alt="" />
							<span>看不清？<a href="javascript:" id="change">换一张</a></span>
						</li>
						<!--<li>
							<label >&nbsp;</label>
							<input type="checkbox" class="chb"  /> 保存登录信息
						</li>-->
						<li>
							<label >&nbsp;</label>
							<button type="submit">登录 >></button>
							<!--<input type="submit" value="Login" class="login_btn" />-->
						</li>
					</ul>
				</form>

				<div class="coagent mt15">
					<dl>
						<dt>使用合作网站登录：</dt>
						<dd ><a href="javascript:"><span></span>正在开发中...</a>
							<a href="javascript:" onclick='toQzoneLogin()'><img src="/Public/Home/img/qq_login.png">这个因为网站没上线只能开发者自己使用0.0</a>
						</dd>
					</dl>
				</div>
			</div>
			
			<div class="guide fl">
				<h3>还不是blog用户</h3>
				<p>现在快来注册吧！</p>

				<a href="<?php echo U('regist');?>" class="reg_btn">注册 >></a>

			</div>

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
	<div id="container"  style="margin: auto 0; width: 100%;height: 150px;"></div>
</body>
</html>
<script src="/Public/Home/js/vendor/jquery-2.1.4.min.js"></script>
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script>
	$('#change').click(function (){
	    var date = new Date();
        var time = date.getTime();
		$(this).parent().prev().attr('src',"<?php echo U('image','id='.time);?>");
    });
	function init() {
        //指定参数信息
	    var option ={
	        'zoom':15//指定缩放的参数
	    };
		//实例化地图对象
        var map = new qq.maps.Map(document.getElementById("container"),option);
		// 实例化地图对象调用方法初始化地图
		map.panTo(new qq.maps.LatLng(39.916527,116.397128));
		//指定具体的回调函数
        var callbacks={
            complete:function(result){
                //地图对调方法 setCenter设置中心点
                map.setCenter(result.detail.location);
                //实例化覆盖物对象
                var marker = new qq.maps.Marker({
                    map:map,
					//指定具体的定位信息
                    position: result.detail.location
                });
            }
        };
        geocoder = new qq.maps.Geocoder(callbacks);
        geocoder.getLocation("中国,湖北,武汉市,长城科技园2号");
    }
    //加载地图
    init();
</script>
<script type="text/javascript">

    function toQzoneLogin()
    {
        window.open("<?php echo U('qqslogin');?>");
    }
</script>