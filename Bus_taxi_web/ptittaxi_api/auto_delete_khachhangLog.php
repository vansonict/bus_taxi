<?php 
    include_once 'database.php';
    
    $db = new DBQuery;
    $sql_del_gd1_khachhangLog = "SELECT * 
                                 FROM tbl_gd1_khachhangLog
                                 WHERE time_stamp < DATE_SUB(NOW(), INTERVAL 1 HOUR)";
    $rs_gd1 = $db -> loadArray($sql_del_gd1_khachhangLog);
    //die;
    foreach ($rs_gd1 as $rs_gd1) {
        $db ->insert_query('tbl_history', $rs_gd1);
        $db -> delete_query('tbl_gd1_khachhangLog', 'id='.$rs_gd1['id']);
    }
    $sql_del_khachhangLog = "SELECT * 
                                 FROM tbl_khachhangLog
                                 WHERE time_stamp < DATE_SUB(NOW(), INTERVAL 1 HOUR)";
    $rs_gd = $db -> loadArray($sql_del_khachhangLog);
    foreach ($rs_gd as $rs_gd) {
        $db ->insert_query('tbl_history', $rs_gd);
        $db -> delete_query('tbl_khachhangLog', 'id='.$rs_gd['id']);
    }
?>