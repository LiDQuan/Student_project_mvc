<?php

    final class StudentController extends BaseController{

        private $stu = null;

        public function __construct(){
            $this->stu = FactroyModel::getInstance("StudentModel");
        }
        public function index(){
            $stuData = $this->stu->getdata();
            $records = $this->stu->getCount();
            include './App/Admin/View/Student/index.html';
        }

        public function add(){
            include './App/Admin/View/Student/add.html';
        }

        public function insert(){
            // 开始获取表单数据
            $arr = array(
                'stu_id' => $this->stu->get_MaxStu_id()['max(stu_id)'] + 1,
                'name' => $_POST['name'],
                'sex_sex' => $_POST['sex_sex'],
                'age' => $_POST['age'],
                'class_num' => $_POST['class_num'],
                'phone' => $_POST['phone'],
                'addr' => $_POST['addr']
            );
            if($this->stu->insert($arr)){
                $this->jump("学生信息插入成功", "?p=Admin&c=Student");
            }else{
                $this->jump("<h2>插入学生数据失败</h2>", "?p=Admin&c=Student");
            }
        }

        public function delete(){
            $id = $_GET['stu_id'];
            $result = $this->stu->delete($id);
            if($result){
                $this->jump("<h2>学生数据删除成功</h2>,三秒后跳转", "?p=Admin&c=Student");
            }else{
                $this->jump("<h2>删除数据失败，请检查输入是否正确</h2>", "?p=Admin&c=Student");
                }
        }

        public function edit(){
            // print_r($_GET);
            // 从地址栏中获取具体id信息
            $id = $_GET['id'];
            // print_r($id);
            // die();
            // 通过创建的对象类，将id传参到学生model类的edit方法中
            $arr = $this->stu->edit($id);
            // 包含修改学生信息视图 StudentEditView.html
            include "./App/Admin/View/Student/edit.html";
        }

        public function update(){
            // 获取新表单的数据，组成数组，丢入学生model类中
            $id = $_POST['id'];
            $arr = array(
                // 'stu_id' => $_POST['id'],
                'name' => $_POST['name'],
                'sex_sex' => $_POST['sex_sex'],
                'age' => $_POST['age'],
                'class_num' => $_POST['class_num'],
                'phone' => $_POST['phone'],
                'addr' => $_POST['addr']
            );
            // 根据返回信息提示是否修改成功
            if($this->stu->update($arr, $id)){
                $this->jump("学生信息修改成功", "?p=Admin&c=Student");
            }else{
                $this->jump("<h2>修改学生数据失败</h2>", "?p=Admin&=Student");
            }
        }
    }

?>