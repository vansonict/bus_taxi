<?php 
	require_once ('etc/xlnguoidung.php');
	if(isset($_SESSION['type_user']) && $_SESSION['type_user'] != 2){
		if(isset($_POST['username'],$_POST['pass'])){
			if($_SESSION['type_user'] == 1){
                            echo "<script>alert(\"Quyền hạn của bạn không đủ!\")</script>";
			}else{
				$rs = $c_user -> kt_user($_POST['username']);
				if(!$rs){
					$c_user -> them($_POST['type'], $_POST['username'], $_POST['pass']);
					echo "<script>alert(\"Bạn đã thêm user thành công!\")</script>";
				}else
					echo "<script>alert(\"Thông tin người dùng đã tồn tại trong hệ thống!\")</script>";
			}
		}
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>Ping-Taxi ++ Đại lý</title>
<meta content="vi" http-equiv="content-language">
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<link type="image/x-icon" href="images/logoico.png" rel="SHORTCUT ICON">
<meta content="" name="copyright">
<meta content="" name="generator">
<link type="text/css" href="css/css.css" rel="Stylesheet">
<script type="text/javascript" src="javascripts/scripts.js"></script>
<script type="text/javascript" src="javascripts/jquery.js"></script>
<script type="text/javascript" src="javascripts/global.js"></script>
<script src="javascripts/ddsmoothmenu.js" type="text/javascript"></script>
<script src="javascripts/javascript.js" type="text/javascript"></script>
<script src="javascripts/jquery.tooltip.js" type="text/javascript"></script>
<script src="/tttn/javascripts/niceforms.js" type="text/javascript"></script>
<script language="JavaScript"  type=text/javascript >
	function checkinput(){
		if(form1.username.value==""){
			alert("Xin vui lòng nhập tên");
			document.form1.shsv.focus();
			return false;
		}
		if(form1.pass.value==""){
			alert("Xin vui lòng nhập pass");
			document.form1.pass.focus();
			return false;
		}
	
		if(form1.type.value==""){
			alert("Xin vui lòng chọn loại người dùng");
			document.form1.type.focus();
			return false;
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
        	<a class="bthome" href="#"><span>Thêm người dùng mới</span></a> <a class="bthome" href="javascript:void(0);" onClick="logout();"><span class="iconexit">Thoát</span></a>
        </div>
	</div>
    
    <div style="">
    	<?php 
			require('includes/menu_top.php');
		?>
	</div>
    
    <div id="top_message">
    	<?php if($_SESSION['type_user'] != 2){ ?>
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
                </td>
                <td bgcolor="#F2F2F2" valign="top">
                	<!-- <iframe id="ifrRight" name="ifrRight" frameborder="0" scrolling="auto" src="../Help/default.asp" style="border:solid 0px #cecece;"></iframe> -->
                	<!--Nội dung chính -->
                    <div class="info_tab"><span class="cell_left">Thêm người dùng</span>
                    	<div style="clear:both"></div>
                    </div>
					
                    <div id="middle_column_r">
						
							<div class="form">
								 <form action="" name="form1" method="post" class="niceform" onSubmit="return checkinput()">
										<fieldset>
											<dl>
												<dt><label for="username">Tên đăng nhập:</label></dt>
												<dd><input type="text" name="username" id="" size="54" /></dd>
											</dl>
											<dl>
												<dt><label for="pass">Mật khẩu:</label></dt>
												<dd><input type="password" name="pass" id="" size="54" /></dd>
											</dl>
											<dl>
												<dt><label for="type">Loại người dùng:</label></dt>
												<dd>
													<select size="1" name="type" id="">
														<option value="0">Admin</option>
														<option value="1">Mod</option>
														<option value="2">Member</option>
													</select>
												</dd>
											</dl>
											 <dl class="submit">
											<input type="submit" name="submit" id="submit" value="Submit" />
											 </dl>
										</fieldset>
								 </form>
							</div>  
							  
                       
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
	}
?>