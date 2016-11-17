<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2016/11/7
     * Time: 19:59
     */

    namespace Home\Controller;


    class ApiController extends CommonController
    {
        /**
         * API接口列表
         *
         * @param $cid
         */
        public function index($cid)
        {
            // 1. 判断分类是否存在
            $cid = intval($cid);
            $cateInfo = M('Cate')->find($cid);
            if (!$cateInfo) {
                $this->error('分类不存在');
                exit;
            }
            // 2. 获取所属分类的API接口
            $apiList = M('Api')->where(['cid' => $cid])->select();
            $this->assign('apiList', $apiList);
            $this->display();
        }

        /**
         * 基础添加方法
         */
        public function add()
        {
            // 判断用户等级
            if ($this->isSuper < 1) {
                $this->error('抱歉！您没有权限访问本页面', U('Index/index'));
                exit;
            }


            //判断是否是POST请求
            if (IS_POST) {
                // 获取数据
                $_data = I('post.');
                // 判断请求参数名是否有空的
                foreach ($_data['paramName'] as $key=>$item){
                    if($item == false){
                        // 删除所有对应的数据
                        unset($_data['paramName'][$key]);
                        unset($_data['paramType'][$key]);
                        unset($_data['paramMust'][$key]);
                        unset($_data['paramDefault'][$key]);
                        unset($_data['paramText'][$key]);
                    }
                }
                // 判断返回字段名是否有空的
                foreach ($_data['returnName'] as $key=>$item){
                    if($item == false){
                        // 删除所有对应的数据
                        unset($_data['returnName'][$key]);
                        unset($_data['returnType'][$key]);
                        unset($_data['returnText'][$key]);
                    }
                }

                // 处理接口参数数据
                $params = getArray([
                    'paramName'    => $_data['paramName'],
                    'paramType'    => $_data['paramType'],
                    'paramMust'    => $_data['paramMust'],
                    'paramDefault' => $_data['paramDefault'],
                    'paramText'    => $_data['paramText']
                ]);
                // 删除不相关的数据
                unset($_data['paramName']);
                unset($_data['paramType']);
                unset($_data['paramMust']);
                unset($_data['paramDefault']);
                unset($_data['paramText']);


                // 处理返回字段数据
                $returnParams = getArray([
                    'returnName' => $_data['returnName'],
                    'returnType' => $_data['returnType'],
                    'returnText' => $_data['returnText'],
                ]);

                // 删除不相关的数据
                unset($_data['returnName']);
                unset($_data['returnType']);
                unset($_data['returnText']);

                // 处理成 我们需要的数据
                $_data['params'] = json_encode($params);
                $_data['returns'] = json_encode($returnParams);

                $_data['create_time'] = time();
                $_data['uid'] = $this->userInfo['id'];

                //实例化模型
                $model = D(CONTROLLER_NAME);

                //获取post 提交数据
                $data = $model->create($_data);

                //判断自动验证  自动完成 是否获取到数据 表单令牌 是否合法
                if (!$data) {
                    //不合法 提示错误信息 返回 之前页面
                    $this->msg['msg'] = $model->getError();
                    $this->ajaxReturn($this->msg);
                }


                //验证正确 开始添加到数据库中
                $rst = $model->add($data);

                //判断是否添加成功
                if (!$rst) {
                    //添加失败 提示失败信息 并返回添加页面
                    $this->msg['msg'] = '添加失败';
                    $this->ajaxReturn($this->msg);
                    exit;
                }

                //添加成功直接跳转到列表页面
                $this->msg['url'] = U('Api/index', ['cid' => $data['cid']]);
                $this->msg['status'] = 1;
                $this->ajaxReturn($this->msg);
                exit;
            } else {
                //显示添加模板
                $this->display();
            }

        }


        /**
         * 基础编辑信息  分配信息为info
         * @param $id id
         */
        public function edit($id)
        {
            //处理id
            $id = intval($id);

            //判断id 是否合法
            if (!$id) {
                $this->error("数据未找到");
                exit;
            }

            //实例化模型
            $model = D(CONTROLLER_NAME);

            //查询对应是否存在
            $info = $model->find($id);

            //判断是否查询到对应的信息
            if (!$info) {
                $this->error("数据未找到");
                exit;
            }

            //判断是否是POST 请求
            if (IS_POST) {
                //判断 post 请求中的 id  是否跟 get 请求中的 id 一致
                if (i('post.id') != i('get.id')) {
                    $this->error('请勿修改id');
                    exit;
                }
// 获取数据
                $_data = I('post.');
// 判断请求参数名是否有空的
                foreach ($_data['paramName'] as $key=>$item){
                    if($item == false){
                        // 删除所有对应的数据
                        unset($_data['paramName'][$key]);
                        unset($_data['paramType'][$key]);
                        unset($_data['paramMust'][$key]);
                        unset($_data['paramDefault'][$key]);
                        unset($_data['paramText'][$key]);
                    }
                }
                // 判断返回字段名是否有空的
                foreach ($_data['returnName'] as $key=>$item){
                    if($item == false){
                        // 删除所有对应的数据
                        unset($_data['returnName'][$key]);
                        unset($_data['returnType'][$key]);
                        unset($_data['returnText'][$key]);
                    }
                }
                // 处理接口参数数据
                $params = getArray([
                    'paramName'    => $_data['paramName'],
                    'paramType'    => $_data['paramType'],
                    'paramMust'    => $_data['paramMust'],
                    'paramDefault' => $_data['paramDefault'],
                    'paramText'    => $_data['paramText']
                ]);
                // 删除不相关的数据
                unset($_data['paramName']);
                unset($_data['paramType']);
                unset($_data['paramMust']);
                unset($_data['paramDefault']);
                unset($_data['paramText']);

                // 处理返回字段数据
                $returnParams = getArray([
                    'returnName' => $_data['returnName'],
                    'returnType' => $_data['returnType'],
                    'returnText' => $_data['returnText'],
                ]);

                // 删除不相关的数据
                unset($_data['returnName']);
                unset($_data['returnType']);
                unset($_data['returnText']);

                // 处理成 我们需要的数据
                $_data['params'] = json_encode($params);
                $_data['returns'] = json_encode($returnParams);
                //获取 编辑的 数据
                $data = $model->create($_data);

                //判断自动验证是否合法
                if (!$data) {
                    //输出错误信息 并返回编辑页面
                    $this->error($model->getError());
                    exit;
                }
                //将用户提交的数据保存到数据库中
                $rst = $model->save($data);
                //判断是否保存成功
                if ($rst === false) {
                    $this->msg['msg'] = '编辑失败';
                    $this->ajaxReturn($this->msg);
                    exit;
                }
                //跳转到首页
                $this->msg['msg'] = '编辑成功';
                $this->msg['url'] = U('Api/index', ['cid' => $info['cid']]);
                $this->msg['status'] = 1;
                $this->ajaxReturn($this->msg);
                exit;
            } else {
                //分配 对应信息 到模板中
                $this->assign('info', $info);

                //显示编辑页面
                $this->display();
            }
        }

        /**
         * 基础删除方法 根据id 删除数据
         * @param $id
         */
        public function remove($id)
        {
            //处理id
            $id = intval($id);

            //判断Id 是否合法
            if (!$id) {
                $this->error("数据未找到");
                exit;
            }

            //实例化模型
            $model = D(CONTROLLER_NAME);

            //查找是否存在
            $data = $model->find($id);
            if (!$data) {
                $this->error("数据未找到");
                exit;
            }
            //开始删除
            $rst = $model->delete($id);

            //判断是否删除成功
            if (!$rst) {
                $this->error('删除信息失败');
                exit;
            }
            //删除成功 跳转到列表
            $this->redirect(U('index',['cid'=>$data['cid']]));
            exit;
        }

    }