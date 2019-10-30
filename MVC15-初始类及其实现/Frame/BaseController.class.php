<?php
	/*
		基础控制器类，用于继承
	*/
	abstract class BaseController{
		// 定义受保护的跳转方法
		protected function jump($message, $url='?', $time=3){
				echo "<h>{$message}</h>";
				header("refresh:{$time};url={$url}");
				die(); // 终止程序继续运行
		}
	}
?>