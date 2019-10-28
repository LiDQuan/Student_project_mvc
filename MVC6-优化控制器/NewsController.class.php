<?php

    // 包含工厂模型类，通过工厂模型类的最终类的静态方法来new对象，提高安全性
    // 调用最终类的静态方法是直接 类名::方法名($参数)
    require_once "./Model/FactroyModel.class.php";

    final class NewsController{

        private $new = null;    

        public function __construct(){
            $this->new = FactroyModel::getInstance("NewsModel");
        }

        public function delete(){
            $id = $_GET['nid'];    
            $result = $this->new->delete($id);
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
            $newData = $this->new->getdata();
            $records = $this->new->getCount();
            include './NewsIndexView.html';
        }

        public function add(){
            include './NewsaddView.html';
        }

        public function insert(){
            date_default_timezone_set('UTC');
            $arr_data = array(
                'nid' => $this->new->get_Max('nid')['max(nid)'] + 1,
                'cid' => 'writeInput'.($this->new->get_Max('nid')['max(nid)'] + 1),
                'title' => $_POST['title'],
                'orderby' => $_POST['orderby'],
                'content' => $_POST['content'],
                'hits' => $_POST['hits'],
                'addate' => date('Y-m-d'),
            );
            if($this->new->insertdata($arr_data)){
                echo "新闻插入成功";
                header("refresh:1;url=./NewsController.class.php");
            }else{
                echo "插入失败。。。";
            }
        }
    }


    // 获取用户动作参数
    // var_dump($_GET);
    $ac = isset($_GET['ac']) ? $_GET['ac'] : 'index';
    $newobj = new NewsController();
    // 优化根据调用方法名优化if语句
    $newobj->$ac();

?>