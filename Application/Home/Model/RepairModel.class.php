<?php
/**
 * 报修管理模型
 */

namespace Home\Model;


use Think\Model;

class RepairModel extends Model
{
    //定义验证规则
    protected  $_validate = [
        ['name','require','请填写您的姓名',self::MUST_VALIDATE ],
        ['tel','/^[1][3,4,5,7,8]\d{9}$/','请填写正确格式的电话号码',self::MUST_VALIDATE],
        ['address','require','请填写您的地址',self::MUST_VALIDATE],
        ['problem','require','请填写您的问题',self::MUST_VALIDATE],
    ];

    protected  $_auto = [
        ['number','rand',1,'callback'],//新增的时候自动添加时间
        ['create_time',NOW_TIME,self::MODEL_INSERT],//新增的时候自动添加时间
        ['status',0],//新增的时候自动将状态改为0

    ];

    public function rand(){
        return md5(rand(1000,9999));
    }

}