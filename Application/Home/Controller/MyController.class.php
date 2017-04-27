<?php
/**
 * 我的
 */

namespace Home\Controller;

class MyController extends HomeController
{
    /**
     * 我的
     */
    public function index()
    {
        //判断用户是否登录
        $this->login();
        $user = I('session.onethink_home');
        $user_info = $user['user_auth'];
        //根据uid查询用户信息
        $this->assign('user_info',$user_info);
        $this->display();
    }
}