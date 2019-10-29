<?php 
/*
 *基础模型类整合，使用抽象类定义基础模型类
 */
// 包含数据库类
require_once "./Model/Db.class.php";

	abstract class BaseModel{
		// 创建私有变量保存数据库对象,当设置抽象类的时候，这个对象要设置权限为受保护的
    	protected $db = null;
    	// 使用构造方法，当对象初始化时自动建好
    	public function __construct(){
	        $arr_config = array(
	        "db_host" => "localhost",
	        "db_user" => "root",
	        "db_pass" => "123456",
	        "db_name" => "student_project",
	        "charset" => "utf8"
	    );
	    $this->db = Db::getInstance($arr_config);
		}
	}

 ?>      