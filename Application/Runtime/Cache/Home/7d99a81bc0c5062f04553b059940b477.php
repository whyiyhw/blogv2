<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>博文内容</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link href="/Public/Home/css/app.css" rel="stylesheet" media="screen">
  <script src="/Public/Home/js/vendor/modernizr.custom.js"></script>
  <script src="/Public/Home/js/vendor/detectizr.min.js"></script>
</head>

<!-- Body -->
<body>
<!-- Page Wrapper -->
<div class="page-wrapper">
  <!-- Navbar -->
  <!-- Add class ".navbar-sticky" to make navbar stuck when it hits the top of the page. Another modifier class is: "navbar-fullwidth" to stretch navbar and make it occupy 100% of the page width. The screen width at which navbar collapses can be controlled through the variable "$nav-collapse" in sass/variables.scss -->
  <header class="navbar">

    <!-- Toolbar -->
    <div class="topbar">
      <div class="container">
        <a href="<?php echo U('index');?>" class="site-logo">
          博文前台
        </a><!-- .site-logo -->
        <div class="toolbar">
          <!--<span>欢迎<?php echo (session('username')); ?>进入博客&nbsp;</span><a href="<?php echo U('Login/zhuxiao');?>" class="text-sm">退出登录</a>-->
          <?php if(empty($_COOKIE['user'])): ?><a href="<?php echo U('Login/login');?>" >立刻登录 <i class="icon-head"></i></a>
            <?php else: ?>
            <span>欢迎<?php echo (cookie('user')); ?>进入博客&nbsp;</span>
            <a href="<?php echo U('Login/logout');?>" >登出 <i class="icon-head"></i></a><?php endif; ?>
        </div>
      </div><!-- .container -->
    </div><!-- .topbar -->
  </header><!-- .navbar -->

  <!-- Page Title -->
  <!--Add modifier class : "pt-fullwidth" to stretch page title and make it occupy 100% of the page width. -->
  <section class="page-title">
    <div class="container">
      <div class="inner">
        <div class="column">
          <div class="title">
            <h1>博文内容</h1>
          </div><!-- .title -->
        </div><!-- .column -->
        <div class="column">
        </div><!-- .column -->
      </div>
    </div>
  </section><!-- .page-title -->

  <!-- Container -->
    <div class="container">

      <!-- Content -->
      <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
          <h1><?php echo ($cat["a_name"]); ?></h1>
          <div class="post-meta">
            <div class="column">
              <span>
                <i class="icon-head"></i>
                <a href="#">admin</a>
              </span>
              <span>在</span>
              <span>
                <i class="icon-ribbon"></i>
                <?php if(is_array($category)): foreach($category as $key=>$res): ?><a><?php if(($cat["c_id"]) == $res["id"]): echo ($res['c_name']); endif; ?></a><?php endforeach; endif; ?>
              </span>
              <span>下发布</span>
              <span class="post-comments">
                <i class="icon-speech-bubble"></i>
                <a href="#">12</a>
              </span>
            </div>
            <div class="column"><span><?php echo (date('Y-m-d H:i:s',$cat["a_publishtime"])); ?></span></div>
          </div><!-- .post-meta -->
          <!--<img src="Public/Home/img/blog/single/slide01.jpg" alt="Image">-->
          <?php echo (htmlspecialchars_decode($cat["a_content"])); ?>
          <div class="post-tools space-top-2x">
            <div class="column">
              <div class="tags-links">
                <a href="#"><?php echo ($cat["a_title"]); ?></a>
              </div>
            </div><!-- .column -->
            <div class="column">
            </div><!-- .column -->
          </div><!-- .post-tools -->
          <div class="post-tools space-top-2x">
            <div class="column"></div>
            <div class="column text-center">
              <a href="javascript:;" id="addsatr"><i class="fa fa-thumbs-up dz" aria-hidden="true">（<?php echo ($cat["a_zan"]); ?>）</i></a>
            </div><!-- .column -->
            <div class="column">
            </div><!-- .column -->
          </div><!-- .post-tools -->


          <!-- Comments -->
          <!--<div class="comments-area space-top-3x">
            <h4 class="comments-count">共有<?php echo ($comment['0']['num']); ?>条评论</h4>

            {foreach from=$comment item=cat}
            &lt;!&ndash; Comment &ndash;&gt;
            <div class="comment">
              <div class="comment-meta">
                <div class="column">
                  <span class="comment-autor"><i class="icon-head"></i><a href="#">张学友</a></span>
                </div>
                <div class="column">
                  <span class="comment-date">{}</span>
                </div>
              </div>&lt;!&ndash; .comment-meta &ndash;&gt;
              <div class="comment-body">
                <p><?php echo ($cat["c_content"]); ?></p>
              </div>&lt;!&ndash; .comment-body &ndash;&gt;

            </div>&lt;!&ndash; .comment &ndash;&gt;
            {/foreach}


            &lt;!&ndash; Comment Form &ndash;&gt;
            <div class="comment-respond">
              <h4 class="comment-reply-title">发布新评论</h4>
              <form method="post" id="comment-form" class="comment-form">

                <div class="form-group">
                  <label for="cf_comment" class="sr-only">Comment</label>
                  <textarea name="comment" id="cf_comment" class="form-control input-alt" rows="7" placeholder="输入您的评论"></textarea>
                </div>            
                <p class="form-submit">
                  <input name="submit" type="submit" id="submit" class="btn btn-primary btn-block" value="发布">
                </p>
              </form>
            </div>&lt;!&ndash; .comment-respond &ndash;&gt;
          </div>&lt;!&ndash; .comments-area &ndash;&gt;-->
        </div><!-- .col-lg-9.col-md-8 -->
      </div><!-- .row -->
    </div><!-- .container -->

    <!-- Scroll To Top Button -->
    <a href="#" class="scroll-to-top-btn">
      <i class="icon-arrow-up"></i> 
    </a><!-- .scroll-to-top-btn -->

    <!-- Footer -->
    <!-- Footer -->
    <footer class="footer">
      <div class="bottom-footer">
        <div class="container">
          <div class="copyright">
            <div class="column">
              <p>&copy; 2016. 保留所有权利。</p>
            </div><!-- .column -->
            <div class="column">
            </div><!-- .column -->
          </div><!-- .copyright -->
        </div><!-- .container -->
      </div><!-- .bottom-footer -->
    </footer><!-- .footer -->

  </div><!-- .page-wrapper -->

  <!-- JavaScript (jQuery) libraries, plugins and custom scripts -->
  <script src="/Public/Home/js/vendor/jquery-2.1.4.min.js"></script>
  <script src="/Public/Home/js/vendor/bootstrap.min.js"></script>
  <script src="/Public/Home/js/vendor/waves.min.js"></script>
  <script src="/Public/Home/js/vendor/placeholder.js"></script>
  <script src="/Public/Home/js/vendor/waypoints.min.js"></script>
  <script src="/Public/Home/js/vendor/velocity.min.js"></script>
  <script src="/Public/Home/js/scripts.js"></script>
<script>
  $('#addsatr').click(function (){
    alert(1);
    $.ajax({
      url:"<?php echo U('addstra');?>",
      date:'post',
      success: function (mse){
        if(mse == 0){

        }else{
          alert(1);
        }
      }
    });
  });
</script>
</body><!-- <body> -->
</html>