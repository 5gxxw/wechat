<?php
/**
 * 报修管理
 */

namespace Home\Controller;


use Think\Page;

class CenterController extends HomeController
{
    /**
     * 在线报修
     */
    public function repair(){
        if(IS_POST){
            //实例化模型对象.
            $repair = D('Repair');
            //根据表单提交的post数据创建数据对象
            $data = $repair->create();
            if($data){
                //添加到数据表
                $id = $repair->add();
                if ($id){
                    $this->success('提交成功,请等待通知!',U('index/index'));
                }else{
                    $this->error('提交失败');
                }
            }else{
                $this->error($repair->getError());
            }
        }else{
            //判断用户是否登录
            $this->login('Center/repair');
            $this->display();
        }
    }
    
    /**
     * 根据category_id查询分页数据
     */
    public function document($category_id=0,$uid=0)
    {
        if (!$category_id){
            $this->error('没有发现内容,请填写正确的分类');
        }
        if ($uid){
            //根据用户id查询已经报名的活动
            $lists = M('apply')->join('document ON apply.article_id = document.id')->where(['apply.uid'=>$uid])->page(I('p',1),C('LIST_ROWS'))->select();
        }elseif($category_id = 44){
            //生活贴士(囊括了小区通知、便民服务、小区活动)
            $map['category_id'] = ['IN',[40,41,42]];
            $map['status'] = ['EGT',0];
            $lists =M('document')->where($map)->page(I('p',1),C('LIST_ROWS'))->select();
        }else{
            //实例化文章信息的模型对象
            $map['category_id'] = $category_id ? $category_id : I('get.category_id');
            $map['status'] = ['EGT',0];
            $lists = M('document')->where($map)->page(I('p',1),C('LIST_ROWS'))->select();

        }
        //将时间,图片在控制器中处理
        foreach($lists as &$list){
            $list['create_time'] = date('Y-m-d H:i',$list['create_time']);
            //get_cover是系统公共函数库的方法
            $list['img'] = get_cover($list['cover_id'],'path');
            //设置跳转地址
            $list['url'] = U('detail',['category_id'=>$category_id,'id'=>$list['id']]);
        }
        //判断是否是ajax发送的数据
        if (IS_AJAX){
            if (empty($lists)){
                $this->error('没有数据了');
            }else{
                $this->success($lists);
            }
        }
        $this->assign('lists',$lists);
        $this->display();
    }

    //通知的内容
    public function detail()
    {
        //实例化并根据id查询出数据
        $document_article = M('document_article')->join('document ON document_article.id=document.id')->select();
        foreach($document_article as $value){
            //I('get.id')为点击的数据的id
            if($value['id'] == I('get.id')){
                //浏览量加1
                $value['view'] += 1;
                $value['category_id'] = I('get.category_id');
                M('document')->save($value);
                $row = $value;
            }
        }
        //分配视图
        $this->assign($row);
        $this->display();
    }

    /* 申请参与活动  $id为文章的id */
    public function apply($id)
    {
        //判断是否登录
        if (!is_login()){
            $this->login('Center/apply?id='.$id);
        }
        //获取当前的用户id,文章id,写入数据表

        $data['uid'] = is_login();
        //获取文章id
        $data['article_id'] = (int)I('get.id');
        $data['create_time'] = time();
        $data['status'] = 1;//1为报名成功
        //实例化数据模型并写入数据
        $apply = M('apply');
        //先查询数据表用户是否已经报名
        $result = $apply->field('status')->where(['uid'=>$data['uid'],'article_id'=>$data['article_id']])->find();
        if($result == null){
            if($apply->add($data)){
                //报名成功
                $this->success('报名成功!',U(''),IS_AJAX);
            }else{
                $this->error('报名失败!');
            }
        }else{
            switch ($result['status']){
                case 1 : $this->success('已经报过名啦!',U(''),IS_AJAX);break;
                case -1 : $this->success('活动已经结束啦!',U(''),IS_AJAX);break;
            }
        }
    }
    
    /**
     * 小区租售
     */
    public function rental()
    {
        //租
        $zus = M('rental')->where(['status'=>1])->select();
        $shous = M('rental')->where(['status'=>2])->select();
        $this->assign('zus',$zus);
        $this->assign('shous',$shous);
        $this->display();
    }

    /**
     * 小区租售详细信息
     * @param $id ,小区租售信息的id
     */
    public function detailed($id)
    {
        //根据id查询出小区租售的信息
        $row = M('rental')->find($id);
        $detail = M('rental_details')->find($row['detail_id']);
        $this->assign($row);
        $this->assign($detail);
        $this->display();
    }
}