<?php 
	session_start();
	include_once ($_SERVER['DOCUMENT_ROOT'].'/tttn/etc/XLThong_tin_SV.php');
	include_once ($_SERVER['DOCUMENT_ROOT'].'/tttn/etc/xlmonhoc.php');
	if(isset($_SESSION['user'])){
		$ft = "<script type=\"text/javascript\"> <!--
						function exec_refresh()
						{
							window.status = \"Ðang chuyển tới ...\" + myvar;
							myvar = myvar + \" .\";
							var timerID = setTimeout(\"exec_refresh();\", 0);
							if (timeout > 0)
							{
								timeout -= 1;
							}
							else
							{
								clearTimeout(timerID);
								window.status = \"\";
								window.location = \"/tttn/index.php\";
							}
						}
						 
						var myvar = \"\";
						var timeout = 0;
						exec_refresh();
						//--> </script> ";
		if(isset($_POST['Search']) && $_POST['Search'] !='' && $_POST['Search'] != 'Search'){
			$vl_s = $_POST['Search'];
			switch ($_POST['type']){
				default:
					echo "<script>alert(\"Quá trình thực thi bị lỗi!\")</script>";
					echo $ft;
				case 1:
					$rs = $c_student->tim_kiem1($vl_s);
					break;
				case 2:
					$rs = $c_student->chi_tiet_sv1($vl_s);
					break;
				case 3:
					$rs = $c_mh-> mon_cu_the($vl_s);
					break;
				case 4:
					$rs = $c_student->tim_kiem3($vl_s);
					break;
			}
			if(!$rs){
				echo "<script>alert(\"Không tìm thấy!\")</script>";
				echo $ft;
			} else {
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>Bảng điểm sinh viên</title>
<meta content="vi" http-equiv="content-language">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link type="image/x-icon" href="/tttn/images/logoico.png" rel="SHORTCUT ICON">
<meta content="Viện CNTT & TT - Đại học Bách Khoa Hà Nội" name="copyright">
<meta content="Viện CNTT & TT - Đại học Bách Khoa Hà Nội" name="generator">
<link type="text/css" href="css/css.css" rel="Stylesheet">
<script type="text/javascript" src="/tttn/javascripts/scripts.js"></script>
<script type="text/javascript" src="/tttn/javascripts/jquery.js"></script>
<script type="text/javascript" src="/tttn/javascripts/global.js"></script>
<script src="/tttn/javascripts/ddsmoothmenu.js" type="text/javascript"></script>
<script src="/tttn/javascripts/javascript.js" type="text/javascript"></script>
<script src="/tttn/javascripts/jquery.tooltip.js" type="text/javascript"></script>
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
                    <td class="logo2">S</td>
                    <td class="logo2">O</td>
                    <td class="logo2">I</td>
					<td class="logo2">C</td>

                    <td class="logo2">T</td>
                </tr>
            </table>
            </div>
            <div id="bannerTitle"><span></span></div>
        </div>
        <div class="logout">
        	<a class="bthome" href="#"><span>Đăng ký môn học</span></a> <a class="bthome" href="javascript:void(0);" onClick="logout();"><span class="iconexit">Thoát</span></a>
        </div>
	</div>
    
    <div style="">
    	<?php 
			require($_SERVER['DOCUMENT_ROOT'].'/tttn/includes/menu_top.php');
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
							   		include($_SERVER['DOCUMENT_ROOT'].'/tttn/includes/menu_sub.php'); 
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
                    <div class="info_tab"><span class="cell_left">Thông tin</span>
                    	<div style="clear:both"></div>
                    </div>
                    <div id="middle_column_r">
						<table class="tab1">
                        	<caption>Bảng tổng kết học tập</caption>
                            <!--<colgroup><col valign="top" width="5%">
                                <col valign="top">
                                <col valign="top" width="10%">
                            </colgroup>-->
                             <thead>
                            	<tr>
                                	<td width="25">STT</td>
                                    <td>SHSV</td>
									<td>Họ và tên</td>
									<td>Ngày sinh</td>
									<td>Giới tính</td>
									<td>Lớp</td>
									<td>Khóa</td>
									<td style="text-align: left;">Nguyên quán</td>
                                    <?php 
										if($_SESSION['type_user'] == 1){
									?>
                                    <td style="text-align: left;">Quản trị</td>
									<?php 
										}
									?>
								</tr>
                            </thead>
                            <?php
								$stt = 0;
                            	foreach($rs as $rs){
									$shsv = $rs['SHSV'];
									$d_birthday = date("d-m-Y", strtotime($rs['NgaySinh']));
									$hodem = $rs['HoDem'];
									$ten = $rs['Ten'];
									echo"<tbody>
											<tr>
												<td>".$stt."</td>
												<td>".$shsv."</td>
												<td>".$hodem." ".$ten."</td>
												<td>".$d_birthday."</td>
												<td>".$rs['GioiTinh']."</td>
												<td>".$rs['Lop']."</td>
												<td>".$rs['Khoa']."</td>
												<td style=\"text-align: left;\">".$rs['NguyenQuan']."</td>";
										if($_SESSION['type_user'] ==1){
										echo"<td class=\"options-width\">
												<a title=\"Edit\" class=\"icon-1 info-tooltip\" href=\"/tttn/admincp/suasv.php?shsv=".$shsv."\"></a>
												<a title=\"Del\" class=\"icon-2 info-tooltip\" href=\"/tttn/admincp/xoasv.php?shsv=".$shsv."\"></a>
												
											</td>";
										}
										echo"</tr>
										</tbody>";
									$stt++;
								}
							?>
						</table>
                        <div style="clear:both"></div>
					</div>
                    <!-- -->
				</td>
			</tr>
		</table>
	</div>
    <div id="footer" class="clearfix">
    	<div class="copyright">
        	Hệ thống khai báo thông tin sinh viên <br /><b>Viện Công Nghệ Thông Tin & Truyền Thông </b>
        </div>
        <div class="imgstat"><a title="HUT" href="http://hut.edu.vn/" target="_blank"><img alt="HUT" title="HUT" height="35" src="/tttn/images/SoICT_ logo.png"></a><br></div>
	</div>
    <div id="div_hide" style="visibility:hidden;display:none;"></div>
</div>
</body>
</html>
<?php
			}
		}else {
			echo "<script>alert(\"Hãy nhập thông tin tìm kiếm!\")</script>";
			echo $ft;
		}
	} else 
		header("Location: /tttn/login.php");
?>