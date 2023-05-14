<?php 
	include('etc/xlnguoidung.php');
	$username=$_REQUEST['username'];
	$c_login -> xoa($username);
?>
