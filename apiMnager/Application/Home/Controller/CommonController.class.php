<?php
    /**
     * 创建者:帅哥杨
     * QQ:203521819
     * Date: 2016/11/7
     * Time: 16:53
     */

    namespace Home\Controller;


    use Think\Controller;

    class CommonController extends Controller
    {

        public $cateList = [];
        public $userInfo   = [];
        public $isLogin    = false;
        public $isSuper    = 0;
        public $msg = [
            'status' => 0,
            'msg' => '',
            'error_code' => 0,
        ];
        public $systemInfo = [];


        public function _initialize()
        {
            // 初始化
            // 获取系统配置
            $this->systemInfo = M('System')->find(1);
            $this->assign('systemInfo',$this->systemInfo);

            // 获取分类数据
            $cateList = M('Cate')->select();
            $this->cateList = $cateList;
            $this->assign('cateList', $cateList);

            // 1. 判断是否已经登录
            if (session('UserInfo')) {
                // 已经登录
                $this->userInfo = session('UserInfo');
                $this->assign('userInfo',$this->userInfo);

                $this->isLogin = true;
                $this->assign('isLogin',$this->isLogin);

                $this->isSuper = $this->userInfo['is_super'];
                $this->assign('isSuper',$this->isSuper);
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
            $this->redirect('index');
            exit;
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

                //验证正确 开始添加到数据库中
                $rst = $model->add();

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