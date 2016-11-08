<?php
    /**
     * 创建者:帅哥杨
     * QQ:203521819
     * Date: 2016/11/7
     * Time: 16:53
     */

    namespace Home\Controller;


    class LoginController extends CommonController
    {
        public function login(){
            if(IS_POST){
                // POST 请求 获取数据
                $data =  M('User')->create();

                // 验证数据是否正确
                if(!$data){
                    $this->error(M('User')->getError());
                    exit;
                }

                // 查找用户是否存在
                $userInfo =  M('User')->where(['username'=>$data['username']])->find();
                if(!$userInfo){
                    $this->error('用户名或密码错误');
                    exit;
                }
                // 对比密码是否一致
                if($userInfo['password'] != md5($data['password'])){
                    $this->error('用户名或密码错误');
                    exit;
                }
                // 保存到session
                session('UserInfo',$userInfo);
                // 跳转到主页
                $this->redirect('Index/index');
            }
            $this->display();
        }

        public function logout(){

            // 保存到session
            session('UserInfo',null);
            // 跳转到主页
            $this->redirect('Index/index');
        }
    }