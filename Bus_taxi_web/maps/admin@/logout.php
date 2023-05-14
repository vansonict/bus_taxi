<?php 
	session_start();
	session_destroy();		//Hủy bỏ session
	header("Location: login.php");
?>

