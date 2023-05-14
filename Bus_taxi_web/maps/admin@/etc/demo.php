<?php

/**
 * @author kelvin
 * @copyright 2012
 */

//Ví dụ có bảng user(user_id, user_name) --
/**
 * user_id = 1, user_name = 'kelvin'
 * 
 * user_id = 2, user_name = 'kelvin dang'
 * */

// muốn lấy tất cả thông tin của cả 2 user thì làm như sau
include_once("database1.php");
$db = new DBQuery;
$sql = 'SELECT * FROM user';
$rows_user = $db->query($sql);

echo "<pre>";
print_r($rows_user);
echo "</pre>";
		
?>