<?php
/**
 * 我的
 */

namespace Home\Controller;

class MyController extends CheckController
{
    /**
     * 我的
     */
    public function index()
    {
        //从session中取出数据
        $user = I('session.onethink_home');
//        dump($user);exit;
        $user_info = $user['user_auth'];
        //根据uid查询用户信息
        $this->assign('user_info',$user_info);
        $this->display();
    }

    //我的报修
    public function myRepair()
    {
        //从session中取出数据
        $user = I('session.onethink_home');
        $user_info = $user['user_auth'];
        //根据uid查询报修表
        $map['uid'] = $user_info['uid'];
        $map['status'] = ['EGT',0];
        $lists = M('Repair')->where($map)->select();

        $this->assign('lists',$lists);
        $this->display();
    }
    
    /**
     * 报名的活动
     */
    public function activity()
    {
        if($id = is_login()){
            $this->redirect('Center/document',['category_id'=>42,'uid'=>$id]);
        }
    }
}