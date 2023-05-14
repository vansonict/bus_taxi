var loaiClick; // the type of taxi is click
var hangClick; // the brand of taxi is click
var newPhoneNumber; // The Phone Number is putted by user
var oldPhoneNumber; // The Phone Number in db
var currentPhoneNumber; // the Phone Number now, equal newPhoneNumber if bool equal 1  
var dfHangTaxi = -1;	//Hang taxi mac dinh
var dfHangTaxiName = 'Chưa cập nhật';
var IMSI; // IMSI Sim
//var pingTaxiUrl="http://www.tuyetson08.byethost6.com/pingtaxi_api/api_sonna.php";
var pingTaxiUrl= url + 'api_vansonict_client.php';
var bool = 0; // state of Phone Number
var lat = 0.0;
var smsTraLoiOK="Cuộc gọi của quý khách đã được gửi tới hệ thống, hãng sẽ liên lạc trực tiếp với bạn trong giây lát";
var longx = 0.0;
var isNetwork = 1; // state of network
var listHangFix ="";
var changePN = 0; // state of phone number
var dateLocal;
var sdtTG; // so dien thoai trung gian
// Wait for Cordova to load
// 
//document.addEventListener("deviceready", onDeviceReady, false);
//
//// Cordova is loaded and it is now safe to make calls Cordova methods
////
//function onDeviceReady() {
//	checkConnection();
//	//checkISMI('imsi');
//	$("#pn").append("aa");
//}

$('#page-home').live("pageinit", function(){
	document.addEventListener("backbutton", onBackKeyDown, true);
	function onBackKeyDown() {
		console.log("back button click");
	}
	console.log(load);
	if(load === 1){
		$.mobile.changePage('#loader',{transition: 'none'});
	}
	checkISMI();
	// check connection
	checkConnection();
	// read file system in directory;
	
});

function writeFile(data){
	console.log("dataaaaa: " + data);
	window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, 
			function gotFS(fileSystem) {
				console.log("file System");
				//get direction of file system
				fileSystem.root.getDirectory("ptittaxi",
						{create: true, exclusive: false}, 
						function(file){
							// get file in directory
							console.log("get file ok :"+file );
							file.getFile("ptittaxi.txt",
									{create: true, exclusive: false},
									//get data
									getFileEntry,
									fail);
						}, 
						fail);
			}, fail);
	function getFileEntry(fileEntry) {
		console.log("Parent Name: " + parent.name);
	    //fileEntry.file(gotFile, fail);
	    fileEntry.createWriter(gotFileWriter, fail);
	}
	// write data in file
	function gotFileWriter(writer) {
	    
	    writer.onwriteend = function(evt) {
			console.log(evt.target.length);
		};
		
	    writer.write(data);
	}
}
	
	
function readFile(){
	window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, 
		function gotFS(fileSystem) {
			console.log("file System");
			fileSystem.root.getDirectory("ptittaxi",  
			{create: true, exclusive: false}, 
			function(file){
				console.log("get file ok");
				file.getFile("ptittaxi.txt",{create: true, exclusive: false},
				function(fileEntry){
				console.log("get file entry ok");
				fileEntry.file(function(file){
					readAsText(file);
					}, 
					fail);
				},
				fail);
			}, 
			fail);
		}, 
	fail);
}
	
// read file
function readAsText(file) {
    var reader = new FileReader();
    reader.onloadend = function(evt) {
	    console.log("Read as text");
		console.log("Pn1: " +IMSI);
		console.log(evt.target.result);
		var str = evt.target.result.split("/;");
		var ss = str[0].split(";");
		newPhoneNumber = ss[2];
		//$('#sdtSetting').append("Số điện thoại hiện tại: "+ newPhoneNumber);
		dfHangTaxi = ss[3];
		dfHangTaxiName = ss[4];
		var newIMSI=ss[1];
		dateLocal = ss[0];
		listHangFix = str[1];
		
		console.log("Pn: "+ newPhoneNumber+"  date: "+dateLocal+ "imsi: "+newIMSI+"  list: "+str[1]+"Default Hang: "+dfHangTaxi+"Name Hang: "+dfHangTaxiName);
		$.mobile.showPageLoadingMsg("d","Loading",false);
		
		if(isNetwork === 0 ){
			if(evt.target.result === ""){
	        	alert("ko co du lieu");
	        	changePN = 1;
	        	insertPhonenumber();
	        }else{
	    		if(newIMSI === IMSI){
	        		$.mobile.hidePageLoadingMsg();
	    			 load =0;$.mobile.changePage('#page-home',{transition: 'none'}); 
	    			$('#taxi').append(listHangFix);
	    		}
	    		else{
	        		$.mobile.hidePageLoadingMsg();
	    			alert("Bạn đã thay sim, Hãy nhập lại số điện thoại");
	    			changePN = 0;
	    			insertPhonenumber();
	    		}
	        }
			$.mobile.hidePageLoadingMsg();
			// update in file
			// Check Date (ss[0]);
			//update or no update;
		}
		else if(isNetwork === 1){
			console.log("isnet");
			// no data, 
			// please insert Phone number
			// get list taxi from db
			// get time
			// and write data into file local
			if(evt.target.result === ""){
				$("#pn").append("aa");
	    		$.mobile.hidePageLoadingMsg();
	        	alert("Chưa có dữ liệu, Hãy nhập dữ liệu");
	        	changePN = 1;
	        	insertPhonenumber();
	        }
			// Data ok
			// check IMSI in file Data
			// get time in file local and sub timeLocal to timeNow 
			// if(sub > 10day) update data and write data into file local
			// else get data taxi from file local
			else {
				// check IMSI 
				if(newIMSI === IMSI){
					console.log("Data OK! ");
	    			console.log("net,imsi");
	    			var d = new Date();
	    			// check date
	    			if(((1355157541209/1000/86400-dateLocal)) < 10){
	    				console.log("update()");
	    				var listHangTaxi = "";
	    				$.ajax({
	    					url: pingTaxiUrl,
	    					type: 'GET',
	    					dataType: 'jsonp',
	    					data:{'action':'searchXe',
								'lat':sonnaLat,
								'lng':sonnaLng},
							success: function(data) {
								console.log("success db");
								listHangTaxi += '<a href="docs-dialogs.html" data-role="button" value = "0;PTIT Taxi" data-rel="back" data-theme="b">PTIT-Taxi</a>';
	    						for (var i = 0; i < data.hangxe.length; i++){ 
									listHangTaxi +='<a href="docs-dialogs.html" data-role="button" value="'+data.hangxe[i].IDHangXe+';'+data.hangxe[i].TenHang+'" data-rel="back" data-theme="b">'+data.hangxe[i].TenHang+'</a>';
								};
								console.log("aaaaaaaaaaaaaaaaaaa"+listHangTaxi);
				    			$.mobile.hidePageLoadingMsg();
								 load =0;$.mobile.changePage('#page-home',{transition: 'none'}); 
								listHangFix = listHangTaxi;
								$('#taxi').append(listHangFix);
								writeFile(1355157541209/1000/86400+";"+IMSI+";"+newPhoneNumber+";-1;Chưa cập nhật/;"+listHangFix);
							}//end success 
						});//end ajax
	    			}//end if update time
	    			else{
	    				console.log("net, date ");
	    	    		$.mobile.hidePageLoadingMsg();
	    				 load =0;$.mobile.changePage('#page-home',{transition: 'none'}); 
	        			$('#taxi').append(listHangFix);
	    			}
	    		}//end if not change sim
				// 
	    		else{
	    			console.log("net, data, not sim ");
	    			changePN = 0;
	    			insertPhonenumber();
	    			if(((1355157541209/1000/86400-dateLocal)) > 10){
	    				console.log("update()");
	    				var listHangTaxi = "";
	    				$.ajax({
	    					url: pingTaxiUrl,
	    					type: 'GET',
	    					dataType: 'jsonp',
	    					data:{'action':'searchXe',
								'lat':sonnaLat,
								'lng':sonnaLng},
	    					success: function(data) {
	    						console.log("success db");
	    						listHangTaxi += '<a href="docs-dialogs.html" data-role="button" value = "0;PTIT Taxi" data-rel="back" data-theme="b">PTIT Taxi</a>';
	    						for (var i = 0; i < data.hangxe.length; i++){ 
									listHangTaxi +='<a href="docs-dialogs.html" data-role="button" value="'+data.hangxe[i].IDHangXe+';'+data.hangxe[i].TenHang+'" data-rel="back" data-theme="b">'+data.hangxe[i].TenHang+'</a>';
								};
	    						console.log("aaaaaaaaaaaaaaaaaaa"+listHangTaxi);
	    						listHangFix = listHangTaxi;
	    			    		$.mobile.hidePageLoadingMsg();
	    						 load =0;
	    						 $.mobile.changePage('#page-home',{transition: 'none'}); 
	    						$('#taxi').append(listHangFix);
	    						writeFile(1355157541209/1000/86400+";"+IMSI+";"+newPhoneNumber+";-1;Chưa cập nhật/;"+listHangFix);
	    					}//end success 
	    				});//end ajax
	    			}//end if update time
	    			else{
	    				console.log("net, date ");
	    				
	        			$('#taxi').append(listHangFix);
	    			}
	    		}//end else change sim
			}//end else no data
	    	
        }//end else no data
    };// end  reader.onloadend
    reader.readAsText(file);
}
	// fail of all
	function fail(evt) {
	    console.log(evt.target.error.code);
	}
//});	//checkISMI('imsi');
	
//check connection
//detect the type of network, if network state is NONE, show alert to setting network or quit app
//
function checkConnection() {
	var networkState = navigator.network.connection.type;
	
	var states = {};
	states[Connection.UNKNOWN] = 'Unknown';
	states[Connection.ETHERNET] = 'Ethernet connection';
	states[Connection.WIFI] = 'WiFi connection';
	states[Connection.CELL_2G] = 'Cell 2G connection';
	states[Connection.CELL_3G] = 'Cell 3G connection';
	states[Connection.CELL_4G] = 'Cell 4G connection';
	states[Connection.NONE] = 'No';
	if (states[networkState] === 'No') {
		//showAlert();
		isNetwork = 0;
		readFile();
		//checkISMI('imsi');
		//insertPhonenumber();
		// read file system to get phone number, date, list taxi
		
	}
	else{
		isNetwork = 1;
		//checkISMI();
		readFile();
	}
		
}
//the function call native Plugin 'GoSetting' with param 'imsi'
//
function checkISMI(){
	cordova.exec(resultHandlerISMI , errorHandlerISMI , "GoSetting", "nativeAction", ['imsi']);
	//cordova.exec(resultHandlerISMI , errorHandlerISMI , "GoSetting", "nativeAction1", ['imsi']);
	
}
	
//result call native plugin with param 'imsi'
//
function resultHandlerISMI(result){
	
	IMSI = result;
	console.log("Pn: " +IMSI);
}
	
// function insert phone number. open dialog with text input
//
function insertPhonenumber(){
	load=1;
	$.mobile.changePage('#inputPhoneNumber', {transition: 'none', role: 'dialog'}); 
}

// notice user check your phone number
//
function alertPhoneNumber(){
	navigator.notification.confirm(
	        oldPhoneNumber,  // message
	        phoneNumberSetting,         // callback
	        'Đây có phải là số điện thoại của bạn ko ?',            // title
	        'Nhập lại, Đúng'                  // buttonName
	    );
}
	
//
//
function phoneNumberSetting(index){
	if(index == 1 ){
		//navigator.app.exitApp();
		bool = 1; 
		load=1;
		$.mobile.changePage('#inputPhoneNumber', {transition: 'none', role: 'dialog'}); 
	}
		
}
	
//error call native plugin with param 'imsi'
//
function errorHandlerISMI(error){
	alert('imsi error');
}
// event: client click one of 4 button
//$(document).ready(function(){
//	$.ajax({
//		url: pingTaxiUrl,
//		type: 'GET',
//		dataType: 'jsonp',
//		data: 'action=hangtaxi',
//		success: function(data) {
//			$('#taxi').append('<a href="docs-dialogs.html" data-role="button" value = "0" data-rel="back" data-theme="a">PTIT Taxi</a>');
//			$.each(data, function(i,item){ 
//				$('#taxi').append('<a href="docs-dialogs.html" data-role="button" value='+item.id+' data-rel="back" data-theme="b">'+item.name+'</a>');
//			});
//		}//end success 
//			
//	});//end ajax
//});
	
	
function sentFile(){
	if(bool == 0){
		 currentPhoneNumber = newPhoneNumber;
	 }
	 else if (bool == 1){
		 currentPhoneNumber = oldPhoneNumber;
	 }
	 //alert("loai"+loaiClick+", hangClick"+hangClick);
	 console.log("hangClick_sent: " + hangClick);
	 console.log("hangtaxi_sent: " + dfHangTaxi);
	 if(isNetwork === 1){
		// console.log("son:   "+sonna);
		console.log("lat     "+sonnaLat);
		console.log("long    "+sonnaLng);
		if(sonnaLat == 0 && sonnaLng == 0){
			cordova.exec(function(result){
				var str = result.split(";");
				lat = str[0];
				longx = str[1];
				console.log("latlong : "+ lat +" - "+longx);
				//sonnaLat = lat;
				//sonnaLng = longx;
				$.ajax({
					url:pingTaxiUrl,
					type: 'GET',
					dataType:'jsonp',
					data:{'action':'insertLog',
							'imsi' : IMSI,
							'sdt':currentPhoneNumber,
							'hang':hangClick,
							'loai':loaiClick,
							'lat':sonnaLat,
							'long':sonnaLng},
					success: function(data){
						console.log("data"+data);
						if(data == 0){
							navigator.notification.confirm(
							        "",  // message
							        function (index){
							    		if(index == 1 ){
							    			var listHangTaxi = "";
							    			$.ajax({
												url: pingTaxiUrl,
												type: 'GET',
												dataType: 'jsonp',
												data:{'action':'searchXe',
													'lat':sonnaLat,
													'lng':sonnaLng},
												success: function(data) {
													console.log("success db");
													listHangTaxi += '<a href="docs-dialogs.html" data-role="button" value = "0" data-rel="back" data-theme="b">PTIT Taxi</a>';
													for (var i = 0; i < data.hangxe.length; i++){ 
														listHangTaxi +='<a href="docs-dialogs.html" data-role="button" value="'+data.hangxe[i].IDHangXe+';'+data.hangxe[i].TenHang+'" data-rel="back" data-theme="b">'+data.hangxe[i].TenHang+'</a>';
													};
													console.log("aaaaaaaaaaaaaaaaaaa"+listHangTaxi);
													listHangFix = listHangTaxi;
													 load =0;$.mobile.changePage('#page-home',{transition: 'none'}); 
													$('#taxi').html(listHangFix);
													console.log("oK con ga den");
													//1355157541209/1000/86400
													writeFile("15644;"+IMSI+";"+newPhoneNumber+";"+dfHangTaxi+";"+dfHangTaxiName+"/;"+listHangFix);
												}//end success 
													
											});//end ajax
							    			
							    		}
						    		},         // callback
							        'Cuộc gọi không thành công, cần cập nhật lại dữ liệu',            // title
							        'Cập nhật, không'                  // buttonName
							    );
						}else
							alert(smsTraLoiOK);

					}
				
				});
				
			} ,
						 function(){
				console.log("get location ok");
			},
						 "GoSetting", 
						 "nativeAction", 
						 ['nativeActionGetLocation']);
			console.log("latlong : "+ lat+"a"+longx);
			
			
		}else{
			console.log("mai ko dc");
			$.ajax({
				url:pingTaxiUrl,
				type: 'GET',
				dataType:'jsonp',
				data:{'action':'insertLog',
						//'imsi' : IMSI,
						'sdt':currentPhoneNumber,
						'hang':hangClick,
						'loai':loaiClick,
						'lat':sonnaLat,
						'long':sonnaLng},
				success: function(data){
					console.log("data"+data);
					if(data == 0){
						navigator.notification.confirm(
						        "",
						        function (index){
						    		if(index == 1 ){
						    			var listHangTaxi = "";
						    			$.ajax({
											url: pingTaxiUrl,
											type: 'GET',
											dataType: 'jsonp',
											data:{'action':'searchXe',
												'lat':sonnaLat,
												'lng':sonnaLng},
											success: function(data) {
												console.log("success db");
												listHangTaxi += '<a href="docs-dialogs.html" data-role="button" value = "0" data-rel="back" data-theme="b">PTIT Taxi</a>';
												for (var i = 0; i < data.hangxe.length; i++){ 
													listHangTaxi +='<a href="docs-dialogs.html" data-role="button" value="'+data.hangxe[i].IDHangXe+';'+data.hangxe[i].TenHang+'" data-rel="back" data-theme="b">'+data.hangxe[i].TenHang+'</a>';
												};
												console.log("aaaaaaaaaaaaaaaaaaa"+listHangTaxi);
												listHangFix = listHangTaxi;
												 load =0;$.mobile.changePage('#page-home',{transition: 'none'}); 
												$('#taxi').html(listHangFix);
												console.log("oK con ga den");
												//1355157541209/1000/86400
												writeFile("15644;"+IMSI+";"+newPhoneNumber+";"+dfHangTaxi+";"+dfHangTaxiName+"/;"+listHangFix);
											}//end success 
												
										});//end ajax
						    			
						    		}},         // callback
						        'Cuộc gọi không thành công, cần cập nhật lại dữ liệu',            // title
						        'Cập nhật, không'                  // buttonName
						    );
					}else
					alert(smsTraLoiOK);
				}
			
			});
		}//end else
	 }
	 else if(isNetwork === 0){
		 var sms;

		window.requestFileSystem(LocalFileSystem.PERSISTENT, 0,
				function gotFS(fileSystem) {
					console.log("file System");
					fileSystem.root.getDirectory("ptittaxi", {
						create : true,
						exclusive : false
					}, function(file) {
						console.log("get file ok");
						file.getFile("config.txt", {
							create : true,
							exclusive : false
						}, function(fileEntry) {
							console.log("get file entry ok");
							fileEntry.file(function(file) {
								readAsTextConfig(file);
							}, fail);
						}, fail);
					}, fail);
				}, fail);
		 function readAsTextConfig(file) {
			var reader = new FileReader();
			reader.onloadend = function(evt) {
				var str = evt.target.result.split(";");
				sdtTG = str[1];
				console.log(sdtTG);
				 if(sonnaStt === 0){
					 sms = sdtTG +"/;"
						+loaiClick+";"
			 			+hangClick+";"
			 			+newPhoneNumber+";"
			 			+sonnaStt+";"
			 			+sonnaLat+";"
			 			+sonnaLng;
				 }
				 //ko co GPS
				 else{
					sms = sdtTG +"/;"
						+loaiClick+";"
			 			+hangClick+";"
			 			+newPhoneNumber+";"
			 			+sonnaStt+";"
				 }
				 
				 cordova.exec(resultHandlerSMS , errorHandlerSMS , "GoSetting", "nativeActionSendSMS", [sms]);
			};
			reader.readAsText(file);
		 }
		 console.log("status: " + sonnaStt);
		 // co GPS
		
	 }
}
	$("#content a").live('click', function() {
		loaiClick = $(this).attr('value');
		console.log("loai xe: " + loaiClick);
		console.log("Hang MD: "+dfHangTaxi);
		if(dfHangTaxi != -1 && dfHangTaxi != null){
			hangClick = dfHangTaxi;
			sentFile();
			$.mobile.changePage('#page-home',{transition: 'none'});
		}else{
			$.mobile.changePage($('#dialog'), {transition: 'none', role: 'dialog'});
		}
		console.log(loaiClick);
		
	});
	$('#taxi a').live('click',function(){
		hangClickArr = $(this).attr('value').split(";");
		var dfhang = 'Bạn có muốn đặt làm hãng mặc định?';
		hangClick = hangClickArr[0];
 		dfHangTaxi = -1;
//		if(dfhang == true){
//			dfHangTaxi = hangClickArr[0];
//			dfHangTaxiName = hangClickArr[1];
//			console.log("hang mac dinh:"+dfHangTaxi+"ten: "+dfHangTaxiName);
//			writeFile(1355157541209/1000/86400+";"+IMSI+";"+newPhoneNumber+";"+daiLy+";"+dfHangTaxi+";"+dfHangTaxiName+"/;"+listHangFix);
//		}
        navigator.notification.confirm(dfhang, function(index) {
    		if (index == 2) {
    			dfHangTaxi = hangClickArr[0];
    			dfHangTaxiName = hangClickArr[1];
    			console.log("hang mac dinh:"+dfHangTaxi+"ten: "+dfHangTaxiName);
    			writeFile(1355157541209/1000/86400+";"+IMSI+";"+newPhoneNumber+";"+dfHangTaxi+";"+dfHangTaxiName+"/;"+listHangFix);
    		}
    		//sentFile();
    	}, "Cảnh báo", "Không,Có");
		sentFile();
	});
	function resultHandlerSMS(){
		alert(smsTraLoiOK);
	}
	function errorHandlerSMS(){
		alert("sms Error");
	}
	$("#sdtClick").live('click', function() {
		 if((isNetwork === 0)&&(changePN === 1) ){
			 var d = new Date();
			 console.log("Pnok: " +IMSI);
			 newPhoneNumber = $('#phoneNumber').attr('value');
			 listHangFix = '<a href="docs-dialogs.html" data-role="button" value = "0;PTIT Taxi" data-rel="back" data-theme="b">PTIT Taxi</a>';
			  load =0;
			  $.mobile.changePage('#page-home',{transition: 'none'}); 
			 $('#taxi').append(listHangFix);
			 console.log("okclick");
			 writeFile("15644"+";"+IMSI+";"+newPhoneNumber+";"+dfHangTaxi+";"+dfHangTaxiName+"/;"+listHangFix);
		 }
		 else  if((isNetwork === 0)&&(changePN === 0) ){
			
			 console.log("Pnok: " +IMSI);
			 newPhoneNumber = $('#phoneNumber').attr('value');
			  load =0;$.mobile.changePage('#page-home',{transition: 'none'}); 
			 $('#taxi').append(listHangFix);
			 
		 }
		 else if((isNetwork === 1)&&(changePN === 1 )){
			 console.log("Pnok net1 pn1 : " +IMSI);
			 newPhoneNumber = $('#phoneNumber').attr('value');
			 var d = new Date();
			 var listHangTaxi = "";
			 $.ajax({
					url: pingTaxiUrl,
					type: 'GET',
					dataType: 'jsonp',
					data:{'action':'searchXe',
						'lat':sonnaLat,
						'lng':sonnaLng},
					success: function(data) {
						console.log("success db");
						listHangTaxi += '<a href="docs-dialogs.html" data-role="button" value = "0;PTIT Taxi" data-rel="back" data-theme="b">PTIT Taxi</a>';
						for (var i = 0; i < data.hangxe.length; i++){ 
							listHangTaxi +='<a href="docs-dialogs.html" data-role="button" value="'+data.hangxe[i].IDHangXe+';'+data.hangxe[i].TenHang+'" data-rel="back" data-theme="b">'+data.hangxe[i].TenHang+'</a>';
						};
						console.log("aaaaaaaaaaaaaaaaaaa"+listHangTaxi);
						listHangFix = listHangTaxi;
						 load =0;$.mobile.changePage('#page-home',{transition: 'none'}); 
						$('#taxi').append(listHangFix);
						console.log("oK con ga den");
						//1355157541209/1000/86400
						writeFile("15644;"+IMSI+";"+newPhoneNumber+";"+dfHangTaxi+";"+dfHangTaxiName+"/;"+listHangFix);
					}//end success 
						
				});//end ajax
		 }
		 else if((isNetwork === 1)&&(changePN === 0 )){
			 console.log("Pnok: " +IMSI);
			 newPhoneNumber = $('#phoneNumber').attr('value');
			 //$('#taxi').append(listHangFix);
		 }
	});
	$('#phoneNumber').live('blur', function(event, ui) {
		var fld = $('#phoneNumber');
		if((fld.val().length < 1)||(fld.val().length > 11))
		{
			this.style.background ='red';
			//error1="Biá»ƒn sá»‘ xe khÃ´ng Ä‘Ãºng!\nChá»‰ nháº­p chá»¯ vÃ  sá»‘. VÃ­ dá»¥: 29A1234 vÃ  29A12345\n";
		} else {
			//this.style.background = "white";
			//error1 ="";
		}
	});
	
	$("#Setting").live('click', function() {
		console.log("new : " + newPhoneNumber);
		$('#sdtInput').attr('value', newPhoneNumber);
		$('#delHang').attr('value', dfHangTaxiName);
		load=1;
		$.mobile.changePage('#Setting',{transition: 'none',role: 'dialog'}); 
	});
	
	$("#delHang").live('click', function(){
		if(dfHangTaxiName != 'Chưa cập nhật'){
			var delHang = confirm("Bạn muốn xóa hãng mặc định này?");
			if(delHang == true){
				dfHangTaxi = -1;
				dfHangTaxiName = "Chưa cập nhật";
				writeFile(1355157541209/1000/86400+";"+IMSI+";"+newPhoneNumber+";"+dfHangTaxi+";"+dfHangTaxiName+"/;"+listHangFix);
				$.mobile.changePage('#page-home',{transition: 'none'}); 
			}else{
				load=1;
				$.mobile.changePage('#page-home',{transition: 'none'}); 
			}
		}
	});
	$("#okSettingClick").live('click', function() {
		newPhoneNumber= $('#sdtInput').val();
		writeFile("15644"+";"+IMSI+";"+newPhoneNumber+";"+dfHangTaxi+";"+dfHangTaxiName+"/;"+listHangFix);
		load=1;
		$.mobile.changePage('#page-home',{transition: 'none'}); 
	});
	$("#cancelSettingClick").live('click', function() {
		load=1;
		$.mobile.changePage('#page-home',{transition: 'none'}); 
	});
	$("#mapBtn").live('click', function() {
		$('#refreshBtn').trigger('click');
		$.mobile.changePage('#page-map',{transition: 'none'}); 
	});

