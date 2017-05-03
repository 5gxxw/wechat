<?php
/**
 * 小区租售
 */

namespace Admin\Controller;


class RentalController extends AdminController
{
    //小区租售显示
    public function index()
    {
        //实例化对象,查询所有租售信息
        $map['status'] = ['GT',0];
        $rentals = M('rental')->where($map)->select();
        $this->assign('rentals',$rentals);
        $this->display();
    }

    //新增
    public function add()
    {
        if(IS_POST){
            //实例化模型
            $rental = D('Rental');
            $data = $rental->create();
            if ($data){
                //动态设置租售内容自动验证
                $details = M('rental_details');
                $rules = [['content','require','请填写内容',1]];
                if (!$details->validate($rules)->create()){
                    //验证失败
                    $this->error($details->getError());
                }
                //保存租售内容,得到id
                if (!$rental->detail_id = $details->add()){
                    $this->error('内容添加失败');
                }
                //保存租售信息
                if ($rental->add()){
                    $this->success('新增成功',U('index'));
                }else{
                    $this->error('新增失败');
                }
            }else{
                $this->error($rental->getError());
            }
        }else{
            $danwei = ['danwei'=>[1=>'元/月',2=>'万元']];
            $this->assign($danwei);
            $this->display('edit');
        }
    }

    //编辑
    public function edit($id = 0)
    {
        if (IS_POST){
            //实例化模型
            $rental = D('Rental');
            $data = $rental->create();

            if ($data){
                //动态设置租售内容自动验证
                $details = M('rental_details');
                $rules = [['content','require','请填写内容',1]];
                $data = $details->validate($rules)->create();
                if (!$data){
                    //验证失败
                    $this->error($details->getError());
                }
                //保存租售内容,得到id
                $details->save();
                //保存租售信息
                if ($rental->save()){
                    $this->success('编辑成功',U('index'));
                }else{
                    $this->error($rental->getError());
                }
            }else{
                $this->error($rental->getError());
            }
        }else{
            //根据id取出数据
            $info = M('rental')->join('rental_details ON rental.detail_id = rental_details.id')->where(['rental.id'=>$id])->find();
            if ($info == null){
                $this->error('数据未找到');
            }
            //回显到页面
            $this->meta_title = '编辑小区租售';
            $danwei = ['danwei'=>[1=>'元/月',2=>'万元']];
            $this->assign('info',$info);
            $this->assign($danwei);
            $this->display();
        }
    }

    //删除
    public function del($id = 0)
    {
        //判断是否选择操作的数据
        if (empty($id)){
            $this->error('请选择要操作的数据');
        }
        $data['status'] = -1;
        if (M('rental')->data($data)->where('id='.$id)->save()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}