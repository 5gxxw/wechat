<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/30
 * Time: 22:31
 */

namespace Home\Controller;

class ServiceController extends HomeController
{
    /**
     * 服务
     */
    public function index()
    {
        $this->display();
    }

    /**
     * 业主认证
     */
    public function register()
    {
        if (IS_POST){
            //实例化模型
            $owner = D('OwnerCertification');
            $data = $owner->create();
            if ($data){
                if ($owner->add()){
                    $this->success('发起认证成功,等待审核',U('Service/index'));
                }else{
                    $this->error('认证失败');
                }
            }else{
                $this->error($owner->getError());
            }
        }else{
            //判断是否登录
            if($id = is_login()){
                //判断是否已经提交
                $row = M('owner_certification')->where(['uid'=>$id])->find();
                if ($row['status'] == 1){
                    $this->success('认证已经提交,请等待审核',U('Service/index'),3);
                }elseif($row['status'] == 2){
                    $this->success('认证已经通过',U('Service/index'),3);
                }else{
                    $relation = ['relation'=>[1=>'本人',2=>'家属',3=>'租户']];
                    $this->assign($relation);
                    $this->display();
                }
            }else{
                $this->error('请先登录',U('User/login'));
            }
        }
    }

    /**
     * 生活小贴士
     */
    /* public function life($category_id = 0)
    {
        if (empty($category_id)){
            $this->error('没有该分类');
        }
        //根据文章分类id查询出所有文章
        $map['status'] = ['GT',0];
        $map['category_id'] = $category_id;
        $rows = M('document')->where($map)->select();
        $this->assign($rows);
        $this->display(T('Center/document'));
    } */

    /**
     * 关于我们
     */
    public function about()
    {
        $this->display();
    }
}