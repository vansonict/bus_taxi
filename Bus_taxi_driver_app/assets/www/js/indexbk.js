var hangxe = [];
var loaixe = [];
timeout = "false";
//$('[type="submit"]').button('disable');
/*function checkNetwork() {
	var networkState = navigator.network.connection.type;
	var states = {};
	states[Connection.UNKNOWN] = 'Unknown';
	states[Connection.ETHERNET] = 'Ethernet connection';
	states[Connection.WIFI] = 'WiFi connection';
	states[Connection.CELL_2G] = 'Cell 2G connection';
	states[Connection.CELL_3G] = 'Cell 3G connection';
	states[Connection.CELL_4G] = 'Cell 4G connection';
	states[Connection.NONE] = 'No';
	if(states[networkState]==="No"){
		alert("Kiểm tra kết nối mạng trên điện thoại của bạn trước khi đăng kí lại!");
		$.mobile.ChangPage("register.html");
	}
}*/
	$.ajax({
		'url': 'http://www.tuyetson08.byethost6.com/pingtaxi_api/api_thang.php',
		'dataType': 'jsonp',
		'type': 'GET',
		'data': {'action':'listdong'},
		'success': function(data) {
			//console.log("call back lisdong ok");
			timeout = "true";
			for (var i = 0; i < data.hangtaxi.length; i++) {
				hangxe[i]= data.hangtaxi[i].name;
				//console.log(hangxe[i]);
				$('#hangxe').append("<option value='"  + data.hangtaxi[i].id + "'>"  + data.hangtaxi[i].name  + "</option>");
			}
			for (var i = 0; i < data.loaitaxi.length; i++) {
				loaixe[i] = data.loaitaxi[i].description;
				//console.log(loaixe[i]);
				$('#cartype').append("<option value=\""  + data.loaitaxi[i].id + "\">"  + data.loaitaxi[i].description + "</option>");
			}
		}
	});
	setTimeout(function(){
		if(timeout == "false"){
			alert("Không tìm thấy kết nối internet trên điện thoại của bạn!\n Vui lòng kiểm tra lại!");
			$.mobile.changPage("register.html");
			timeout="true";
		}
	}, 15000);

$('#home-page').live("pageinit", function() {
	//console.log("load register page ok");
	var result = "";
	var error1 ="";
	var error2 ="";
	var error3 ="";

	//$('.button').bind('click', function () {
	$('#btnregister').bind('click',function(event, ui){
		$.mobile.showPageLoadingMsg("d","Loading",false);
			//console.log("Biển kiểm soát: "+$('#BKS').val());
			//console.log("Password: "+$('#password').val());
			var timeout = "false";
			if((error1 !=="") || (error2 !== "") || (error3 !== "") || ($('#BKS').val()==="") ||($('#BKS').val()==="")){
				//console.log("thong tin dang ki chua hop le");
				result ="Thông tin đăng kí chưa hợp lệ!\n Vui lòng điền đúng và đủ thông tin cần thiết! \n"+ error3 + error2 + error1 ;
				document.getElementById("clickdangki").src = "images/buttons/guidangki_down.png";
				alert(result);
				$.mobile.hidePageLoadingMsg();
			}else{
				document.getElementById("clickdangki").src = "images/buttons/guidangki_down.png";
				//console.log("thong tin dang ki hop le");
				$.mobile.showPageLoadingMsg("d","Loading",false);
				$('[type="submit"]').button('enable');
				timeout = "true";	
				$.mobile.changePage('#checkinfo');
			} 
			setTimeout(function(){
				if(timeout == "false"){
					timeout = "true";
					document.getElementById("clickdangki").src = "images/buttons/guidangki_down.png";
					alert("Đăng kí không thành công! Vui lòng kiểm tra lại kết nối internet!");
					//$.mobile.changePage("register.html");
				}
			}, 15000);
		});

	$('#password').live('blur', function(event, ui) {
		var fld = $('#password');
		var illegalChars= /[\W_]/; 
		if((fld.val().length<6)||(fld.val().length >32)||(fld.val()==="")){
			error1="Độ dài mật khẩu từ 6 tới 32 kí tự! Vui lòng nhập lại!\n";
			this.style.background = "white";
		} else if(illegalChars.test(fld.val())){
			this.style.background = "white";
			error1="Mật khẩu không đúng! Vui lòng chỉ nhập số và chữ!\n";
		} else{
			//this.style.background = "white";
			error1 = "";
		}
	});

	$('#pass_confirm').live('blur', function(event, ui) {
		var fld = $('#pass_confirm');
		if(fld.val().length == 0){
			this.style.background='white';
			error2="Bạn chưa xác nhận lại mật khẩu!\n";
		}
		if(fld.val() !== $('#password').val()){
			this.style.background ='white';
			error2="Xác nhận mật khẩu không đúng!\n";
		} else{
			//this.style.background = "white";
			error2="";
		}
	});

	$('#BKS').live('blur', function(event, ui) {
		var fld = $('#BKS');
		if((fld.val().length > 8)||(fld.val().length <7)||(fld.val()==="")){
			this.style.background ='white';
			error3 ="Biển số xe không đúng!\n Chỉ nhập chữ và số. Ví dụ: 29A1234 và 29A12345\n";
		}
		else if((!((fld.val().substring(0,2)).match(/[0-9]/)))
				||(!((fld.val().substring(2,3)).match(/[A-z]/)))
				||(!((fld.val().substring(3)).match(/[0-9]/))) )
		{
			this.style.background ='white';
			error3="Biển số xe không đúng!\nChỉ nhập chữ và số. Ví dụ: 29A1234 và 29A12345\n";
		} else {
			//console.log($('#BKS').val());
			$.ajax({
				'url': 'http://www.tuyetson08.byethost6.com/pingtaxi_api/api_thang.php',
				'dataType':'jsonp',
				'type': 'GET',
				'data':{
					'action':'checkinfo',
					'BKS':$('#BKS').val()
				},
				'success': function(data){
					//console.log(data.status);
					if(data.status === "ok"){
						//console.log("insert db ok");
						error3="";
						//this.style.background = "white";
					}else{
						error3="Biển số xe đã được đăng kí!\n";
						//console.log("insert db no ok");
					}
					//console.log(error3);
				}
			});
		}
	});

	$('#loaixe').live('blur', function(event, ui) {
		if($('#loaixe').val() === ""){
			$('#loaixe').val() = "pingtaxi";
		}
	});
});

$('#checkinfo').live('pageinit', function(){
	//$.mobile.showPageLoadingMsg("d","Loading",false);
	//console.log($('#cartype').val());
	//console.log(loaixe[$('#cartype').val()]);
	//console.log(hangxe[$('#hangxe').val()]);
	//console.log($('#hangxe').val());
	var info = "<h2>Xác nhận lại:</h2>"+"<br/><br/>Vui lòng kiểm tra lại thông tin và hoàn tất đăng kí!"+
	"<br/> Biển số :"+ $('#BKS').val() +
	"<br/> Mật khẩu:"+ $('#password').val() +
	"<br/> Loại xe :" + loaixe[$('#cartype').val()] +
	"<br/> Hãng xe :" +hangxe[$('#hangxe').val()]+
	"<br/><br/> Nhấn xác nhận để hoàn tất đăng kí hoặc đăng kí lại!";
	$('#info').html(info);
	$('#xacnhan').bind('click', function(event, ui){
		document.getElementById("clickxacnhan").src = "images/buttons/xacnhan_down.png";
		$.ajax({
			'url': 'http://www.tuyetson08.byethost6.com/pingtaxi_api/api_thang.php',
			'dataType': 'jsonp',
			'type': 'GET',
			'data': {
				'action':'insertdb',
				'BKS':$('#BKS').val(),
				'password':calcMD5($('#password').val()),
				'cartype':$('#cartype').val(),
				'hangxe':$('#hangxe').val()
			},
			'success': function(data) {
				if(data.status === "ok"){
					$.mobile.changePage("login.html");
				}else{
					alert("Đăng kí thất bại. Vui lòng kiểm tra lại thông tin đăng kí!");
					$.mobile.changePage("register.html");
				}
			}
		});
	});
	$('#quaylai').bind('click',function(event,ui){
		//console.log("lick quay lai, changepage to register.html");
		$.mobile.changePage("register.html");
	});
});
