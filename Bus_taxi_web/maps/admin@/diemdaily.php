<?php 
	session_start();
	include_once ('etc/XLThong_tin_DL.php');
	include_once ('etc/dbconnect.php');
	require_once ('etc/paper.php');
	if(isset($_SESSION['user'])){
		$pp = "10"; //Số record trên một trang
			
		
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>Ping-Taxi ++ Đại lý</title>
<meta content="vi" http-equiv="content-language">
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<link type="image/x-icon" href="images/logoico.png" rel="SHORTCUT ICON">
<meta content="" name="copyright">
<meta content="" name="generator">
<link type="text/css" href="css/css.css" rel="Stylesheet">
<!--<script type="text/javascript" src="javascripts/scripts.js"></script> -->
<script type="text/javascript" src="javascripts/jquery.js"></script>
<script type="text/javascript" src="javascripts/global.js"></script>
<script src="javascripts/ddsmoothmenu.js" type="text/javascript"></script>
<script src="javascripts/javascript.js" type="text/javascript"></script>
<script src="javascripts/jquery.tooltip.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});

function checkinput(){
	if(form1.select.value==""){
		alert("Xin vui lòng nhập tháng cần tìm");
		document.form1.select.focus();
		return false;
	}
	if(form1.option.value==""){
		form1.option.value = "2";
		
	}
	if(form1.madaily.value ==""){
		alert("Bạn chua nhập mã đại lý!");
		document.form1.dailyid.focus();
		return false;
	}
	var ty = '';
	ty = <?php echo $_SESSION['type_user'] ?>;
	if((form1.madaily.value == "00")&&(ty != 0)){
		alert("Bạn không đủ quyền truy xuất!");
		document.form1.madaily.focus();
	}
}		

</script> 
</head>
<body onLoad="javascript:winOnload();" onResize="javascript:winOnload();">
<div id="outer">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <div id="header">
    	<div class="logo">
            <div>
            <table border="0" style="margin:1px 0 0 80px; padding:0; width:85px;">
                <tr>
                    <td class="logo2">P</td>
                    <td class="logo2">I</td>
                    <td class="logo2">N</td>
                    <td class="logo2">G</td>
                    <td class="logo2">-</td>
                    <td class="logo2">T</td>
                    <td class="logo2">A</td>
                    <td class="logo2">X</td>
                    <td class="logo2">I</td>
                </tr>
            </table>
            </div>
            <div id="bannerTitle"><span></span></div>
        </div>
        <div class="logout">
        	<a class="bthome" href="#"><span>Đăng ký ping-taxi</span></a> <a class="bthome" href="javascript:void(0);" onClick="logout();"><span class="iconexit">Thoát</span></a>
        </div>
	</div>
    
    <div style="">
    	<?php 
			require('includes/menu_top.php');
		?>
	</div>
    
    <div id="top_message">
		<?php if($_SESSION['type_user'] != 3){ ?>
    	<div class="clock_container">
        	<div class="clock"><label><span id="digclock"><?php echo gmdate('d/m/Y - g:i s A',time()+7*3600);?></span></label>
			</div>
		</div>
        <div class="info">Xin chào: <strong><?php echo $_SESSION['user']; ?></strong>! </div>
		<?php 
			} else {
		?>
			<div class="clock_container1">
        		<div class="clock"><label><span id="digclock"><?php echo gmdate('d/m/Y - g:i s A',time()+7*3600);?></span></label>
				</div>
			</div>
       		<div class="info">Xin chào: <strong><?php echo $_SESSION['user']; ?></strong>! </div>
		<?php
			}	
		?>
        <div class="clear"></div>
	</div>
    <div id="middle_outer">
    	<table class="table_full" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
            					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <td style="display: none;" class="colum_left_small" valign="top"><span class="lage" onClick="clickHide(2)">&nbsp;</span></td>
                <td class="colum_left_lage" valign="top">
                	<div style="padding-right:20px; padding-left:4px; width:200px">
                    	<div class="divclose"><span class="small" onClick="clickHide(1);">&nbsp;</span></div>
                        <div id="middle_column_l">
                            <div id="ver_menu">
                               	<?php 
							   		include('includes/menu_sub.php'); 
								?>
                            </div>
                        </div>
                    </div>
					<script type="text/javascript">
                    show_menu();
                    </script>
                </td>
                <td bgcolor="#F2F2F2" valign="top">
                	<!-- <iframe id="ifrRight" name="ifrRight" frameborder="0" scrolling="auto" src="../Help/default.asp" style="border:solid 0px #cecece;"></iframe> -->
                	<!--Nội dung chính -->
                    <div class="">
                    	<form action="" name="form1" method="post" class="" onSubmit="checkinput()">
                    		<label>Mã đại lý</lable>
                    		<input id = "madaily" name ="madaily" size ="1" style="width: 200px" value =""></input>
                    		<label for ="select">Chọn tháng</label>
							<select id ="select" name ="select" size ="1" style="width: 200px">
								<option value = "2013-01">Tháng 1 năm 2013</option>
								<option value = "2013-02">Tháng 2 năm 2013</option>
								<option value = "2013-03">Tháng 3 năm 2013</option>
								<option value = "2013-04">Tháng 4 năm 2013</option>
								<option value = "2013-05">Tháng 5 năm 2013</option>
								<option value = "2013-06">Tháng 6 năm 2013</option>
								<option value = "2013-07">Tháng 7 năm 2013</option>
								<option value = "2013-08">Tháng 8 năm 2013</option>
								<option value = "2013-09">Tháng 9 năm 2013</option>
								<option value = "2013-10">Tháng 10 năm 2013</option>
								<option value = "2013-11">Tháng 11 năm 2013</option>
								<option value = "2013-12">Tháng 12 năm 2013</option>
							</select>
							<tb>
							<label for ="">Hiển thị</label>
							<select id ="option" name = "option" size ="1" style="width: 200px">
								<option value ="2">Tất cả các cuộc gọi</option>
								<option value ="0">Cuộc gọi nhỡ </option>
								<option value ="1">Cuộc gọi thành công </option>
							</select>
							<input type ="submit" id ="submitmonth" name ="submitmonth"/>
						</form>
	                </div>
                    <div id="middle_column_r">
                       <?php
          	 	$sql = "";
          	 	$thang = $_POST['select'];
          	 	if(isset($_POST['madaily']) || $_POST['madaily'] != ''){
					$madaily = $_POST['madaily'];
					
				}
          	 	//$madaily = $_POST['madaily'];
          	 	$option = $_POST['option'];
          	 	//phan nay dung cho phan trang
          	 	if(!isset($_GET['page'])){
					$_GET['page']=1;
				}
			$vitri = ($_GET['page']-1)*15;
          	 	//het phan phan trang
          	 	if($_POST['madaily'] != ""){
          	 	if($_POST['madaily'] == "00" && $_SESSION['type_user'] == 0){
          	 		$sql ="	SELECT hs.daily_id, hs.time_stamp,hs.status,hs.phonenumber, hang.name, loai.description, hs.khach_hang_log
				FROM tbl_history AS hs,tbl_hangtaxi AS hang, tbl_loaitaxi AS loai 
				WHERE 	hs.time_stamp like '".$thang."%'
					AND hang.id = hs.hangtaxi_id
					AND loai.id = hs.loaitaxi_id
					limit ".$vitri.",15
				";
          	 	}elseif($_POST['option'] == 2){
				$sql ="	SELECT hs.daily_id, hs.time_stamp,hs.status,hs.phonenumber, hang.name, loai.description, hs.khach_hang_log
				FROM tbl_history AS hs,tbl_hangtaxi AS hang, tbl_loaitaxi AS loai 
				WHERE 	hs.daily_id like '".$madaily."%'
					
					AND hs.time_stamp like '".$thang."%'
					AND hang.id = hs.hangtaxi_id
					AND loai.id = hs.loaitaxi_id
					limit ".$vitri.",15
				";
			}else{
				$sql ="	SELECT hs.daily_id, hs.time_stamp,hs.status,hs.phonenumber, hang.name, loai.description, hs.khach_hang_log
				FROM tbl_history AS hs,tbl_hangtaxi AS hang, tbl_loaitaxi AS loai 
				WHERE 	hs.daily_id like '".$madaily."%'
					AND hs.status like '".$option."'
					AND hs.time_stamp like '".$thang."%'
					AND hang.id = hs.hangtaxi_id
					AND loai.id = hs.loaitaxi_id
					limit ".$vitri.",15
				";
			}
			//echo "===========================================".$sql."=======================================";
			$result1 = mysql_query($sql);
			//echo mysql_num_rows($result1);
			if(mysql_num_rows($result1) > 0 ){
			$thanhcong =0;
			$thatbai=0;
			$num_rows = mysql_num_rows($result1);
				echo"<table border = '1' cellpadding = '5px' style='text-align:center;'>
					<tr><th>Mã đại lý</th>
					<th>Giờ gọi</th>
					<th>Hãng xe</th>
					<th>Loại xe</th>
					<th>Số điện thoại</th>
					<th>Trạng thái cuộc gọi</th>
					<th>Phản hồi khách hàng</th>
					<tr>";
				while($row = mysql_fetch_array($result1))
				{
					echo"<tr>";
					echo"<td>" .$row['daily_id']."</td>";
					echo"<td>" .$row['time_stamp']."</td>";
					echo"<td>" .$row['name']."</td>";
					echo"<td>" .$row['description']."</td>";
					echo"<td>" .$row['phonenumber']."</td>";
					if($row['status']==1){
						echo"<td>Thành công</td>";
						$thanhcong++;
					}else{
						echo"<td>Cuộc gọi nhỡ</td>";
						$thatbai++;
					}
					echo "<td>" .$row['khach_hang_log']. "</td>";
				}
			echo "Số cuộc gọi tới mã đại lý ".$madaily." trong tháng ".$thang." là ".$num_rows." cuộc gọi</br>";
			echo "Số cuộc gọi thành công: ".$thanhcong." cuộc gọi</br>";
			echo "Số cuộc gọi nhỡ: ".$thatbai." cuộc gọi</br>";
			
              		 	echo"</table>";	 
              		 }else{
              		 	echo "Bạn chưa nhập mã đại lý! </br>";
              		 	}
            //bat dau phan trang
            	$tongsotrang = floor($num_rows/15)+1;
            //
            	if($_GET['page']>1){
            	echo "<a href ='diemdaily.php?page=".($_GET['page']-1)."'>Back</a>";
            	}
            	for($i =1; $i< $tongsotrang; $i++){
					if($i == $_GET['page']){
						echo"[Trang".$i."]";
					}
					if($_GET['page'] != 1 && $_GET['page'] != $tongsotrang){
					echo"<a href ='diemdaily.php?page=".$i."'>Trang".$i."</a>";
					}
				}
				
				if($_GET['page']< $tongsotrang-1){echo "<a href ='diemdaily.php?page=".($_GET['page']+1)."'>Next</a>";}
            //het phan phan trang
	            	 }  else{echo "Chưa có dữ liệu hiển thị!\n Vui lòng điều chỉnh tùy chọn bên trên!";
	            	 	echo"<table border = '1' cellpadding = '5px' style='text-align:center;'>
					<tr><th>Mã đại lý</th>
					<th>Giờ gọi</th>
					<th>Hãng xe</th>
					<th>Loại xe</th>
					<th>Số điện thoại</th>
					<th>Trạng thái cuộc gọi</th>
					<th>Phản hồi khách hàng</th>
					<tr></table>";
	            	 } 
	             ?>	
                       
                        <div style="clear:both"></div>
                    </div>
                    <!-- -->
                    </td>
                    </tr>
		</table>
	</div>
   <div id="footer" class="clearfix">
    	 <div class="copyright">
        	Hệ thống dịch vụ <br /><b>Ping - taxi </b>
        </div> 
        <div class="imgstat"><a title="ping-taxi" href="http://pingtaxi.com/maps" target="_blank"><img alt="ping-taxi" title="ping-taxi" height="55" src="images/calltaxi.png"></a><br></div>
		
	</div>
    <div id="div_hide" style="visibility:hidden;display:none;"></div>
</div>
</body>
</html>
<?php
	} else 
		header("Location: login.php");
?>