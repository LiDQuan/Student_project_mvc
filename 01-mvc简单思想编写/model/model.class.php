<?php
/**
 * @Author: Marte
 * @Date:   2019-10-24 21:03:21
 * @Last Modified by:   Marte
 * @Last Modified time: 2019-10-24 21:48:16
 */
class dataTime{
    public function getDate(){
        // 获取当前日期
        return date("Y年m月d日");
    }

    public function getTime(){
        // 获取当前时间
        return date("G:i:s");
    }

    public function getDateTime(){
        // 获取当前日期和时间
        return date("Y年m月d日")." ".date("G:i:s");
    }
}