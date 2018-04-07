<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>博文列表</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link href="/Public/Home/css/app.css" rel="stylesheet" media="screen">
  <script src="/Public/Home/js/vendor/modernizr.custom.js"></script>
  <script src="/Public/Home/js/vendor/detectizr.min.js"></script>
</head>

<body>

  <header class="navbar">

    <!-- Toolbar -->
    <div class="topbar">
      <div class="container">
        <a href="<?php echo U('index');?>" class="site-logo">
          首页
        </a>
        <a href="<?php echo U('chat');?>" class="site-logo">
          聊天室
        </a><!-- .site-logo -->

        <!-- Mobile Menu Toggle -->
        <div class="nav-toggle"><span></span></div>

        <div class="toolbar">
          <!--<span>欢迎<?php echo (session('username')); ?>进入博客&nbsp;</span><a href="<?php echo U('Login/zhuxiao');?>" class="text-sm">退出登录</a>-->
            <?php if(empty($_COOKIE['user'])): ?><a href="<?php echo U('Login/login');?>" >立刻登录 <i class="icon-head"></i></a>
              <?php else: ?>
              <span>欢迎<?php echo (cookie('user')); ?>进入博客&nbsp;</span>
              <a href="<?php echo U('Login/logout');?>" >登出 <i class="icon-head"></i></a><?php endif; ?>
        </div>
        <!-- .toolbar -->
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
              <h1>博文内容列表</h1>
            </div><!-- .title -->
          </div><!-- .column -->
          <div class="column">
          </div><!-- .column -->
        </div>
      </div>
    </section><!-- .page-title -->

    <!-- Container -->
    <div class="container">
      <div class="row">

        <!-- Content -->
        <div class="col-lg-9 col-md-8">
          <!-- Post -->
            <?php if(empty($data["date"]["0"]["a_content"])): ?>内容正在编辑中
              <?php else: ?>
            <?php if(is_array($data["date"])): $i = 0; $__LIST__ = $data["date"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?><article class="post-item">
              <!-- .post-thumb -->
              <div class="post-body">
                <div class="post-meta">
                  <div class="column">
                    <span>
                      <i class="icon-head"></i>
                      <a href="#">易</a>
                    </span>
                    <span>在</span>
                    <span>
                      <i class="icon-ribbon"></i>
                      <?php if(is_array($category)): foreach($category as $key=>$res): ?><a><?php if(($cat["c_id"]) == $res["id"]): echo ($res['c_name']); endif; ?></a><?php endforeach; endif; ?>
                    </span>
                    <span>下发布</span>
                    <!--<span class="post-comments">
                      <i class="icon-speech-bubble"></i>
                      <a href="#">12</a>
                    </span>-->
                  </div>
                  <div class="column"><span><?php echo (date('Y-m-d',$cat["a_publishtime"])); ?></span></div>
                </div><!-- .post-meta -->
                <h3 class="post-title"><?php echo ($cat["a_name"]); ?></h3>
                <p><?php echo (mb_substr($cat["a_content"],0,50,'utf-8')); ?>...</p>
                <a href="<?php echo U('article','id='.$cat['id']);?>">点击阅读更多</a>
              </div><!-- .post-body -->
            </article><!-- .post-item --><?php endforeach; endif; else: echo "" ;endif; endif; ?>
          <!-- Pagination -->
          <ul class="pagination">
             <?php echo ($data["pagestr"]); ?>
          </ul>
        </div><!-- .col-lg-9.col-md-8 -->

        <!-- Sidebar -->
        <div class="col-lg-3 col-md-4">
          <div class="space-top-2x visible-sm visible-xs"></div>
          <aside class="sidebar">
            <section class="widget widget_search">
              <form method="get" class="search-box">
                <input type="text" class="form-control" name="c_name" placeholder="按标题搜索博文">
                <button type="submit"><i class="icon-search"></i></button>
              </form>
            </section>
            <section class="widget widget_categories">
              <h3 class="widget-title">
                <i class="icon-ribbon"></i>
                分类
              </h3>
              <ul>
                  <?php if(is_array($category)): foreach($category as $key=>$cat): ?><li>
                  <a href="<?php echo U('index','id='.$cat['id']);?>"><?php echo (str_repeat('---',$cat["lev"])); echo ($cat["c_name"]); ?></a>
                </li><?php endforeach; endif; ?>
              </ul>
            </section><!-- .widget.widget_categories -->
            <section class="widget widget_recent_posts">
              <h3 class="widget-title">
                <i class="icon-paper"></i>
                最新博文
              </h3>

              <?php if(is_array($new)): foreach($new as $key=>$cat): ?><div class="item">
                <div class="thumb">
                  <a href="<?php echo U('article','id='.$cat['id']);?>"><img src="/Public/Home/img/blog/sidebar/post01.jpg" alt="Post01"></a>
                </div>
                <div class="info">
                  <h4><a href="<?php echo U('article','id='.$cat['id']);?>"><?php echo ($cat["a_name"]); ?></a></h4>
                </div>
              </div><!-- .item --><?php endforeach; endif; ?>

            </section><!-- .widget.widget_recent_posts -->
            <section class="widget widget_tag_cloud">
              <h3 class="widget-title">
                <i class="icon-tag"></i>
                标签集
              </h3>

                <?php if(is_array($data["dates"])): $i = 0; $__LIST__ = $data["dates"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?><a href="<?php echo U('index','title='.$cat['a_title']);?>"><?php echo ($cat["a_title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>

            </section><!-- .widget.widget_tag_cloud -->
          </aside><!-- .sidebar -->
        </div><!-- .col-lg-3.col-md-4 -->
      </div><!-- .row -->
    </div><!-- .container -->

    <!-- Scroll To Top Button -->
    <a href="#" class="scroll-to-top-btn">
      <i class="icon-arrow-up"></i>
    </a><!-- .scroll-to-top-btn -->

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

</body><!-- <body> -->

</html>