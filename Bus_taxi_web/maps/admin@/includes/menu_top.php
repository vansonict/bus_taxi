<?php
	//session_start();  -> Phải đặt câu lệnh này lên đầu trang dc include tới
	if(isset($_SESSION['type_user']) && $_SESSION['type_user'] != 2){
?>
	<div class="ddsmoothmenu" id="slidemenu">
		<ul>
			<li><a style="padding-right: 23px" href="daily.php"><span>Quản lý đại lý</span><img src="images/menu_down.png" class="downarrowclass" style="border: 0pt"></a>
				<ul style="top: 30px; box-shadow: 5px 5px 5px rgb(170, 170, 170); visibility: visible">
					<li><a href="daily.php">Danh sách</a></li>
					<li><a href="them_dl.php">Thêm mới</a></li>
				</ul>
			</li>
			<li><a style="padding-right: 23px" href="#"><span>Quản lý địa phương</span><img src="images/menu_down.png" class="downarrowclass" style="border: 0pt"></a>
				<ul style="top: 30px; box-shadow: 5px 5px 5px rgb(170, 170, 170); visibility: visible">
					<li><a href="#">Danh sách</a></li>
					<li><a href="#">Thêm mới</a></li>
				</ul>
			</li>
			<li><a style="padding-right: 23px" href="#"><span>Quản lý hãng taxi</span></a>
				<ul style="top: 30px; box-shadow: 5px 5px 5px rgb(170, 170, 170); visibility: visible">
					<li><a href="#">Danh sách</a></li>
					<li><a href="#">Thêm mới</a></li>
				</ul>
			</li>
			<li><a style="padding-right: 23px" href="#"><span>Quản lý thành viên</span><img src="images/menu_down.png" class="downarrowclass" style="border: 0pt"></a>
				<ul style="top: 30px; box-shadow: 5px 5px 5px rgb(170, 170, 170); visibility: visible">
					<li><a href="#">Danh sách</a></li>
					<li><a href="nguoidungmoi.php">Thêm mới</a></li>
				</ul>
			</li>
		</ul>
		
	<div class="clear"></div>
	</div>
	<!--  start top-search -->
	<form id="formsearch" class="search_box" method="POST" action="timkiem.php" >
		<div id="top-search">
			<table border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td><input type="text" value="Search" name="Search" onclick="if(this.value=='Search') this.value='' " onblur="if(this.value=='') this.value='Search'" onfocus="if (this.value=='Search') { this.value=''; }" class="top-search-inp" /></td>
			<td>
			<select  name="type" class="styledselect">
				<option value="1" selected="selected"> Đại lý</option>
				<option value="2"> Hãng taxi</option>
			</select> 
			</td>
			<td>
			<input type="image" src="images/shared/top_search_btn.gif"  />
			</td>
			</tr>
			</table>
		</div>
	</form>
 	<!--  end top-search -->
<?php
	}
?>
