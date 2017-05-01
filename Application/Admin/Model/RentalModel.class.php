<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/30
 * Time: 12:33
 */

namespace Admin\Model;


use Think\Model;

class RentalModel extends Model
{
    //定义验证规则
    protected  $_validate = [
        ['title','require','请填写标题',self::MUST_VALIDATE ],
        ['name','require','请填写姓名',self::MUST_VALIDATE ],
        ['tel','/^[1][3,4,5,7,8]\d{9}$/','请填写正确格式的电话号码',self::MUST_VALIDATE],
        ['price','currency','请填写价格',self::MUST_VALIDATE],
        ['intro','require','请填写100字以内简介',self::MUST_VALIDATE],
        ['content','require','请填写内容',self::MUST_VALIDATE],
        ['status','require','请填写状态',self::MUST_VALIDATE]
    ];

    //自动完成
    protected  $_auto = [
        ['uid','getUid',1,'callback'],//发布者id
        ['time',NOW_TIME,self::MODEL_INSERT],//新增的时候自动添加时间
    ];

    //获取发布者id
    public function getUid(){
        return (int)I('session.onethink_admin')['user_auth']['uid'];
    }
}