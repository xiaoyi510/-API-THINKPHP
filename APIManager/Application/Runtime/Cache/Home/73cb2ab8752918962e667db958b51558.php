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
                                        <a href="<?php echo U('User/manager');?>">用户管理</a>
                                    </li>
                                </ul>
                            </li><?php endif; ?>
                    

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
    <li class="active">编辑分类</li>

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
                
    <form action="<?php echo U('edit',['id'=>$info['id']]);?>" method="post" class="form">
        <div class="form-group">
            <label>账号</label>
            <input type="text" class="form-control" name="username" value="<?php echo ($info["username"]); ?>"/>
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" class="form-control" name="password" placeholder="留空不修改"/>
        </div>
        <div class="form-group">
            <label>姓名</label>
            <input type="text" class="form-control" name="name" value="<?php echo ($info["name"]); ?>"/>
        </div>
        <div class="form-group">
            <label>类型</label>
            <div class="input-group">
                <label>
                    <input type="radio" name="is_super" value="0" <?php echo $info['is_super'] == 0?'checked="checked"':'';?>>普通用户</label>
            </div>
            <div class="input-group">
                <label>
                    <input type="radio" name="is_super" value="1" <?php echo $info['is_super'] == 1?'checked="checked"':'';?>>管理员</label>
            </div>
            <div class="input-group">
                <label>
                    <input type="radio" name="is_super" value="2" <?php echo $info['is_super'] == 2?'checked="checked"':'';?>>超级管理员</label>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
        <input type="submit" value="编辑" class="btn btn-success"/>
    </form>


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