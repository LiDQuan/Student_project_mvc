<?php

    // 包含学生model
    require_once "./Model/StudentModel.class.php";

    // 获取用户动作参数
    // var_dump($_GET);
    $ac = isset($_GET['ac']) ? $_GET['ac'] : '';
    if($ac == 'delete')
    {
        // 获取$_GET中的id
        $id = $_GET['stu_id'];
        // 创建学生模型对象，并调用delect删除方法
        $stu = new StudentModel();
        $result = $stu->delete($id);
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
        // 创建对象使用学生模型，获取学生数据
        #$db = Db::getInstance(); //不用创建数据库对象，因为这里是控制器，不用管数据是如何调用，只负责获取数据
        $stu = new StudentModel();
        // 调用学生模型类获取学生信息的二维数组
        $stuData = $stu->getdata();
    }
    // 显示视图
    include './StudentIndexView.html';

?>