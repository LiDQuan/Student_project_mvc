<?php

//
final class Frame
{
	// 公共静态的框架初始化方法
	public static function run(){
		// 初始化配置信息
		self::initConfig();
		// 初始化路由参数
		self::initRoute();
		// // 初始化目录常量
		self::initConst();
		// // 初始化类的自动加载
		self::initAutoLoad();
		// // 初始化请求分发
		self::initDispatch();
	}


	// 私有的静态初始化配置信息
	private static function initConfig(){
		$GLOBALS['config'] = require_once("./App/Conf/config.php");
		// echo "<pre>";
		// print_r($GLOBALS);
	}

	// 私有的静态的初始化路由参数
	private static function initRoute(){
		// 获取路由参数
		$p = isset($_GET['p']) ? $_GET['p'] : $GLOBALS['config']['default_platform']; // 平台参数
		$a = isset($_GET['a']) ? $_GET['a'] : $GLOBALS['config']['default_action']; // 接收动作名
		$c = isset($_GET['c']) ? $_GET['c'] : $GLOBALS['config']['default_controller']; // 接收控制器名
		define("PLAT", $p);
		define("ACTION", $a);
		define("CONTROLLER", $c);
	}

	// 私有的静态的初始化目录常量
	private static function initConst(){
		define("DS", DIRECTORY_SEPARATOR);                                       // 动态目录分隔符
		define("ROOT_PATH", getcwd().DS);                                        // 根目录
		define("FRAME_PATH", ROOT_PATH."Frame".DS);                              // 公共类目录
		define("MODEL_PATH", ROOT_PATH."App".DS.PLAT.DS."Model".DS);             // 模型类目录
		define("CONTROLLER_PATH", ROOT_PATH."App".DS.PLAT.DS."Controller".DS);   // 控制器目录
		define("VIEW_PATH", ROOT_PATH."App".DS.PLAT.DS."View".DS.CONTROLLER.DS); // 视图文件目录
	}

	// 私有的静态的类的自动加载
	private static function initAutoLoad(){
		// 实现类的自动加载
		spl_autoload_register(function($className){
		    // 类文件的路径
		    $arr = array(
		        FRAME_PATH."$className.class.php",
		        MODEL_PATH."$className.class.php",
		        CONTROLLER_PATH."$className.class.php"
		    );

		    foreach ($arr as $filename) {
		        // 如果类文件存在，则包含
		        if(file_exists($filename)){
		            require_once "$filename";
		        }
		    }
		});
	}

	// 私有的静态的初始化请求分发
	// 创建哪个控制器类的对象，调用控制器对象的哪个方法？
	private static function initDispatch(){
	    $ControllerClassName = CONTROLLER . "Controller";
	    $obj = new $ControllerClassName();
	    // 优化根据调用方法名优化if语句
	    $a = ACTION;
	    $obj->$a();
	}

}


?>