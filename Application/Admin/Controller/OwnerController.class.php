<?php
/**
 * 业主认证
 */

namespace Admin\Controller;

class OwnerController extends AdminController
{
    /**
     * 业主认证
     */
    public function certification()
    {
        //实现分页的方法lists()
        $list = $this->lists('owner_certification');

        //分配视图
        $this->assign('list',$list);
        $this->mate_title = '业主认证';
        $this->display();
    }

    /**
     * 新增
     */
    public function add()
    {
        if(IS_POST){
            //实例化模型
            $owner = D('OwnerCertification');
            $data = $owner->create();
            if ($data){
                if ($owner->add()){
                    $this->success('新增成功',U('certification'));
                }else{
                    $this->error('新增失败');
                }
            }else{
                $this->error($owner->getError());
            }
        }else{
            $relation = ['relation'=>[1=>'本人',2=>'家属',3=>'租户']];
            $this->assign($relation);
            $this->display('edit');
        }
    }

    /**
     * 编辑
     */
    public function edit($id)
    {
        if(IS_POST){
            //实例化模型
            $owner = D('OwnerCertification');
            $data = $owner->create();
            if ($data){
                if ($owner->add()){
                    $this->success('新增成功',U('certification'));
                }else{
                    $this->error('新增失败');
                }
            }else{
                $this->error($owner->getError());
            }
        }else{
            //根据id查询出数据
            $info = M('owner_certification')->find($id);
            if ($info == null){
                $this->error('数据未找到');
            }
            //回显到页面
            $this->meta_title = '编辑业主认证';
            $relation = ['relation'=>[1=>'本人',2=>'家属',3=>'租户']];
            $this->assign($info);
            $this->assign($relation);
            $this->display();
        }
    }

    /**
     * 审核
     */
    public function auditing($id)
    {
        $owner = M('owner_certification');
        $owner->id = $id;
        $owner->status = 2;
        if ($owner->save()){
            $this->success('审核通过');
        }else{
            $this->error('审核失败'.$owner->getError());
        }
    }

    //删除
    public function del($id = 0)
    {
        //判断是否选择操作的数据
        if (empty($id)){
            $this->error('请选择要操作的数据');
        }
        $owner = M('owner_certification');
        $owner->id = $id;
        $owner->status = -1;
        if ($owner->save()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败'.$owner->getError());
        }
    }
}