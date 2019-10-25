<?php
/**
 * @Author: Marte
 * @Date:   2019-10-24 22:35:23
 * @Last Modified by:   Marte
 * @Last Modified time: 2019-10-25 00:25:10
 */

/**
* 学生模型类
*/
require_once("./Model/Db.class.php");
class StudentModel
{
    // 创建私有变量保存数据库对象
    private $db = null;
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

    // 查询数据库并返回二维数组的学生信息
    public function getdata(){
        // 创建数据库Db的对象
        // $db = Db::getInstance($this->arr_config);
        // 使用联合查询
        $sql = "SELECT stu_id, name, sex_sex, age, class_num, phone,addr  FROM student_info as stu INNER JOIN sex_info as sex on stu.sex = sex.sex_id";
        return $this->db->fetchAll($sql);
    }

    public function delete($stu_id){
        // $db = Db::getInstance($this->arr_config);
        $sql = "DELETE FROM student_info WHERE stu_id = {$stu_id}";
        // echo "$sql";
        // DELECT FROM student_info WHERE stu_id = 5
        return $this->db->exec($sql);
    }
}
