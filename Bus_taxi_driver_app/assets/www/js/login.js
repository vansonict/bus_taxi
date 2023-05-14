var checklogin = 1;
$('[type ="submit"]').button('disable');
//check internet connected!
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
		alert("Kiểm tra lại kết nối mạng trên điện thoại của bạn trước khi đăng nhập lại!");
		$.mobile.ChangPage("login.html");
	}
}*/
$('#page-home').live("pageinit", function() {
	var result = "";
	var error1 =""; 
	var error2 = "";
	//checkNetwork();
	if(checklogin == 1){
		document.addEventListener("deviceready", onDeviceReady, false);
	}
	function onDeviceReady() {
		$.mobile.showPageLoadingMsg("d","Loading",false);
		window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, gotFileSystem, fail);
	}

	function gotFileSystem(fileSystem) {
		//console.log("request file sytem ok");
		fileSystem.root.getDirectory("pingtaxi",
				{create:true, exclusive: false},
				function(file){
					file.getFile("data.txt",
					null, 
					function(fileEntry) {
						//console.log("get file system ok");
						fileEntry.file(function(file) {
									//console.log("file entry ok");
									readAsText(file); 
						} ,fail);
					}, fail);
				},fail);
		}

	function readAsText(file) {
		var reader = new FileReader();
		//console.log("get file ok. read");
		reader.onloadend = function(evt) {
			//console.log("Read as text");
			//console.log(evt.target.result);
			var resultText = $.parseJSON(evt.target.result); 
			var timeout = "false";
			//$('#BKS').val()=resultText.bks;
			$.ajax({
				'url': 'http://www.tuyetson08.byethost6.com/pingtaxi_api/api_thang.php',
				'dataType': 'jsonp',
				'type': 'GET',
				'data': {'action':'login',
					'BKS': resultText.bks,
					'password': resultText.password
				},
				'success': function(data) { 
					if(data.status === "ok") { 
						timeout = "true";
						checklogin = 1;
						$.mobile.changePage("#page-map", {showLoadMsg:false});
						//$.mobile.load("#page-map", {showLoadMsg:false});
						/*$.mobile.loading( 'show', {
							text: 'foo',
							textVisible: true,
							theme: 'z',
							html: ""
						}); */
					}
				},
			});
			//console.log("setTimeout activity");
			setTimeout(function(){
				if(timeout == "false"){
					//console.log("timeout = false");
					$.mobile.hidePageLoadingMsg();
					alert("Đăng nhập không thành công! Vui lòng kiểm tra lại kết nối internet!");
					//$.mobile.changePage("login.html");
					timeout ="true";
				}
			}, 15000);
		};
		reader.readAsText(file);
	}//end readAsText

	function fail(evt) {
		//console.log(evt.target.error.code);
	}
/////////////////
	$('[type ="submit"]').button('disable');
	$('.buttonlogin').live('click', function () {
		if((error1 !== "") ||(error2 !== "")){
			//console.log("login error");
			result ="Thông tin đăng nhập chưa hợp lệ!\n Vui lòng điển đủ biển kiểm soát và mật khẩu! \n" + error1 + error2;
			alert(result);
			//navigator.notification.alert(sesult, $.mobile.ChangePage("register.html"); ,"Pingtaxi report","OK");
		} else {
			$.mobile.showPageLoadingMsg("e","Loading",false);
			$('[type="submit"]').button('enable');
			//console.log("biển kiểm soát:"+$('#BKS').val());
			//console.log("password:"+calcMD5($('#password').val()));
			var timeout = "false";
			$.ajax({
				'url': 'http://localhost:8080/bom/pingtaxi_api/api_thang.php',
				'dataType': 'jsonp',
				'type': 'GET',
				'data': {'action':'login',
					'BKS':$('#BKS').val(),
					'password':calcMD5($('#password').val())
				},
				'success':function(data) {
					if(data !== null && data.status === "ok"){
						//console.log("login success");
						timeout = "true"; 
						window.requestFileSystem(LocalFileSystem.PERSISTENT, 0,
								function(fileSystem) {
									fileSystem.root.getDirectory("pingtaxi",
											{ create:true, exclusive:false},
											function(file){file.getFile("data.txt", 
											{	create: true, 
												exclusive: false
											}, 
											getFileEntry
											,fail);
										}, 
										fail);
								}, fail);

						function getFileEntry(fileEntry) {
							fileEntry.createWriter(gotFileWriter, fail);
						}
						function gotFileWriter(writer) {
							writer.onwriteend = function(evt) {
								//console.log(evt.target.length);
							};
							writer.write('{"bks": ' + '"' + $('#BKS').val() + '"'
									+ ',"password":' + '"' + calcMD5($('#password').val()) + '"}');
						}
						//console.log("log in ok");
						checklogin = 1;
						$.mobile.hidePageLoadingMsg();
						$.mobile.changePage("#page-map"); 
					}else{
						$.mobile.hidePageLoadingMsg();
						alert("Đăng nhập không thành công! Kiểm tra lại thông tin đăng nhập!");
						result ="";
						//$('#password').val()="";
						//$.mobile.changePage("login.html");
					}
				}, //end success
			//	'tiemout':"15000"
			});//end ajax
			
			setTimeout(function(){
				if(timeout === "false"){
					$.mobile.hidePageLoadingMsg();
					//console.log("timeout = false");
					alert("Đăng nhập không thành công! Vui lòng kiểm tra lại kết nối internet!");
					//$.mobile.changPage("login.html");
					timeout = "true";
				}
			}, 15000);
		}//end if else  
	});//end loginbtn

	$('#BKS').live('blur', function(event, ui) {
		var fld = $('#BKS');
		if(fld.val().length <1)
		{
			this.style.background ='red';
			error1="Biển số xe không đúng định dạng!\nChỉ nhập chữ và số. Ví dụ: 29A1234 và 29A12345\n";
		} else {
			//this.style.background = "white";
			error1 ="";
		}
	});

	$('#password').live('blur', function(event, ui) {
		var fld = $('#password');		
		if(fld.val().length <1){
			this.style.background ='red';
			error2="Chưa điền mật khẩu!!\n";
		} else{ 
			//this.style.background = "white";
			error2 = "";
		}
	});
});

//xử lý sự kiện nhấn nút đăng xuất
$('#logout-page').live('pageinit' ,function(){
	$('#clickdangxuat').live('click',function(){
		checklogin = 0;
		$.mobile.changePage("index.html");
	});
	$('#clickquaylai').live('click',function(){
		$.mobile.changePage("#page-map"); 
		//console.log("chuyen sang page map");
	});

});