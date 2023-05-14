<?php
        ob_start(); // khởi động buffer
	require_once ('xlnguoidung.php');
	if(isset($_POST['username'],$_POST['password'])){
		$check = $c_user -> Dang_nhap($_POST['username'], $_POST['password']);
		if ($check){
			header("Location: " . address . "maps/admin@/daily.php");
		} else
			header("Location: " . address . "maps/admin@/login.php");
	}elseif(isset($_SESSION['user'])){
			header("Location: " . address . "maps/admin@/daily.php");
	}else
		header("Location: " . address . "login.php");
        ob_flush();  // làm sạch buffer
?>
