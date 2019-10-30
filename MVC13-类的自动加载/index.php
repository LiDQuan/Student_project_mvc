<?php 
/*
mvc文件目录：
----index.php 				// 一切的入口
----Frame/					// 框架核心文件
----App/					// 应用目录
--------Conf/				// 配置文件目录
--------Home/				// 前台应用目录
------------Controller/		// 前台控制器目录
------------Model/			// 前台模型类目录
------------View/			// 前台视图目录
--------Admin/				// 后台应用目录
------------Controller/		// 后台控制器目录
------------Model/			// 后台模型类目录
------------View/			// 后台视图目录
----Public/ 				// 静态资源目录(css、js、html等)
--------Home/				// 前台资源目录
------------Images/			// 前台图片目录
------------Css/			// 前台CSS样式目录
------------JS/				// 前台JS文件目录
--------Admin/				// 后台台资源目录
------------Images/			// 后台图片目录
------------Css/			// 后台CSS样式目录
------------JS/				// 后台JS文件目录
----Uploads/				// 上传文件目录


*/
    // 获取用户动作参数，需要访问的页面以及动作内容
    // var_dump($_GET);
	// 获取路由参数
	$p = isset($_GET['p']) ? $_GET['p'] : 'Home'; // 平台参数
    $a = isset($_GET['a']) ? $_GET['a'] : 'index'; // 接收动作名
    $c = isset($_GET['c']) ? $_GET['c'] : 'Student'; // 接收控制器名
    // 定义常量 将平台数据传入
    define("PLAT", $p);


// 实现类的自动加载
spl_autoload_register(function($className){
    // 类文件的路径
    $arr = array(
        "./Frame/$className.class.php",
        "./App/".PLAT."/Model/$className.class.php",
        "./App/".PLAT."/Controller/$className.class.php"
    );

    foreach ($arr as $filename) {
        // 如果类文件存在，则包含
        if(file_exists($filename)){
            require_once "$filename";
        }
    }
});


// // 包含所有类文件

// // 这里是所有公共类文件目录
// require_once "./Frame/BaseController.class.php";
// require_once "./Frame/FactroyModel.class.php";
// require_once "./Frame/Db.class.php";
// require_once "./Frame/BaseModel.class.php";
// // 这里是所有控制器类文件目录
// require_once "./App/$p/Controller/NewsController.class.php";
// require_once "./App/$p/Controller/StudentController.class.php";
// // 这里是所有模型类文件
// require_once "./App/$p/Model/NewsModel.class.php";
// require_once "./App/$p/Model/StudentModel.class.php";




    $ControllerClassName = $c . "Controller";
    $obj = new $ControllerClassName();
    // 优化根据调用方法名优化if语句
    $obj->$a();
