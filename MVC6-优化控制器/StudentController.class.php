<?php

    // 包含工厂模型类，通过工厂模型类的最终类的静态方法来new对象，提高安全性
    // 调用最终类的静态方法是直接 类名::方法名($参数)
    require_once "./Model/FactroyModel.class.php";

    final class StudentController{

        private $stu = null;

        public function __construct(){
            $this->stu = FactroyModel::getInstance("StudentModel");
        }

        public function delete(){
            // 获取$_GET中的id
            $id = $_GET['stu_id'];
            // 创建学生模型对象，并调用delect删除方法
            $result = $this->stu->delete($id);
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
            $stuData = $this->stu->getdata();
            $records = $this->stu->getCount();
            include './StudentIndexView.html';
        }

        public function add(){
            include './StudentaddView.html';
        }

        public function insert(){
            // 开始获取表单数据
            $arr = array(
                'stu_id' => $this->stu->get_MaxStu_id()['max(stu_id)'] + 1,
                'name' => $_POST['name'],
                'sex' => $_POST['sex'] + 1,
                'age' => $_POST['age'],
                'class_num' => $_POST['class_num'],
                'phone' => $_POST['phone'],
                'addr' => $_POST['addr']
            );
            if($this->stu->insert($arr)){
                echo "数据插入成功", "<br/>";
                echo "三秒后返回学生信息管理页面","<br/>";
                header("refresh:3;url=./index.php");
            }else{
                echo "插入失败";
            }
        }
    }
    // 获取用户动作参数
    // var_dump($_GET);
    $ac = isset($_GET['ac']) ? $_GET['ac'] : 'index';
    $stuobj = new StudentController();
    // 与新闻控制器类相同，使用调用方法优化控制器代码
    $stuobj->$ac();
?>