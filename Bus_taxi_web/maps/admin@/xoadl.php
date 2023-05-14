<?php
    ob_start();
    session_start();
    require_once ('etc/XLThong_tin_DL.php');
 ?>
        <html xmlns="http://www.w3.org/1999/xhtml"><head>
            <title>Ping-Taxi</title>
            <meta content="vi" http-equiv="content-language">
            <meta content="text/html; charset=UTF-8" http-equiv="content-type"></head>
<?php
	if(isset($_SESSION['type_user']) && $_SESSION['type_user'] != 2){
		$name = $_REQUEST['name'];
		if($name){
                        $kt = $c_student->chi_tiet_parent($name);
                        //var_dump($kt);
                        if(count($kt) > 0){
                            ?>
                                <script type="text/javascript">  
                                        //var rs = confirm("Đại lý này có cấp dưới, bạn có muốn xóa?");
                                        //if(rs == true){
                                            <?php 
                                                /*foreach ($kt as $kt){
                                                    $c_student -> xoa($kt['name']);
                                                }
                                                $rs = $c_student -> xoa($name);*/
                                            ?>
                                        //}
                                        alert('Đại lý có đại lý con, không thể xóa!');
                                        window.location = "http://pingtaxi.com.vn/maps/admin@/daily.php";
                                </script>
                            <?php
                        }else{
                            $rs = $c_student -> xoa($name);
                        }
                        if($rs){
                            echo "<script>alert(\"Bạn đã xóa đại lý thành công!\")</script>";
                            echo "<script type=\"text/javascript\"> <!--
                            function exec_refresh()
                            {
                                    window.status = \"Ðang chuyển tới ...\" + myvar;
                                    myvar = myvar + \" .\";
                                    var timerID = setTimeout(\"exec_refresh();\", 10);
                                    if (timeout > 0)
                                    {
                                            timeout -= 1;
                                    }
                                    else
                                    {
                                            clearTimeout(timerID);
                                            window.status = \"\";
                                            window.location = \"http://pingtaxi.com.vn/maps/admin@/daily.php\";
                                    }
                            }

                            var myvar = \"\";
                            var timeout = 10;
                            exec_refresh();
                            //--> </script> ";
                        }
                } else 
                        header('Location: http://pingtaxi.com.vn/maps/admin@/daily.php');
	} else {
		echo "<script>alert(\"Quyền hạn của bạn không đủ!\")</script>";
		echo "<script type=\"text/javascript\"> <!--
		function exec_refresh()
		{
			window.status = \"Ðang chuyển tới ...\" + myvar;
			myvar = myvar + " .";
			var timerID = setTimeout(\"exec_refresh();\", 10);
			if (timeout > 0)
			{
				timeout -= 1;
			}
			else
			{
				clearTimeout(timerID);
				window.status = \"\";
				window.location = \"http://pingtaxi.com.vn/maps/admin@/daily.php\";
			}
		}
		 
		var myvar = \"\";
		var timeout = 10;
		exec_refresh();
		//--> </script> ";
		//header('Location: javascript:window.history.go(-1);');
	}
    ob_flush();
?>
</html>