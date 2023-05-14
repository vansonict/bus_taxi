//<![CDATA[
	ddsmoothmenu.init({
	arrowimages: {down: ['downarrowclass', 'images/menu_down.png', 23], right: ['rightarrowclass', 'images/menu_right.png', 23]},
	mainmenuid: "slidemenu", //Menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
	})
	//]]>

	// click hide menu
	function clickHide(type){
		if (type == 1)
		{
			$('td.colum_left_lage').hide({ direction: "horizontal" }, 500);
			$('td.colum_left_small').show({ direction: "horizontal" }, 500);
			nv_setCookie( 'colum_left_lage', '0', 86400000);
		}else{
			if (type == 2)
			{
				$('td.colum_left_small').hide(0);
				$('td.colum_left_lage').show({ direction: "horizontal" }, 500);
				nv_setCookie( 'colum_left_lage', '1', 86400000);
			}
		}
	}
	// show or hide menu
	function show_menu(){
		var showmenu = ( nv_getCookie( 'colum_left_lage' ) ) ? ( nv_getCookie('colum_left_lage')) : '1';
		if (showmenu == '1'){
			$('td.colum_left_small').hide();
			$('td.colum_left_lage').show();
		}else{
			$('td.colum_left_small').show();
			$('td.colum_left_lage').hide();
		}
	}
	
	function logout()
	{
		document.location.replace("logout.php");
	}
	
	function winOnload()
	{
		SMS.reSizeBox2('ifrRight');
	}
	function changClass(c)
	{
		if(document.getElementById("ver_menu"))
		{
			var div = document.getElementById("ver_menu");
			var a = div.getElementsByTagName("a");
			for (i = 0; i < a.length; i ++)
			{
				a[i].className = "";
			}
			c.className = "current";
		}
		
	}