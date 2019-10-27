<?php

    // 包含工厂模型类，通过工厂模型类的最终类的静态方法来new对象，提高安全性
    // 调用最终类的静态方法是直接 类名::方法名($参数)
    require_once "./Model/FactroyModel.class.php";

    final class StudentController{
        public function delete(){
            // 获取$_GET中的id
            $id = $_GET['stu_id'];
            // 创建学生模型对象，并调用delect删除方法
            $stu = FactroyModel::getInstance("StudentModel");
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
            }

        public function index(){
            $stu = FactroyModel::getInstance("StudentModel");
            $stuData = $stu->getdata();
            include './StudentIndexView.html';
        }
    }
    // 获取用户动作参数
    // var_dump($_GET);
    $ac = isset($_GET['ac']) ? $_GET['ac'] : '';
    $stuobj = new StudentController();
    if($ac == 'delete')
    {
        $stuobj->delete();
    }else{
        $stuobj->index();
    }
?>