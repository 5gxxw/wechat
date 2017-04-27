<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/26
 * Time: 11:27
 */

namespace Admin\Controller;


use Think\Page;

class CenterController extends AdminController
{
    //报修管理
    public function repair()
    {
        $pid = I('get.id',0);
        //实例化模型对象
        $model = M('repair');
        //实现分页的方法lists()
        $list = $this->lists('repair');

        //分配视图
        $this->assign('list',$list);
        $this->assign('pid',$pid);
        $this->mate_title = '报修管理';
        $this->display('index');
    }

    //新增
    public function add()
    {
        if (IS_POST){
            //实例化模型
            $repair = D('repair');
            //根据表单提交的post数据创建数据对象,返回数据对象数组
            $data = $repair->create();
            //判断是否有数据
            if ($data){
                //将数据写入数据表,返回最新插入的数据的id
                $id = $repair->add();
                if ($id){
                    //提示跳转
                    $this->success('新增成功',U('repair'));
                }else{
                    //提示失败信息
                    $this->error('新增失败');
                }
            }else{
                //提示失败信息
                $this->error($repair->getError());
            }
        }else{
            $model = M('repair');
            $this->assign('info',null);
            $this->display('edit');
        }
    }

    //编辑
    public function edit($id = 0)
    {
        if (IS_POST){
            //实例化模型对象
            $repair = D('Repair');
            //根据表单提交的post数据创建数据对象
            $data = $repair->create();
            if ($data){
                //修改
                if($repair->save()){
                    //记录行为

                    $this->success('编辑成功',U('Repair'));
                }else{
                    $this->error($repair->getError());
                    $this->error('编辑失败');
                }
            }else{
                $this->error($repair->getError());
            }
        }else{
            //根据id取出数据
            $info = M('Repair')->find($id);
            if ($info == false){
                $this->error('');
            }
            //回显到页面
            $this->assign('info',$info);
            $this->meta_title = '编辑报修';
            $this->display();
        }
    }

    //删除
    public function del()
    {
        //获取所有要删除的数据的id
        $id = I('get.id',0);
        //判断是否选择操作的数据
        if (empty($id)){
            $this->error('请选择要操作的数据');
        }

        if (M('Repair')->where('id='.$id)->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    //处理状态
    public function setstatus($status = 0,$id=0){
        //实例化模型对象
        $repair = M('Repair');
        $repair->status = $status;
        //更新状态
        if($repair->where('id='.$id)->save()){
            $this->success('更改成功');
        }else{
            $this->error('更新失败');
        }
    }
}