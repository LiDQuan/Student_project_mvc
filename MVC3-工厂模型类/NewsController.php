<?php

    // 包含工厂模型类，通过工厂模型类的最终类的静态方法来new对象，提高安全性
    // 调用最终类的静态方法是直接 类名::方法名($参数)
    require_once "./Model/FactroyModel.class.php";

    // 获取用户动作参数
    // var_dump($_GET);
    $ac = isset($_GET['ac']) ? $_GET['ac'] : '';
    if($ac == 'delete')
    {
        // 获取$_GET中的id
        $id = $_GET['nid'];
        // 创建新闻模型对象，并调用delect删除方法
        $new = FactroyModel::getInstance("NewsModel");
        $result = $new->delete($id);
        // 最后通过delect方法返回值判断是否删除成功
        if($result){
            echo "<h2>数据删除成功</h2>,三秒后跳转","<br>";
            header("refresh:3;url=?");
            die();
        }else{
            echo "<h2>删除数据失败，请检查输入学号是否正确</h2>","<br>";
            header("refresh:3;url=?");
            die();
        }
    }else{
        // 创建对象使用新闻模型，获取学生数据
        #$db = Db::getInstance(); //不用创建数据库对象，因为这里是控制器，不用管数据是如何调用，只负责获取数据
        $new = FactroyModel::getInstance("NewsModel");
        // 调用学生模型类获取学生信息的二维数组
        $newData = $new->getdata();
        // 调用新闻类模型获取新闻总条数
        // $records = $new->getCount();
        $records = $new->getCount();
    }
    // 显示视图
    include './NewsIndexView.html';

?>