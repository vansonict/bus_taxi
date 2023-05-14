<?php
//hàm phân trang
function page_div($link, $offset, $numofpages, $page) {
	//$numofpages = ceil($numofpages); 
	$pagesstart = ceil($page-$offset);//offset là số bán kính trang hiển thị quanh trang đang active trong khu vực chọn trang
	$pagesend = ceil($page+$offset);
	if ($page != "1" && ceil($numofpages) != "0"){
		echo str_replace('%d_pg', ceil($page-1), " <a href=".$link." ><b><< Pre</b></a>&nbsp;");	//Thay %d_pg trong link bằng $page-1
	}
	for($i = 1; $i <= $numofpages; $i++){
		if ($pagesstart <= $i && $pagesend >= $i){
			if ($i == $page){
				echo "<b class=active>$i</b>&nbsp;";
			}else{
				echo str_replace('%d_pg', "$i", '<a href="'.$link.'"><b>'.$i.'</b></a>&nbsp; ');
			}
		}
	}
	if (ceil($numofpages) == "0"){
		echo "$i";
	}
	if ($page != ceil($numofpages) && ceil($numofpages) != "0"){
		echo str_replace('%d_pg', ceil($page+1), '<a href="'.$link.'"><b> Next >></b></a>');
	}
}
?>
