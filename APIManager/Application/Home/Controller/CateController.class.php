<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2016/11/7
     * Time: 19:43
     */

    namespace Home\Controller;


    class CateController extends CommonController
    {
        public function __construct()
        {
            parent::__construct();
            // 判断登录的用户是否是管理员
            if($this->isSuper < 1){
                $this->error('抱歉，您没有此权限',U('Index/index'));
                exit;
            }
        }

        /**
         * 分类列表
         */
        public function index(){
            $this->display();
        }

        /**
         * 添加分类
         */
        public function add(){
            if(IS_POST){
                $data = M('cate')->create();
                if(!$data){
                    $this->error(M('cate')->getError());
                    exit;
                }
                // 添加到数据库
                $data['create_time'] = time();
                $rst = M('Cate')->add($data);
                if($rst){
                    $this->redirect('Index/index');
                    exit;
                }else{
                    $this->error('添加失败');
                    exit;
                }
            }

            $this->display();

        }

    }