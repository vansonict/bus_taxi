<?php		
	$host = 'localhost';	
	$user = 'root';	
	$pass = '';	
	$db = 'ptit-taxi';    
	//Connect to server and select database;    
	$link = mysql_connect ($host, $user, $pass);    
	if (!$link) die (mysql_error());    
	if (!mysql_select_db ($db, $link)) 
	die("Database connection problem: " . mysql_error());   
	mysql_query ("SET NAMES 'UTF8'");
?>