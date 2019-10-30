<?php

// 返回配置数组
return array(
	// 数据库配置文件
    "db_host" 				=> "localhost",			// 数据库连接服务器地址
    "db_user" 				=> "root",				// 数据库登录名
    "db_pass" 				=> "123456",			// 数据库连接sa密码 
    "db_name" 				=> "student_project",	// 默认连接数据库
    "charset" 				=> "utf8",				// 默认连接字符集为utf8


	// 默认路由参数
	'default_platform'		=> 'Home',				// 默认进入前台
	'default_controller'	=> 'Student',			// 默认进入学生控制器
	'default_action'		=>	'index',			// 默认打开index主页面
);

?>