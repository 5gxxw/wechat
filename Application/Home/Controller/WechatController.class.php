<?php
/**
 * 微信授权
 */

namespace Home\Controller;


use EasyWeChat\Foundation\Application;
use Think\Controller;

include './vendor/autoload.php'; // 引入 composer 入口文件
class WechatController extends Controller
{
    public function index(){
//        echo I('get.echostr');
        // 使用配置来初始化一个项目。
        $app = new Application(C('WE_CHAT'));

        $response = $app->server->serve();

        // 将响应输出
        $response->send(); // Laravel 里请使用：return $response;

    }





    //网页授权回调地址
    public function actionCallback()
    {
        $app = new Application(\Yii::$app->params['wechat']);
        $oauth = $app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        //将用户的openid保存到session
        \Yii::$app->session->set('openid',$user->id);
        //跳回请求地址
        if(\Yii::$app->session->has('back')){
            //保存到变量
            $back = \Yii::$app->session->get('back');
            //清理session中的back
            \Yii::$app->session->remove('back');
            //跳回
            return $this->redirect([$back]);
        }
    }

    /**
     * 添加菜单
     */
    public function actionAddMenu()
    {
        //获取菜单模块实例
        $app = new Application(\Yii::$app->params['wechat']);
        $menu = $app->menu;

        //添加普通菜单
        $buttons = [
            [
                "type" => "click",
                "name" => "热卖商品",
                "key"  => "V1001_HOS"
            ],
            [
                "name"       => "个人中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "我的订单",
                        "url"  => Url::to(['we-chat/my-order'],true)
                    ],
                    [
                        "type" => "view",
                        "name" => "我的信息",
                        "url"  => Url::to(['we-chat/my-info'],true),
                    ],
                    [
                        "type" => "view",
                        "name" => "绑定账号",
                        "url" => Url::to(['we-chat/bang'],true)
                    ],
                ],
            ],
        ];
        $menu->add($buttons);
    }
}