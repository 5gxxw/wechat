<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/1
 * Time: 12:58
 */

namespace Admin\Model;

use Think\Model;

class OwnerCertificationModel extends Model
{
    //定义验证规则
    protected $_validate = [
        ['name','require','请填写姓名',self::MUST_VALIDATE ],
        ['room_number','require','请填写房号(栋/单元/楼/房号)',self::MUST_VALIDATE ],
        ['tel','/^[1][3,4,5,7,8]\d{9}$/','请填写正确格式的电话号码',self::MUST_VALIDATE],
        ['relation','require','请选择与业主的关系',self::MUST_VALIDATE],
        ['card_id','18','请填写正确格式身份证号码',self::MUST_VALIDATE,'length'],
    ];
    //自动完成
    protected $_auto = [
        ['uid','getUid',1,'callback'],//发布者id
        ['create_time',NOW_TIME,self::MODEL_INSERT],//新增的时候自动添加时间
        ['status',1],//将状态设置为未审核
    ];

    //获取发布者id
    public function getUid(){
        return (int)I('session.onethink_admin')['user_auth']['uid'];
    }
}