<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($systemInfo["web_title"]); ?></title>
    <link rel="shortcut icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/Public/js/jquery-1.11.2.min.js"></script>
    <!-- Bootstrap -->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/css/my.css" rel="stylesheet">
    <!--font-awesome字体库-->
    <link href="/Public/css/font-awesome.min.css" rel="stylesheet"/>
    <!--layer-->
    <link href="/Public/js/layer/skin/layer.css" rel="stylesheet"/>
    <script src="/Public/js/layer/layer.js" type="text/javascript"></script>




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
                    
                        <li class="active">
                            <a href="<?php echo U('Index/index');?>">首页</a>
                        </li>
                        <li>
                            <a href="#" aria-expanded="true">
                                <span class="sidebar-nav-item-icon fa fa-book fa-lg"></span>
                                <span class="sidebar-nav-item">分类</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul aria-expanded="true">
                                <?php if(is_array($cateList)): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><li>
                                        <a href="<?php echo U('Api/index',['cid'=>$cate['id']]);?>">
                                            <?php echo ($cate["name"]); ?>
                                        </a>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>

                            </ul>
                        </li>
                        <?php if($isSuper >= 1): ?><li>
                                <a aria-expanded="true" href="#">
                                    <span class="sidebar-nav-item-icon fa fa-cubes fa-lg"></span>
                                    <span class="sidebar-nav-item">分类管理</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul aria-expanded="true">
                                    <li>
                                        <a href="<?php echo U('Cate/index');?>">分类管理</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo U('Cate/add');?>">添加分类</a>
                                    </li>
                                </ul>
                            </li><?php endif; ?>
                        <?php if($isSuper == 2): ?><li>
                                <a aria-expanded="true" href="#">
                                    <span class="sidebar-nav-item-icon fa fa-cogs fa-lg"></span>
                                    <span class="sidebar-nav-item">系统管理</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?php echo U('System/index');?>">系统设置</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo U('User/index');?>">用户管理</a>
                                    </li>
                                </ul>
                            </li><?php endif; ?>
                    

                </ul>
            </nav>
        </aside>
        <!--导航条内容-->
    </div>
    <!--导航条-->


</div>
<div class="container-full" style="margin-left: 250px;position: absolute;top: 0px;width: calc(100% - 250px);">
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
            
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">欢迎访问API接口管理工具</h3>
                    </div>
                    <div class="panel-body">
                        欢迎使用接口管理工具 v<?php echo ($systemInfo['ver']); ?>版

                        <p>
                            什么是接口文档管理工具?
                            是一个在线API文档系统；其致力于快速解决团队内部接口文档的编写、维护、存档，和减少团队协作开发的沟通成本。
                        </p>

                        <p>我的官网：<a href="http://www.52nyg.com" target="_blank">http://www.52nyg.com</a></p>
                        <p>GitHub：<a href="https://github.com/xiaoyi510/APIManager" target="_blank">https://github.com/xiaoyi510/APIManager</a></p>
                        <p>码云：<a href="http://git.oschina.net/52nyg/APIManager" target="_blank">http://git.oschina.net/52nyg/APIManager</a></p>

                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h3>捐助 <small>请扫描二维码</small></h3>
                                <div><img width="200px" src="/Public/images/alipay.png" alt="扫描二维码赞助"></div>
                                <hr />
                                <a href="tencent://message/?uin=956406180&Site=逆云阁&Menu=yes" target="_blank" class="btn btn-info"><span class="fa fa-qq"></span> 联系我</a>
                                <a href="http://blog.52nyg.com" target="_blank" class="btn btn-info"><span class="glyphicon glyphicon-home"></span> 访问博客</a>
                            </div>
                            <div class="col-sm-8">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light table-bordered">
                                        <thead>

                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td> 程序开发 </td>
                                            <td><a href="http://www.52nyg.com" target="_blank">TrueCode[易子轩]</a> </td>
                                        </tr>
                                        <tr>
                                            <td>系统版本</td>
                                            <td><?php echo ($systemInfo['ver']); ?></td>
                                        </tr>
                                        <tr>
                                            <td> 操作系统 </td>
                                            <td> <?php echo PHP_OS;?> </td>
                                        </tr>
                                        <tr>
                                            <td> 软件版本 </td>
                                            <td> <?php echo ($_SERVER['SERVER_SOFTWARE']); ?> </td>
                                        </tr>
                                        <tr>
                                            <td> 服务器时间 </td>
                                            <td> <?php echo date('Y-m-d H:i:s');?> </td>
                                        </tr>
                                        <tr>
                                            <td> USER_AGENT </td>
                                            <td> <?php echo ($_SERVER['HTTP_USER_AGENT']); ?> </td>
                                        </tr>
                                        <tr>
                                            <td> Curl </td>
                                            <td> <?php echo function_exists("curl_init")?'支持':'不支持';?> </td>
                                        </tr>
                                        <tr>
                                            <td> mysqli </td>
                                            <td> <?php echo function_exists("mysqli_connect")?'支持':'不支持';?> </td>
                                        </tr>
                                        <tr>
                                            <td> 上传文件最大限制 </td>
                                            <td> <?php echo get_cfg_var("upload_max_filesize");?> </td>
                                        </tr>
                                        <tr>
                                            <td> 脚本超时时间 </td>
                                            <td> <?php echo get_cfg_var("max_execution_time");?>秒 </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <hr>
                    </div>
                </div>
            

        </div>
        <!--右侧内容-->
    </div>
    <!--右侧-->

</div>

<script>
    $(function () {
        $('#menu').metisMenu();
    });
</script>



</body>
</html>