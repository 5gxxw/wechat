<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/28
 * Time: 10:24
 */

namespace Home\Controller;

use EasyWeChat\Foundation\Application;
use Home\Service\WechatService;

class CheckController extends HomeController
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: 相当于构造方法,会自动调用

        $this->login('My/index');
    }
}