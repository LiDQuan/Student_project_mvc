<?php

    final class NewsController extends BaseController{

        private $new = null;    

        public function __construct(){
            $this->new = FactroyModel::getInstance("NewsModel");
        }

        public function delete(){
            $id = $_GET['nid'];    
            $result = $this->new->delete($id);
            if($result){
                $this->jump("<h2>新闻数据删除成功</h2>,三秒后跳转", "?c=News");
            }else{
                $this->jump("<h2>删除数据失败，请检查输入是否正确</h2>", "?c=News");
            }
        }

        public function index(){
            $newData = $this->new->getdata();
            $records = $this->new->getCount();
            include './View/News/index.html';
        }

        public function add(){
            include './View/News/add.html';
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
                $this->jump("新闻插入成功", "?c=News");
            }else{
                $this->jump("<h2>新闻插入数据失败</h2>", "?c=News");
            }
        }
    }
?>