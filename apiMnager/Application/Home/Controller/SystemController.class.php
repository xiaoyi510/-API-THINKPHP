<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2016/11/7
     * Time: 19:43
     */

    namespace Home\Controller;


    class SystemController extends CommonController
    {

        /**
         * 基础编辑信息  分配信息为info
         * @param $id id
         */
        public function index()
        {
            //处理id
            $id = intval(1);

            //判断id 是否合法
            if (!$id) {
                $this->error("数据未找到");
                exit;
            }

            //实例化模型
            $model = D(CONTROLLER_NAME);

            //查询对应是否存在
            $data = $model->find($id);

            //判断是否查询到对应的信息
            if (!$data) {
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

                //获取 编辑的 数据
                $data = $model->create();

                //判断自动验证是否合法
                if (!$data) {
                    //输出错误信息 并返回编辑页面
                    $this->error($model->getError());
                    exit;
                }
                //将用户提交的数据保存到数据库中
                $rst = $model->save();
                //判断是否保存成功
                if (!$rst) {
                    $this->error('编辑失败');
                    exit;
                }
                //跳转到首页
                $this->redirect('index');
                exit;
            } else {
                //分配 对应信息 到模板中
                $this->assign('info', $data);

                //显示编辑页面
                $this->display();
            }
        }
    }