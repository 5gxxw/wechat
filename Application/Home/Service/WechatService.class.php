<?php
/**
 * 微信服务模型
 */
namespace Home\Service;

use EasyWeChat\Foundation\Application;
use Think\Model;

class WechatService extends Model
{
    /**
     * @param $path,授权回调地址需要跳回的路由地址
     */
    public function getOpenid($path)
    {
        //初始化配置
        $app = new Application(C('WE_CHAT'));
        //获取授权回调地址路径
        $response = $app->oauth->redirect();
        //将当前路由保存到session中方便授权回调地址跳回
        session('back',$path);
        $response->send();
    }
}