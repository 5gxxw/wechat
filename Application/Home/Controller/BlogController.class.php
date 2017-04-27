<?php
/**
 *
 */

namespace Home\Controller;


class BlogController extends HomeController
{
    public function index()
    {
        echo 'holle word!';
        //操作配置文件的
//        $model = C('DOWNLOAD_UPLOAD.subName');
        //实例化模型
//        $model = D('blog');
//        $name = $model->blogname;
        //获取模板
//        $model = T('');

//            B('')
//        var_dump($name);
//        var_dump($_GET['status']);
//        var_dump($_GET['id']);

        $model = M('Repair');
        dump($model);

    }

    public function read()
    {
        //实例化一个没有模型的模型对象
        $blog = M('blog');
        if(isset($_GET['id'])){
            //根据id查询结果
            $data = $blog->find($_GET['id']);
            var_dump($data);
        }
    }

    //空操作
    public function _empty()
    {
        echo '空操作';
        $this->index();
    }

    //使用行为
    public function _initialize()
    {
        $a = '你好';
        B('Home\Behavior\Blog',$a);
    }
}