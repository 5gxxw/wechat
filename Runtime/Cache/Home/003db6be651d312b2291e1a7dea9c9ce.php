<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo C('WEB_SITE_TITLE');?></title>
        <link href="/Public/Home/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="/Public/Home/css/style.css" rel="stylesheet">

        
        <!--[if lt IE 9]>
        <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <!--<![endif]-->
        <style>
            .main{margin-bottom: 60px;}
            .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
        </style>
    
    
</head>
<body>
<div class="main">

    
        <!--导航部分-->
        <nav class="navbar navbar-default navbar-fixed-bottom">
            <div class="container-fluid text-center">
                <div class="col-xs-3">
                    <p class="navbar-text"><a href="index.html" class="navbar-link">首页</a></p>
                </div>
                <div class="col-xs-3">
                    <p class="navbar-text"><a href="fuwu.html" class="navbar-link">服务</a></p>
                </div>
                <div class="col-xs-3">
                    <p class="navbar-text"><a href="faxian.html" class="navbar-link">发现</a></p>
                </div>
                <div class="col-xs-3">
                    <p class="navbar-text"><a href="<?php echo U('my/index');?>" class="navbar-link">我的</a></p>
                </div>
            </div>
        </nav>
        <!--导航结束-->
    

    
    <div class="container-fluid">
        <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="row noticeList">
                <a href="<?php echo U('center/detail?id='.$list['id']);?>">
                    <div class="col-xs-2">
                        <img class="img-rounded img-responsive" src="<?php echo ($list['picture']); ?>" />
                    </div>
                    <div class="col-xs-10">
                        <p class="title"><?php echo ($list["title"]); ?></p>
                        <p class="intro"><?php echo ($list["description"]); ?></p>
                        <p class="info">浏览: <?php echo ($list["view"]); ?> <span class="pull-right"><?php echo (time_format($list["create_time"])); ?></span> </p>
                    </div>
                </a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>

        <div class="text-center">
            <button class="btn btn-info ajax-page" >获取更多~~~</button>
        </div>
    </div>


</div>
    
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="/Public/Home/js/jquery-1.11.2.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/Public/Home/bootstrap/js/bootstrap.min.js"></script>
    
    
    <script>
        $(".ajax-page").click(function(){
            //获取url的参数p,如果有参数则使用,如果没有则为1

            var p = "<?php echo I('get.p');?>";

            $.get("<?php echo U('center/notice');?>",{'p':p},function(data){

            });
        });
    </script>

</body>
</html>