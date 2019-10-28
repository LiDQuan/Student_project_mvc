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
// 包含基础模型类，并继承基础模型类
require_once "./Model/BaseModel.class.php";

class StudentModel extends BaseModel
{
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

    public function insert($arr){
        // $str_arr = implode(",", $arr);
        $sql = "INSERT INTO student_info VALUE(null, {$arr['stu_id']}, '{$arr['name']}', {$arr['sex']}, {$arr['age']}, {$arr['class_num']}, {$arr['phone']}, '{$arr['addr']}')";
        return $this->db->exec($sql);
    }

    // 获取查询数量
    public function getCount(){
        $sql = "SELECT * FROM student_info;";
        // print_r($sql);
        return $this->db->rowCount($sql);
    }

    public function get_MaxStu_id(){
        $sql = "SELECT max(stu_id) FROM student_info";
        return $this->db->fetchOne($sql);
    }
}
