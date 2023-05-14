<?php 
	session_start();
//	include_once ('/etc/XLThong_tin_DL.php');
//	require_once ('/etc/paper.php');
	if(isset($_SESSION['user'])){
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
</head>
<body onload="javascript:winOnload();" onresize="javascript:winOnload();">
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
        	<a class="bthome" href="#"><span>Đăng ký ping-taxi</span></a> <a class="bthome" href="javascript:void(0);" onclick="logout();"><span class="iconexit">Thoát</span></a>
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
                <td style="display: none;" class="colum_left_small" valign="top"><span class="lage" onclick="clickHide(2)">&nbsp;</span></td>
                <td class="colum_left_lage" valign="top">
                	<div style="padding-right:20px; padding-left:4px; width:200px">
                    	<div class="divclose"><span class="small" onclick="clickHide(1);">&nbsp;</span></div>
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
                    <div class="info_tab"><span class="cell_left">Thông tin</span>
                    	<div style="clear:both"></div>
                    </div>
                    <div id="middle_column_r">
						<table class="tab1">
						Giới thiệu
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
        	Hệ thống dịch vụ <br /><b>Ping - taxi </b>
        </div>
        <div class="imgstat"><a title="HUT" href="http://ping-taxi.com/" target="_blank"><img alt="HUT" height="35" src="images/SoICT_ logo.png"></a><br></div>
	</div>
    <div id="div_hide" style="visibility:hidden;display:none;"></div>
</div>
</body>
</html>
<?php
	} else 
		header("Location: login.php");
?>