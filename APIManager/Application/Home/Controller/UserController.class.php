<?php
    /**
     * 创建者:帅哥杨
     * QQ:203521819
     * Date: 2016/11/7
     * Time: 17:15
     */

    namespace Home\Controller;


    class UserController extends CommonController
    {
        public function __construct()
        {
            parent::__construct();

            // 判断登录的用户是否是超级管理员
            if($this->isSuper != 2){
                $this->error('抱歉，您没有此权限','Index/index');
                exit;
            }
        }

        public function repass()
        {
            // 判断用户是否已经登录
            if ($this->isLogin == false) {
                $this->error('非法访问');
                exit;
            }
            if (IS_POST) {
                $data = I('post.');

                // 判断密码是否为空
                if(!$data['password'] || !$data['old_password']){
                    $this->error('密码不能为空');
                    exit;
                }

                // 获取当前用户信息
                $userInfo = $this->userInfo;

                // 判断旧密码是否跟用户密码相同
                if ($userInfo['password'] != md5($data['old_password'])) {
                    $this->error('密码错误');
                    exit;
                }

                // 修改新密码
                unset($data['old_password']);
                $data['id'] = $userInfo['id'];
                $data['password'] = md5($data['password']);
                $rst = M('User')->save($data);
                if ($rst === false) {
                    $this->error('修改密码错误');
                    exit;
                } else {
                    session('UserInfo', null);
                    $this->success('修改密码成功，请重新登录',U('Login/login'),3);
                    exit;
                }

            }

            $this->display();
        }

        public function index(){
            // 获取所有用户
            $userList = M('User')->select();

            $this->assign('userList',$userList);

            $this->display();

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
                if(!$data['password']){
                    unset($data['password']);
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


        /**
         * 基础添加方法
         */
        public function add()
        {
            //判断是否是POST请求
            if (IS_POST) {
                //实例化模型
                $model = D(CONTROLLER_NAME);

                //获取post 提交数据
                $data = $model->create();

                //判断自动验证  自动完成 是否获取到数据 表单令牌 是否合法
                if (!$data) {
                    //不合法 提示错误信息 返回 之前页面
                    $this->error($model->getError());
                    exit;
                }

                $data['password'] = md5($data['password']);
                //验证正确 开始添加到数据库中
                $rst = $model->add($data);

                //判断是否添加成功
                if (!$rst) {
                    //添加失败 提示失败信息 并返回添加页面
                    $this->error('添加失败');
                    exit;
                }

                //添加成功直接跳转到列表页面
                $this->redirect('index');
                exit;
            } else {
                //显示添加模板
                $this->display();
            }

        }
    }