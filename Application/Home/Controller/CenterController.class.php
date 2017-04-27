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
            $this->login();

            $this->display();
        }
    }
    
    /**
     * 小区通知
     */
    public function notice()
    {
        //实例化模型对象
        $lists = M('document')->where('category_id=40 AND status>=0')->select();

        $picture = M('picture');
        foreach($lists as &$list){
            $pic = $picture->where('id='.$list['cover_id'])->find();
            $list['picture'] = $pic['path'];
        }
        $this->assign('lists',$lists);
        $this->display();
    }

    //小区通知的内容
    public function detail($id)
    {
        //实例化并根据id查询出数据
        $document_article = M('document_article')->join('document ON document_article.id=document.id')->select();
        foreach($document_article as $key=>$value){
            if($value['id'] == $id){
                $value['view'] += 1;
                M('document')->save($value);
                $row = $value;
            }
        }
        //分配视图
        $this->assign($row);
        $this->display('detail');
    }


    /**
     * 便民服务
     */
    public function service()
    {
        //实例化模型对象
        //查询出便民服务的文章
        $lists = M('document')->where('category_id=41 AND status>=0')->select();
        //实例化保存图片的数据表
        $picture = M('picture');
        foreach($lists as &$list){
            //循环查询保存图片的表,id为便民服务的cover_id的数据
            $pic = $picture->where('id='.$list['cover_id'])->find();
            $list['picture'] = $pic['path'];
        }
        $this->assign('lists',$lists);
        $this->display();
    }
}