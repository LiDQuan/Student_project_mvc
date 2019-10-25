<?php
    // 调用model类文件
    require_once("./model/model.class.php");

    // 获取地址栏传过来的参数
    $type = isset($_GET["type"]) ? $_GET["type"] : "3";

    // 创建模型变量对象$modelobj
    $modelobj = new dataTime();
    switch ($type) {
        case 1:
            $str = $modelobj->getTime();
            break;
        case 2:
            $str = $modelobj->getDate();
            break;
        case 3:
            $str = $modelobj->getDateTime();
            # code...
            break;
}

    // 包含视图view
    include './view.html';
 ?>