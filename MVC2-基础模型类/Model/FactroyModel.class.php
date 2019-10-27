<?php 

	/*
		定义最终的工厂模型类
		主要用来生产不同模型的对象
	*/
	// 包含所有模型类
	require_once "./Model/NewsModel.class.php";
	require_once "./Model/StudentModel.class.php";

	final class FactroyModel{
		// 公共的、静态的创建不同模型类对象的方法
		// 即任何model对象名称传入都能new对象，无需在具体model中实例化对象
		public static function getInstance($modelClassName){
			// 创建指定模型类对象，并且返回
			return new $modelClassName();
		}
	}


 ?>