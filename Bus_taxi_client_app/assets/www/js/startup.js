var errorsdt ="";
var errordailyid = "";
var sdtUser = 0;
var count = 0;
var sonnaLat = 0.0;
var sonnaLng = 0.0;
//sonna
// event exit app when click Thoat button
document.addEventListener("backbutton", onBackKeyDown, true);
function onBackKeyDown() {
	console.log("back button click");
}
$('#exitBtn').live("click", function(event, ui) {
	navigator.app.exitApp();
});
//function thuc hien link sang 1 web voi duong dan nhap vao
function windowOpen(path){
	window.open(path);
	console.log("window open with path:"+ path);
}
//function tao hieu ung khi nhan nut
function clickbutton(id,path){
	console.log("duonng dan"+path+"\n id:"+id);
	document.getElementById(id).src =path;
}
//bat su kien cho trang startup
$('#page-splash').live("pageinit", function() {
	var options = { timeout: 5000, enableHighAccuracy: true, maximumAge: 5000 };
    navigator.geolocation.getCurrentPosition (onSuccess, onError, options);
	console.log("load startup.js");

//doc file xem da co thong tin startup chua.
	document.addEventListener("deviceready", onDeviceReady, false);
	function onDeviceReady() {
		window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, gotFileSystem, fail);
	}

	function gotFileSystem(fileSystem) {
		console.log("request file sytem startup.txt ok");
		fileSystem.root.getDirectory("ptittaxi",
				{create:true, exclusive: false},
				function(file){
					file.getFile("startup.txt",
							null, 
							function(fileEntry) {
						console.log("get file entry startup.txt ok");
						fileEntry.file(function(file) {
							console.log("read file entry startup.txt ok");
							readAsText(file); 
						} ,fail);
					}, fail);
				},fail);
	}

	function readAsText(file) {
		var reader = new FileReader();
		console.log("get file startup ok. read");
		reader.onloadend = function(evt) {
			console.log("Read as text file startup.txt");
			if(evt.target.result !== ""){
				console.log("da dien thong tin startup=>chuyen qua #page-home");
				$.mobile.changePage('#page-home',{transition: 'none'}); 
			} else {
				console.log("chua dien thong tin startup => chuyen quan #page-startup");
				$.mobile.changePage('#page-startup',{transition: 'none'}); 
			}
		}; 
		reader.readAsText(file);
	}//end readAsText

	function fail(evt) {
		console.log(evt.target.error.code);
	}
//neu chua co thong tin start up thi yeu cau dien vao
	$('#sodienthoai').live('blur', function( event, ui){
		if($('#sodienthoai').val() !== ""){
			if(($('#sodienthoai').lenght >11) || ($('#sodienthoai').lenght <9) || (!($('#sodienthoai').val().match(/[0-9]/)))){
				console.log("sodien thoai k dung dinh dang");
				errorsdt = "Sá»‘ Ä‘iá»‡n thoáº¡i quÃ½ khÃ¡ch Ä‘iá»�n khÃ´ng Ä‘Ãºng Ä‘á»‹nh dáº¡ng!";
			}
		}else{
			console.log("Bá»� trá»‘ng sá»‘ Ä‘iá»‡n thoáº¡i");
		}
	}); 
 
	$('#madaily').live('blur',function(event, ui){
		if($('#madaily').val() !== ""){
			//kiem tra thong tin dai ly tren server
			$.ajax({
				'url': 'http://pingtaxi.com.vn/pingtaxi_api_dev/api_thang.php',
				'dataType': 'jsonp',
				'type': 'GET',
				'data': {'action':'daily',
					'madaily':$('#madaily').val(),
					'sodienthoai':$('#sodienthoai').val()
				}, 
				'success': function(data){
					if(data.status === "ok"){
						console.log("mÃ£ Ä‘áº¡i lÃ½ Ä‘Ã£ tá»“n táº¡i trong  tbl_daily ok");
						console.log("mÃ£ Ä‘áº¡i lÃ½ Ä‘Ã£ tá»“n táº¡i trong tbl_daily ok");
						check = true;
					}else{ 
						console.log("ma dai ly khong ton tai");
						check = false;
						errordailyid = "Mã đại lý không đúng! Vui lòng điền lại!";
						errordailyid = "MÃ£ Ä‘áº¡i lÃ½ khÃ´ng Ä‘Ãºng! Vui lÃ²ng kiá»ƒm tra láº¡i!";
					}
				}
			});
		}
	});
//bat su kien nhan nut xac nhan
	$('#startup').live("click", function(event, ui) {
		sdtUser = $('#sodienthoai').val();
		$.mobile.showPageLoadingMsg("d","Loading",false);
		if((errordailyid === "") && (errorsdt === "") || (count >3)){
				//luu xac nhan da dien thong tin so dien thoai
				window.requestFileSystem(LocalFileSystem.PERSISTENT, 0,
						function(fileSystem) {
					fileSystem.root.getDirectory("ptittaxi",
							{ create:true, exclusive:false},
							function(file){file.getFile("startup.txt", 
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
						console.log("do dai file startup: " + evt.target.length);
					};
					if($('#madaily').val() === ""){
					writer.write('{"startup": "error"}');
					console.log("ná»™i dung ghi file: error");
					}else{
						writer.write('{"startup":"'+ $('#madaily').val() + '"}');
						console.log("ná»™i dung ghi file : "+ $('#madaily').val());
					}
				}
			$.mobile.hidePageLoadingMsg();
			$.mobile.changePage("#page-home",{transition: 'none'});

		}else{
			count ++;
			console.log(count);
			$.mobile.hidePageLoadingMsg();
			alert("ThÃ´ng tin Ä‘iá»�n vÃ o khÃ´ng há»£p lá»‡! \n" + errordailyid + errorsdt);
		}
	}); 
});
function onSuccess(position) {
	sonnaLat = position.coords.latitude*1000000;
    sonnaLng = position.coords.longitude*1000000;
    sonnaStt = 0;
    console.log("latS:" + sonnaLat+"longS:"+sonnaLng);
}
function onError(error) {       
	$('#location-service-status').val('0');
	var msg = "Không thể xác định được vị trí,Kiểm tra lại cấu hình cài đặt";
    navigator.notification.confirm(msg, function(index) {
		if (index == 2) {
			cordova.exec(success , error, "GoSetting", "nativeAction", ['locationSetting']);
			function success() {
				fadingMsg("Di chuyển tới mục thiết lập vị trí");
				console.log("go to location setting");
			}
    		function error() {
    			console.log("error, exit app");
    			navigator.app.exitApp();
    		}
		}
	}, "Cáº£nh bÃ¡o", "Tá»« chá»‘i,Ä�á»“ng Ã½");
}