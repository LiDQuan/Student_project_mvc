<?php
/**
 * @Author: Marte
 * @Date:   2019-10-24 22:35:23
 * @Last Modified by:   Marte
 * @Last Modified time: 2019-10-25 00:25:10
 */

/**
* 新闻模型类
*/
require_once("./Model/Db.class.php");
class NewsModel
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

    // 查询数据库并返回二维数组的新闻信息
    public function getdata(){
        // 创建数据库Db的对象
        // $db = Db::getInstance($this->arr_config);
        // 使用查询获取新闻字段
        $sql = "SELECT nid, title, source, hits, addate FROM news";
        return $this->db->fetchAll($sql);
    }

    public function delete($nid){
        // $db = Db::getInstance($this->arr_config);
        $sql = "DELETE FROM news WHERE nid = {$nid}";
        // echo "$sql";
        // DELECT FROM student_info WHERE stu_id = 5
        return $this->db->exec($sql);
    }

    // 获取查询数量
    public function getCount(){
        $sql = "SELECT * FROM news;";
        // print_r($sql);
        return $this->db->rowCount($sql);
    }
}
