<?php

    // 包含工厂模型类，通过工厂模型类的最终类的静态方法来new对象，提高安全性
    // 调用最终类的静态方法是直接 类名::方法名($参数)
    require_once "./Model/FactroyModel.class.php";

    final class NewsController{
        public function delete(){
            $id = $_GET['nid'];
            $new = FactroyModel::getInstance("NewsModel");
            $result = $new->delete($id);
            if($result){
                echo "<h2>数据删除成功</h2>,三秒后跳转","<br>";
                header("refresh:3;url=?");
                die();
            }else{
                echo "<h2>删除数据失败，请检查输入学号是否正确</h2>","<br>";
                header("refresh:3;url=?");
                die();
            }
        }

        public function index(){
            $new = FactroyModel::getInstance("NewsModel");
            $newData = $new->getdata();
            $records = $new->getCount();
            include './NewsIndexView.html';
        }
    }


    // 获取用户动作参数
    // var_dump($_GET);
    $ac = isset($_GET['ac']) ? $_GET['ac'] : '';
    $newobj = new NewsController();
    if($ac == 'delete')
    {
        $newobj->delete();
    }else{
        $newobj->index();
    }


?>