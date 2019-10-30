<?php 
// 包含所有类文件

// 这里是所有公共类文件目录
require_once "./Frame/BaseController.class.php";
require_once "./Frame/FactroyModel.class.php";
require_once "./Frame/Db.class.php";
require_once "./Frame/BaseModel.class.php";
// 这里是所有控制器类文件目录
require_once "./Controller/NewsController.class.php";
require_once "./Controller/StudentController.class.php";
// 这里是所有模型类文件
require_once "./Model/NewsModel.class.php";
require_once "./Model/StudentModel.class.php";



    // 获取用户动作参数
    // var_dump($_GET);
    $ac = isset($_GET['ac']) ? $_GET['ac'] : 'index';
    $newobj = new NewsController();
    // 优化根据调用方法名优化if语句
    $newobj->$ac();
