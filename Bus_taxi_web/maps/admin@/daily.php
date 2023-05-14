<?php 
	session_start();
	include_once ('etc/XLThong_tin_DL.php');

	require_once ('etc/paper.php');

	if(isset($_SESSION['user'])){

		$pp = "10"; //Số record trên một trang

		$r2 = $c_student->so_luong();

		$numofpages = $r2/ $pp; //Tính số trang dựa trên tổng số dòng và số dòng trong 1 trang

		if (!isset($_GET['page'])) {$page = 1;} //Xét sự tồn tại giá trị của page trên thanh address, nếu không gán trang hiện tại là 1

		else {$page = $_GET['page'];}

		$limitvalue = $page * $pp - ($pp);

		$pr = $c_student->hien_thi_dl($limitvalue,$pp);	

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

                    <div class="info_tab"><span class="cell_left">Thông tin</span>

                    	<div style="clear:both"></div>

                    </div>

                    <div id="middle_column_r">

                        <table class="tab1">

                        	<caption>Danh sách đại lý</caption>

                            <!--<colgroup><col valign="top" width="5%">

                                <col valign="top">

                                <col valign="top" width="10%">

                            </colgroup>-->

                            <thead>

                            	<tr>

                                	<td width="25">STT</td>

                                        <td>Đại lý cha</td>

                                        <td>Tên(mã đại lý)</td>

                                        <td>Số điện thoại</td>

                                        <td>Thông tin chi tiết</td>

                                        <?php 

                                            if($_SESSION['type_user'] != 2){

                                        ?>

                                                <td style="text-align: left;">Quản trị</td>

                                            <?php 

                                            }

                                            ?>

                                </tr>

                            </thead>

                            <?php

                                $stt = 1;

                            	foreach($pr as $pr){

                                            echo"<tbody>

                                                        <tr>

                                                            <td>".$stt."</td>

                                                            <td>".$pr['parent_id']."</td>

                                                            <td>".$pr['name']."</td>

                                                            <td>".$pr['mobile']."</td>

                                                            <td>".$pr['contact']."</td>";

                                                            if($_SESSION['type_user'] != 2){

                                                            echo"<td class=\"options-width\">";
                                                                if(isset($_REQUEST['ok']) && $_REQUEST['ok'] == $pr['name']) {
                                                                    echo '<span>bạn có muốn xóa đại lý này?</span>
                                                                                <form action="http://pingtaxi.com.vn/maps/admin@/xoadl.php?name=' . $pr['name'] . '" method="get">
                                                                                    <input type="hidden" value="' . $pr['name'] .'" name="name" />
                                                                                    <input type="submit" value="Đồng ý" />
                                                                                </form>
                                                                                <form action="daily.php" method="get">
                                                                                    <input type="submit" value="Hủy bỏ" />
                                                                                </form>';
                                                                }else{
                                                                    echo "<a title=\"Edit\" class=\"icon-1 info-tooltip\" href=\"suadl.php?name=".$pr['name']."\"></a>

                                                                          <a title=\"Del\" class=\"icon-2 info-tooltip del_".$pr['name']."\" href=\"daily.php?ok=".$pr['name']."\"></a>";
                                                            }      
                                                                echo "</td>";

                                                            }
                                                            ?> 
                                                           <!-- <script type="text/javascript">
                                                                $('.del_<?php echo $pr['name'];?>').live('click',function(){
                                                                    var rsc = confirm("Ban muốn xóa đại lý <?php echo $pr['name'];?>?");
                                                                    if(rsc == true){
                                                                        window.location = "http://pingtaxi.com.vn/maps/admin@/xoadl.php?name=<?php echo $pr['name']; ?>";
                                                                    }
                                                                });
                                                            </script>-->
                                                            <?php

                                                        echo"</tr>

                                                </tbody>";

                                            $stt++;

                                }

                            ?>

                                

                        </table>	

                        <div class="pagination"> <?

                        // in phân trang

                        //echo 'Pages: '.ceil($numofpages).'<br>';

                        page_div("?page=%d_pg", "3", ceil($numofpages), $page);

                        ?> 

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

	} else 

		header("Location: login.php");

?>