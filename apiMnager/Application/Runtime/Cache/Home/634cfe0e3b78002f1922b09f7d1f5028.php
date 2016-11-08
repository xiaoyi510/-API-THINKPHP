<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API管理</title>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/Public/js/jquery-1.11.2.min.js"></script>
    <!-- Bootstrap -->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/css/my.css" rel="stylesheet">
    <!--font-awesome字体库-->
    <link href="/Public/css/font-awesome.min.css" rel="stylesheet"/>


    <!--主要写的jquery拓展方法-->
    <script src="/Public/js/jquery.extend.js" type="text/javascript"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/Public/js/bootstrap.min.js"></script>
    <script src="/Public/plugins/bootstrap.metisMenu/metisMenu.min.js"></script>
    <link href="/Public/plugins/bootstrap.metisMenu/metisMenu.min.css" rel="stylesheet"/>
    <link href="/Public/plugins/bootstrap.metisMenu/demo.css" rel="stylesheet"/>
    
</head>
<body>

<div class="container-full">
    <!--导航条-->
    <div class="menu">
        <!--导航条顶部-->
        <div class="menuHeader">
            <div class="logo">
                <img src="/Public/images/logo.png" alt="" max-width="250">
            </div>

        </div>
        <!--导航条顶部-->
        <!--导航条内容-->
        <aside class="sidebar">
            <nav class="sidebar-nav">
                <ul class="metismenu" id="menu">
                    
    <li>
        <a href="<?php echo U('Index/index');?>">首页</a>
    </li>
    <li>
        <a href="#" aria-expanded="true">
            <span class="sidebar-nav-item-icon fa fa-github fa-lg"></span>
            <span class="sidebar-nav-item">API列表</span>
            <span class="fa arrow"></span>
        </a>
        <ul aria-expanded="true">
            <?php if(is_array($apiList)): $i = 0; $__LIST__ = $apiList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$api): $mod = ($i % 2 );++$i;?><li>
                    <a href="#TrueCode_api_<?php echo md5($api['id']);?>">
                        <?php echo ($api["name"]); ?>
                    </a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </li>


                </ul>
            </nav>
        </aside>
        <!--导航条内容-->
    </div>
    <!--导航条-->
    <div class="container-full" style="margin-left: 250px;position: absolute;top: 0px;width: 100%;">
        <!--右侧-->
        <div class="main">
            <!--右侧顶部-->
            <div class="header">
                <div class="left">


                    <ol class="breadcrumb">
                        
                            <li><a href="<?php echo U('Index/index');?>">首页</a></li>
                            <li class="active">首页</li>
                        
                    </ol>


                </div>
                <div class="right">
                    <?php if($isLogin): ?><span style="color: white;">欢迎回来，<?php echo ($userInfo['name']); ?> </span><a href="<?php echo U('User/repass');?>">修改密码</a> <a href="<?php echo U('Login/logout');?>">退出</a>
                        <?php else: ?>
                        <a href="<?php echo U('Login/login');?>">登录</a><?php endif; ?>
                </div>
            </div>
            <!--右侧顶部-->
            <!--右侧内容-->
            <div class="right_content container">
                
    <?php if(is_array($apiList)): $i = 0; $__LIST__ = $apiList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$api): $mod = ($i % 2 );++$i;?><div class="panel panel-primary" id="TrueCode_api_<?php echo md5($api['id']);?>">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo ($api["name"]); ?></h3>
            </div>
            <div class="panel-body">
                <p>接口功能：<?php echo ($api["desc"]); ?></p>
                <span class="label label-primary"><?php echo $api['type']==1?'POST':'GET';?></span> - <span
                    class="label label-primary"><?php echo ($api["url"]); ?></span>
                <h5>请求参数(urlParams)</h5>
                <table class="table table-condensed table-hover table-responsive table-bordered">
                    <thead>
                        <tr>
                            <td>参数名</td>
                            <td>类型</td>
                            <td>是否必填</td>
                            <td>默认值</td>
                            <td>说明</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>




            </div>
            <!--右侧内容-->
        </div>
        <!--右侧-->

    </div>


</div>
<script>
    $(function () {
        $('#menu').metisMenu();
    });
</script>



</body>
</html>