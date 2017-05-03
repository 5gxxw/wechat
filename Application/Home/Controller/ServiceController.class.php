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
                //去登录
                $this->login('Service/register');
            }
        }
    }

    /**
     * 关于我们
     */
    public function about()
    {
        //根据标识查询出关于我们的信息
        $row = M('document')->join('document_article ON document.id = document_article.id')->where(['name'=>'about'])->limit(1)->find();
        $this->assign('row',$row);
        $this->display();
    }
}