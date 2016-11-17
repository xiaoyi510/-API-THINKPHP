<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($systemInfo["web_title"]); ?></title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/gif" />
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
    
    <!-- Create a simple CodeMirror instance -->
    <link rel="stylesheet" href="/Public/js/CodeMirror/lib/codemirror.css">
    <link rel="stylesheet" href="/Public/js/CodeMirror/theme/monokai.css">
    <script src="/Public/js/CodeMirror/lib/codemirror.js"></script>


    <script src="/Public/js/CodeMirror/mode/javascript/javascript.js"></script>


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
            <a href="<?php echo U('Api/add',['cid'=>I('get.cid')]);?>">天假接口</a>
        </li><?php endif; ?>
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
    <li class="active">添加接口</li>

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
            
    <form action="<?php echo U();?>" method="post" class="form" id="apiForm">
        <div class="form-group has-error">
            <label>接口名称</label>
            <input type="text" class="form-control" name="name" placeholder="请输入接口名称"/>
        </div>
        <div class="form-group">
            <label>内部编号（为空则为ID）</label>
            <input type="text" class="form-control" name="aid" placeholder="请输入内部编号"/>
        </div>

        <div class="form-group">
            <label>请求地址</label>
            <div class="input-group has-error">
                <input type="text" name="url" class="form-control" placeholder="请输入请求地址"/>
                <div class="input-group-btn" style="min-width: 100px">
                    <select name="type" class="form-control" >
                        <option value="1">POST</option>
                        <option value="2">GET</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>接口描述</label>
            <textarea name="desc" class="form-control" cols="30" rows="3" placeholder="请输入接口功能描述"></textarea>
        </div>

        <div class="form-group">
            <label>提交参数</label>
            <div class="input-group ">
                <button type="button" class="btn btn-success" id="addParam">添加参数</button>
            </div>
            <hr>
            <script>
                $('#addParam').click(function () {
                    var _html = $('#paramTbody td:first').parent();
                    $('#paramTbody').append('<tr>'+_html.html()+'</tr>');
                });
            </script>

            <table class="table table-condensed table-hover table-responsive table-bordered">
                <thead>
                <tr>
                    <td>参数名</td>
                    <td>字段类型</td>
                    <td>是否必填</td>
                    <td>默认值</td>
                    <td>说明</td>
                    <td>操作</td>
                </tr>
                </thead>
                <tbody id="paramTbody">
                <tr>
                    <td>
                        <div class="has-error">
                            <input type="text" name="paramName[]" class="form-control" placeholder="请输入参数名"/>
                        </div>
                    </td>
                    <td>
                        <select name="paramType[]" class="form-control"/>
                        <option>String</option>
                        <option>Int</option>
                        <option>Bool</option>
                        <option>Number</option>
                        <option>Float</option>
                        <option>Other</option>
                        </select>
                    </td>
                    <td><select name="paramMust[]" class="form-control"/>
                        <option value="1">必填</option>
                        <option value="0">可选</option>
                        </select></td>
                    <td><input type="text" name="paramDefault[]" class="form-control" placeholder="请输入默认值"/></td>
                    <td>
                    <div class="has-error">
                        <input type="text" name="paramText[]" class="form-control" placeholder="请输入参数说明"/>
                    </div>
                    </td>
                    <td>
                        <a href="javascript:;" class="btn btn-danger btn-sm" onclick="$(this).parent().parent().remove();">删除</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <label>返回数据(JSON)</label>
            <div class="row">
                <div class="col-sm-1">
                    <button type="button" class="btn btn-success" id="returnParam">添加参数</button>
                </div>
                <div class="col-sm-2">
                    <select name="return_type" class="form-control">
                        <option value="1" <?php echo $info['return_type']==1?'selected="selected"':'';?>>JSON</option>
                        <option value="2" <?php echo $info['return_type']==2?'selected="selected"':'';?>>XML</option>
                    </select>
                </div>
            </div>
            <hr>

            <script>
                $('#returnParam').click(function () {
                    var _html = $('#returnTbody td:first').parent();
                    $('#returnTbody').append('<tr>'+_html.html()+'</tr>');
                });
            </script>
            <table class="table table-condensed table-hover table-responsive table-bordered">
                <thead>
                <tr>
                    <td>字段名</td>
                    <td>字段类型</td>
                    <td>说明</td>
                    <td>操作</td>
                </tr>
                </thead>
                <tbody id="returnTbody">
                <tr>
                    <td><input type="text" name="returnName[]" class="form-control" placeholder="请输入返回字段名"/></td>
                    <td>
                        <select name="returnType[]" class="form-control"/>
                        <option>String</option>
                        <option>Int</option>
                        <option>Bool</option>
                        <option>Number</option>
                        <option>Float</option>
                        <option>Other</option>
                        </select>
                    </td>
                    <td><input type="text" name="returnText[]" class="form-control" placeholder="请输入返回字段说明"/></td>
                    <td>
                        <a href="javascript:;" class="btn btn-danger btn-sm" onclick="$(this).parent().parent().remove();">删除</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <label>接口示例</label>
            <textarea name="demo" id="demo" class="form-control" cols="30" rows="10" placeholder="请输入接口请求示例 通常是URL地址+POST数据"></textarea>
        </div>
        <div class="form-group">
            <label>返回示例</label>
            <textarea name="return_demo" id="return_demo" class="form-control" cols="30" rows="10" placeholder="请输入返回数据示例 通常是Json数据"></textarea>
        </div>
        <div class="form-group">
            <label>是否只有登录可见</label>
            <div class="input-group">
                <label><input type="radio" class="radio-inline" name="is_login" value="0" checked="checked">否</label>
            </div>
            <div class="input-group">
                <label><input type="radio" class="radio-inline" name="is_login" value="1">是</label>
            </div>
        </div>
        <input type="hidden" name="cid" value="<?php echo I('get.cid');?>" />
        <input type="submit" value="添加" class="btn btn-success"/>
    </form>
    <script type="text/javascript">
        $('#apiForm').submit(function () {
            // 保存
            $('#return_demo').val(return_demo.getValue());
            $('#demo').val(demo.getValue());

            var _data = $(this).serialize();
            $.post('<?php echo U();?>',_data,function (data) {
                if(data.status == 1){
                    location.href = data.url;
                }else{
                    layer.alert(data.msg);
                }
            });


            return false;
        });
    </script>
    <script>
            var myTextarea = document.getElementById('return_demo');
            var return_demo = CodeMirror.fromTextArea(myTextarea, {
                lineNumbers: true,
                styleActiveLine: true,
                matchBrackets: true,
                theme:'monokai'
            });
            var demo = CodeMirror.fromTextArea(document.getElementById('demo'), {
                lineNumbers: true,
                styleActiveLine: true,
                matchBrackets: true,
                theme:'monokai'
            });
    </script>


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