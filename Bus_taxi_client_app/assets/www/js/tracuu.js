//var url = "http://www.tuyetson08.byethost6.com/pingtaxi_api/api_sonna.php";
var urlSearch = url + 'api_vansonict_client.php';
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

$('#page-search').live('pageinit', function() {
	$.ajax({
		'url': urlSearch,
		'dataType': 'jsonp',
		'type': 'GET',
		'data': {'action':'searchXe'},
		'success': function(data) {
			//console.log("call back lisdong ok");
			timeout = "true";
	//		$.each(data, function(i,item){ 
	//			$('#hangxe').append("<option value='"  + item.IDHangXe + "'>"  + item.TenHang  + "</option>");
	//		});
			for (var i = 0; i < data.hangxe.length; i++) {
				$('#hangxe').append("<option value='" + data.hangxe[i].IDHangXe + "'>" + data.hangxe[i].TenHang + "</option>");
			}
			for (var i = 0; i < data.loaixe.length; i++) {
				$('#loaixe').append("<option value='" + data.loaixe[i].IDLoaiXe + "'>" + data.loaixe[i].LoaiXe + "</option>");
			}
		}
	});
	setTimeout(function(){
		if(timeout == "false"){
			alert("Không tìm thấy kết nối internet trên điện thoại của bạn!\n Vui lòng kiểm tra lại!");
			//$.mobile.changePage("index.html");
			timeout="true";
		}
	}, 15000);
	//console.log("load page ok");
	timeout = "false";
	//$('.button').bind('click', function () {
	$('#button').bind('click',function(event, ui){
		//$.mobile.showPageLoadingMsg("d","Loading",false);
		//$.mobile.hidePageLoadingMsg();
		console.log("hang: " + $('#hangxe').val());
		$.ajax({
			'url': urlSearch,
			'dataType': 'jsonp',
			'type': 'GET',
			'data': {
				'action':'searchInfo',
				'id_hangxe': $('#hangxe').val(),
				'id_loaixe': $('#loaixe').val(),
				'diemden': $('#end_location').val()
			},
			'success': function(data) {
				console.log("call back hang ok: " + data);
				timeout = "true";
//				$.each(data, function(i,item){ 
//					$('#.wrap-content').append("<span class=\"station\"></span>" +
//							"<h2>"  + item.TenHang + "<br/>Số điện thoại: "  + item.SoDienThoai  + "<br/> Địa chỉ: " + item.DiaPhuong + "<br/>");
//				});
				//alert(data.length);
				if(data.length == 0) {
					alert("không có kết quả phù hợp");
					$.mobile.changePage( "index.html", { transition: "slideup"});
				}
				//$.mobile.changePage( "tracuu.html#page-info", { transition: "slideup"} );
				$('.wrap').html("");	//reset lại danh sách
				for(var i =0; i < data.length; i++) {
					$str1 = data[i].LoTrinhTomTat.replace(/\|/gi, "-"); //thay thế | bằng -
					$str2 = data[i].LoTrinhChiTiet.replace(/\|/gi, "-");
					$('.wrap')
					.append(
						"<div class=\"wrap-content\">" +
							"<span class=\"station\"></span>" +
							"<h2>" + data[i].BKS + "</h2>" +
							"<span class=\"img-car\"></span>" +
							"<p>" + $str1 + "</p>" +
							"<span class=\"info-price-time\">" + data[i].TimeArrive + "phút/chuyến</span>" +
							"<div data-role=\"collapsible\" class=\"info_ct\" data-theme=\"e\" data-mini=\"true\" data-content-theme=\"e\">" +
								"<h4>Thông tin chi tiết</h4>" +
								"<p>" + $str2 + "</p>" +
								"<div class=\"ui-grid-a\">" + 
									"<div class=\"ui-block-a\"><a class=\"info-m\" id=\"" + i + "\" href=\"#info-map\" data-role=\"button\" data-mini=\"true\" data-transition=\"flip\" data-theme=\"d\">Xem trên bản đồ</a></div>" +
									"<div class=\"ui-block-b\"><a href=\"#page-map\" data-role=\"button\" data-mini=\"true\" data-transition=\"flip\" data-theme=\"d\">Trạm xe gần nhất</a></div>" +
								"</div>" +
							"</div>" +
							"<input type=\"hidden\" value=\"" + $str2 + "\" id=\"input-" + i + "\">" +
							"<hr></hr>" +
						"</div>"
					);
				}
			}
		});
		
		setTimeout(function(){
			if(timeout == "false"){
				timeout = "true";
				alert("Không tìm thấy kết quả! Vui lòng kiểm tra lại kết nối internet!");
				//$.mobile.changePage("index.html");
			}
		}, 15000);
	});
});

//-------------------------------------------------------------
$('#page-info').live('pageshow', function(){
	$.mobile.changePage("index.html#page-info2");
});

var strRoad = '';
$('#page-info2').live('pageinit', function(){
	$('.info-m').bind('click', function(){
		var $a = $(this);
		var b = $a.attr("id");
		strRoad = $("#input-" + b).attr("value");
		//alert(strRoad);
	});
});

$('#info-map').live('pageshow', function() {
	var Hanoi = new google.maps.LatLng(21.03333330, 105.85000000);
//	var hanoi = { 
//		destination: new google.maps.LatLng(21.03333330, 105.85000000) 
//	};
//	$('#map_Icanvas').gmap( {
//		'center': hanoi.destination,
//		'mapTypeControl': false,
//		'mapTypeId': google.maps.MapTypeId.ROADMAP,
//		'zoom': 15,
//		'zoomControl': true,
//		'zoomControlOptions': {
//			'position': google.maps.ControlPosition.RIGHT_BOTTOM,
//			'style': google.maps.ZoomControlStyle.SMALL
//		}
//	});
//	
//	$('#map_Icanvas').gmap({'callback':function() { 
//        this.displayDirections({ 
//        	'origin': 'Los Angeles, USA', 
//        	'destination': 'New York, USA', 
//        	'travelMode': google.maps.DirectionsTravelMode.DRIVING 
//        }, 
//        { 'panel': document.getElementById('panel')}, 
//        function(result, status) {
//                if ( status === 'OK' ) {
//                        alert('Directions success!');
//                }
//        });                                                                                                                                                                                                                       
//	}});
	initialize();
	calculateRoute();
});

var directionDisplay, 
	directionsService = new google.maps.DirectionsService(), 
	map;

function initialize() 
{
    directionsDisplay = new google.maps.DirectionsRenderer();
    var mapCenter = new google.maps.LatLng(20.9875830,105.8316770);

    var myOptions = {
        zoom:10,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: mapCenter
    }

    map = new google.maps.Map(document.getElementById("map_Icanvas"), myOptions);
    directionsDisplay.setMap(map);
}

 function calculateRoute() 
{
    var start = 'Hà Nội',
        end = 'Thanh Hóa';
	var waypts = [];
	
	var roadArr = strRoad.split('-');
	for (var i = 1; i < roadArr.length-1; i++) {
		waypts.push({
			location: roadArr[i],
			stopover:true
		});
	}
	start = roadArr[0];
	end = roadArr[roadArr.length-1];
	
    if(start == '' || end == '')
    {
        // cannot calculate route
        $("#results").hide();
        return;
    }
    else
    {
        var request = {
            origin:start, 
            destination:end,
           	waypoints: waypts,
            travelMode: google.maps.TravelMode.DRIVING
        };

        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response); 
            }
        });

    }
}
