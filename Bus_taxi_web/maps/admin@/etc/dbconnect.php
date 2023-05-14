<?php
	
	$host = 'localhost';
	$user = 'pingtaxi_svtt';
	$pass = 'svtt12345';
	$db = 'pingtaxi_dev';

    //Connect to server and select database;

    $link = mysql_connect ($host, $user, $pass);
    if (!$link) die (mysql_error());
    if (!mysql_select_db ($db, $link)) die("Database connection problem: " . mysql_error());

    mysql_query ("SET NAMES 'UTF8'");

?>
