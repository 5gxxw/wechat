<?php
/**
 * 自定义行为类
 */

namespace Home\behavior;


class BlogBehavior
{
    //行为扩展执行的入口必须是run
    public function run(&$params)
    {

            echo '行为测试'.$params;

    }
}