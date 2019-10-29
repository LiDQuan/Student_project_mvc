<?php
	/*
		基础控制器类，用于继承
	*/
    // 包含工厂模型类，通过工厂模型类的最终类的静态方法来new对象，提高安全性
    // 调用最终类的静态方法是直接 类名::方法名($参数)
    require_once "./Model/FactroyModel.class.php";

	abstract class BaseController{
		// 定义受保护的跳转方法
		protected function jump($message, $url='?', $time=3){
				echo "<h>{$message}</h>";
				header("refresh:{$time};url={$url}");
				die(); // 终止程序继续运行
		}
	}
?>