<?php 
	session_start();
	require_once ('etc/XLThong_tin_DL.php');
	if(isset($_SESSION['type_user']) && $_SESSION['type_user'] != 2){
		if(isset($_GET['parent_id'],$_GET['name'],$_GET['mobile'])){
                        $fullName = $_GET['name'];
                        if($_GET['parent_id'] != '00'){
                            $fullName = $_GET['parent_id'].$_GET['name'];
                        }
                        $re = $c_student -> them($fullName, $_GET['parent_id'], $_GET['pass'], $_GET['mobile'], $_GET['contact']);
                        //var_dump($re);
                        if($re){
                                echo "<script>alert(\"Bạn đã thêm thành công!\")</script>";
				echo "<script type=\"text/javascript\"> 
				function exec_refresh()
				{
					window.status = \"Ðang chuyển tới ...\" + myvar;
					myvar = myvar + \" .\";
					var timerID = setTimeout(\"exec_refresh();\", 7);
					if (timeout > 0)
					{
						timeout -= 1;
					}
					else
					{
						clearTimeout(timerID);
						window.status = \"\";
						window.location = \"" . address . "maps/admin@/daily.php\";
					}
				}
				 
				var myvar = \"\";
				var timeout = 7;
				exec_refresh();
				 </script> ";
			}else
				echo "<script>alert(\"Quá trình thực thi gặp lỗi, vui lòng thực hiện lại!\")</script>";
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
<!--<script type="text/javascript" src="javascripts/scripts.js"></script> -->
<script type="text/javascript" src="javascripts/jquery.js"></script>
<script type="text/javascript" src="javascripts/global.js"></script>
<script src="javascripts/ddsmoothmenu.js" type="text/javascript"></script>
<script src="javascripts/javascript.js" type="text/javascript"></script>
<script src="javascripts/jquery.tooltip.js" type="text/javascript"></script>
<script language="JavaScript"  type=text/javascript >
	function checkinput(){
		if(form.parent_id.value==""){
			alert("Xin vui lòng chọn lại đại lý cha.");
			document.form.parent.focus();
			return false;
		}
		if(form.name.value==""){
			alert("Xin vui lòng nhập tên đại lý!");
			document.form.name.focus();
			return false;
		}
		
                if(form.name.value.length != 2){
                    alert("Tên đại lý xin vui lòng chỉ nhập 2 kí tự!");
                    document.form.name.focus();
                    return false;
                }
                
		if(form.mobile.value==""){
			alert("Xin vui lòng nhập số điện thoại!");
			document.form.mobile.focus();
			return false;
		}
		if(form.contact.value==""){
			alert("Xin vui lòng nhập thông tin liên hệ");
			document.form.contact.focus();
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
        	<a class="bthome" href="#"><span>Đăng ký ping-taxi</span></a> <a class="bthome" href="javascript:void(0);" onClick="logout();"><span class="iconexit">Thoát</span></a>
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
                    <div class="info_tab"><span class="cell_left">Thêm đại lý</span>
                    	<div style="clear:both"></div>
                    </div>
					
                    <div id="middle_column_r">
						
							<div class="form">
								 <form action="" name="form" method="GET" class="niceform" onSubmit="return checkinput()">
										<fieldset>
                                                                                        <input type="hidden" name="id" value="<?php echo $rs['id'];?>" />
											<dl>
												<dt><label>Đại lý cha :</label></dt>
												<dd>
                                                                                                    <select size="1" name="parent_id" id="">
                                                                                                        <option value="00">00</option>
                                                                                                        <?php
                                                                                                        $pr = $c_student -> Doc_danh_sach_dl();
                                                                                                        foreach ($pr as $pr){
                                                                                                            if($pr['name'] <= 9999){
                                                                                                                echo "<option value=". $pr['name'] .">". $pr['name'] ."</option>";
//                                                                                                            }else{
//                                                                                                                $rs = $c_student -> chi_tiet_daily($pr['parent_id'], 0);
//                                                                                                                if($rs){
//                                                                                                                    echo "<option value=". $pr['name'] .">". $pr['name'] ."</option>";
//                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                        ?>
                                                                                                    </select>
                                                                                                </dd>
											</dl>
											<dl>
												<dt><label for="name">Tên đại lý :</label></dt>
                                                                                                <dd><input type="text" name="name" onBlur="if(this.value=='') this.value='2 kí tự'" value="2 kí tự" id="" size="54" /></dd>
											</dl>
                                                                                        <dl>
												<dt><label for="pass">Password :</label></dt>
                                                                                                <dd><input type="password" name="pass" onBlur="if(this.value=='') this.value='password'" value="password" id="" size="54" /></dd>
											</dl>
											<dl>
												<dt><label for="mobile">Số điện thoại :</label></dt>
												<dd><input type="text" name="mobile" id="" onBlur="if(this.value=='') this.value='0'" value="0" size="54" /></dd>
											</dl>
											<dl>
												<dt><label for="contact">Liên hệ :</label></dt>
												<dd><input type="text" name="contact" id="" onBlur="if(this.value=='') this.value='Chưa có thông tin liên hệ'" value="Chưa có thông tin liên hệ" size="54" /></dd>
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
        	Hệ thống khai báo thông tin dịch vụ <br /><b>Ping Taxi </b>
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