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
class NewsModel extends BaseModel
{
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
    public function update($arr, $nid){
        $str_arr = "";
        foreach ($arr as $key => $value) {
            $str_arr .= $key."="."'".$value."'".",";
        }
        $str_arr = rtrim($str_arr, ",");

        // 组合sql
        $sql = "UPDATE news SET {$str_arr} WHERE nid = {$nid}";
        return $this->db->exec($sql);
    }

    // 获取查询数量
    public function getCount(){
        $sql = "SELECT * FROM news;";
        // print_r($sql);
        return $this->db->rowCount($sql);
    }

    // 查询一条数据
    public function fetchOne($nid){
        $sql = "SELECT * FROM news WHERE nid = {$nid}";
        return $this->db->fetchOne($sql);
    }

    // 实现插入新闻
    public function insertdata($arr_data){
        $sql = "INSERT INTO news VALUE({$arr_data['nid']}, '{$arr_data['cid']}', '{$arr_data['title']}', null, null, null, null, {$arr_data['orderby']}, '{$arr_data['content']}', {$arr_data['hits']}, {$arr_data['addate']})";
        // print_r($sql);
        return $this->db->exec($sql);
    }

    public function get_Max($row){
        $sql = "SELECT max($row) FROM news";
        return $this->db->fetchOne($sql);
    }
}
