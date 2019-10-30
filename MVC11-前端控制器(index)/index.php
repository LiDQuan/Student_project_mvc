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



    // 获取用户动作参数，需要访问的页面以及动作内容
    // var_dump($_GET);
    $a = isset($_GET['a']) ? $_GET['a'] : 'index'; // 接收动作名
    $c = isset($_GET['c']) ? $_GET['c'] : 'Student'; // 接收控制器名


    $ControllerClassName = $c . "Controller";
    $obj = new $ControllerClassName();
    // 优化根据调用方法名优化if语句
    $obj->$a();
