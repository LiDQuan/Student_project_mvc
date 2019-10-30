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
class StudentModel extends BaseModel
{
    // 查询数据库并返回二维数组的学生信息
    public function getdata(){
        $sql = "SELECT stu_id, name, sex_sex, age, class_num, phone,addr  FROM student_info";
        return $this->db->fetchAll($sql);
    }

    // 根据id删除信息
    public function delete($stu_id){
        $sql = "DELETE FROM student_info WHERE stu_id = {$stu_id}";
        return $this->db->exec($sql);
    }

    // 插入学生信息
    public function insert($arr){
        $str_arr = "";
        $field = "";
        foreach ($arr as $key => $value) {
            $field .= "{$key},";
            $str_arr .= "'{$value}',";
        }
        $field = rtrim($field, ",");
        $str_arr = rtrim($str_arr, ",");
        $sql = "INSERT INTO student_info($field) VALUE($str_arr)";
        return $this->db->exec($sql);
    }

    // 定义获取一条学生记录的方法
    public function edit($id){
        $sql = "SELECT * FROM student_info WHERE id = {$id}";
        return $this->db->fetchOne($sql);
    }

    // 更新学生信息
    public function update($arr, $id){
        $str = "";
        foreach ($arr as $key => $value) {
            $str .= "{$key}='{$value}'".",";
        }
        $str = rtrim($str, ",");
        $sql = "UPDATE student_info SET {$str} WHERE id = {$id}";
        return $this->db->exec($sql);
    }

    // 获取查询数量
    public function getCount(){
        $sql = "SELECT * FROM student_info;";
        // print_r($sql);
        return $this->db->rowCount($sql);
    }

    // 获取学号最大值
    public function get_MaxStu_id(){
        $sql = "SELECT max(stu_id) FROM student_info";
        return $this->db->fetchOne($sql);
    }
}
