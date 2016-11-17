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
    
    <link rel="stylesheet" href="/Public/css/prettify.css">
    <script src="/Public/js/prettify.js"></script>
    <script>
        $(function () {
            prettyPrint();
        })
    </script>

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

    <?php if($isSuper >= 1): ?><li>
            <a href="<?php echo U('add',['cid'=>I('get.cid')]);?>">添加接口</a>
        </li><?php endif; ?>
    <li>
        <a href="#" aria-expanded="true">
            <span class="sidebar-nav-item-icon fa fa-github fa-lg"></span>
            <span class="sidebar-nav-item">API列表</span>
            <span class="fa arrow"></span>
        </a>
        <ul aria-expanded="true">
            <?php if(is_array($apiList)): $i = 0; $__LIST__ = $apiList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$api): $mod = ($i % 2 );++$i; $apiNum = 0;?>
                <?php if($api['is_login']): if($isLogin): ++$apiNum;?>
                        <li>
                            <a href="#TrueCode_api_<?php echo md5($api['id']);?>">
                                <?php echo ($api["name"]); ?>
                            </a>
                        </li><?php endif; ?>
                    <?php else: ?>
                    <?php ++$apiNum;?>
                    <li>
                        <a href="#TrueCode_api_<?php echo md5($api['id']);?>">
                            <?php echo ($api["name"]); ?>
                        </a>
                    </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <?php if($apiNum == 0): ?><li >
                    <a href="">暂无数据</a>
                </li><?php endif; ?>
        </ul>
    </li>


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
    <li class="active">API接口列表</li>

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
            
    <?php $apiNum = 0;?>
    <?php if(is_array($apiList)): $i = 0; $__LIST__ = $apiList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$api): $mod = ($i % 2 );++$i; if($api['is_login']): if($isLogin): ++$apiNum;?>
                    
                    <div class="panel panel-success" id="TrueCode_api_<?php echo md5($api['id']);?>">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo ($api["name"]); ?></h3>
                            <?php if($isSuper >= 1): ?><a href="<?php echo U('edit',['id'=>$api['id']]);?>" class="btn btn-success" style="float: right;margin-top: -26px;">编辑</a>
                                <a href="<?php echo U('remove',['id'=>$api['id']]);?>" class="btn btn-danger" style="float: right;margin-top: -26px;margin-right: 10px">删除</a><?php endif; ?>
                        </div>
                        <div class="panel-body">
                            <span class="label label-success"><?php echo $api['type']==1?'POST':'GET';?></span> - <span
                                class="label label-success"><?php echo ($api["url"]); ?></span>
                            <hr />
                            <p>接口功能：<br/><?php echo ($api["desc"]); ?></p>
                            <hr />
                            <h4>请求参数(urlParams)</h4>
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
                                <?php $linJson = json_decode($api['params']);?>
                                <?php if(is_array($linJson)): $i = 0; $__LIST__ = $linJson;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lin): $mod = ($i % 2 );++$i;?><tr <?php echo $lin->paramMust?'class="text-danger"':'';?>>
                                        <td><?php echo ($lin->paramName); ?></td>
                                        <td><?php echo ($lin->paramType); ?></td>
                                        <td><?php echo $lin->paramMust?'必填':'可选';?></td>
                                        <td><?php echo $lin->paramDefault?$lin->paramDefault:'-';?></td>
                                        <td><?php echo ($lin->paramText); ?></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <h4>返回字段(类型：<?php echo $api['return_type']==1?'JSON':'XML';?>)</h4>
                            <table class="table table-condensed table-hover table-responsive table-bordered">
                                <thead>
                                <tr>
                                    <td>字段名</td>
                                    <td>字段类型</td>
                                    <td>说明</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $linJson = json_decode($api['returns']);?>
                                <?php if(is_array($linJson)): $i = 0; $__LIST__ = $linJson;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lin): $mod = ($i % 2 );++$i;?><tr>
                                        <td><?php echo ($lin->returnName); ?></td>
                                        <td><?php echo ($lin->returnType); ?></td>
                                        <td><?php echo ($lin->returnText); ?></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <h4>接口示例</h4>
                            <pre class="prettyprint linenums"><?php echo ($api["demo"]); ?></pre>
                            <h4>返回示例</h4>
                            <pre class="prettyprint linenums"><?php echo ($api["return_demo"]); ?></pre>
                        </div>
                        <div class="panel-footer">
                            创建时间：<?php echo date('Y-m-d H:i:s',$api['create_time']);?>
                        </div>
                    </div><?php endif; ?>
            <?php else: ?>
                <?php ++$apiNum;?>
                
                <div class="panel panel-success" id="TrueCode_api_<?php echo md5($api['id']);?>">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo ($api["name"]); ?></h3>
                        <?php if($isSuper >= 1): ?><a href="<?php echo U('edit',['id'=>$api['id']]);?>" class="btn btn-success" style="float: right;margin-top: -26px;">编辑</a>
                            <a href="<?php echo U('remove',['id'=>$api['id']]);?>" class="btn btn-danger" style="float: right;margin-top: -26px;margin-right: 10px">删除</a><?php endif; ?>
                    </div>
                    <div class="panel-body">
                        <span class="label label-success"><?php echo $api['type']==1?'POST':'GET';?></span> - <span
                            class="label label-success"><?php echo ($api["url"]); ?></span>
                        <hr />
                        <p>接口功能：<br/><?php echo ($api["desc"]); ?></p>
                        <hr />
                        <h4>请求参数(urlParams)</h4>
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
                            <?php $linJson = json_decode($api['params']);?>
                            <?php if(is_array($linJson)): $i = 0; $__LIST__ = $linJson;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lin): $mod = ($i % 2 );++$i;?><tr <?php echo $lin->paramMust?'class="text-danger"':'';?>>
                                    <td><?php echo ($lin->paramName); ?></td>
                                    <td><?php echo ($lin->paramType); ?></td>
                                    <td><?php echo $lin->paramMust?'必填':'可选';?></td>
                                    <td><?php echo $lin->paramDefault?$lin->paramDefault:'-';?></td>
                                    <td><?php echo ($lin->paramText); ?></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <h4>返回字段(类型：<?php echo $api['return_type']==1?'JSON':'XML';?>)</h4>
                        <table class="table table-condensed table-hover table-responsive table-bordered">
                            <thead>
                            <tr>
                                <td>字段名</td>
                                <td>字段类型</td>
                                <td>说明</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $linJson = json_decode($api['returns']);?>
                            <?php if(is_array($linJson)): $i = 0; $__LIST__ = $linJson;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lin): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($lin->returnName); ?></td>
                                    <td><?php echo ($lin->returnType); ?></td>
                                    <td><?php echo ($lin->returnText); ?></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <h4>接口示例</h4>
                        <pre class="prettyprint linenums"><?php echo ($api["demo"]); ?></pre>
                        <h4>返回示例</h4>
                        <pre class="prettyprint linenums"><?php echo ($api["return_demo"]); ?></pre>
                    </div>
                    <div class="panel-footer">
                        创建时间：<?php echo date('Y-m-d H:i:s',$api['create_time']);?>
                    </div>
                </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    <?php if($apiNum == 0): ?><div class="alert alert-danger" role="alert">
            暂无数据
        </div><?php endif; ?>




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