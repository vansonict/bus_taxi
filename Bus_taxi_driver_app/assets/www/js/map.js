
var hanoi = { destination : new google.maps.LatLng(21.03333330, 105.85000000) };
var geolocationErrorStr = 'Không thể xác định vị trí hiện tại của bạn.' + 
		' Hãy kiểm tra lại kết nối mạng hoặc cấu hình GPS.';
var driverLat = 0.0, driverLon = 0.0;
var showingCallMenu = false;
var resumingFromCall = false;
var waiting = true;
var ringing = false;

$('#page-map').live('pageinit', function() {
	
	var driverImage = new google.maps.MarkerImage(
		'images/markers/icon_driver.png',
		new google.maps.Size(34,34),
		new google.maps.Point(0,0),
		new google.maps.Point(17,34)
	);

	var clientImage = new google.maps.MarkerImage(
		'images/markers/icon_client.png',
		new google.maps.Size(34,34),
		new google.maps.Point(0,0),
		new google.maps.Point(17,34)
	);

	var shadow = new google.maps.MarkerImage(
		'images/markers/shadow.png',
		new google.maps.Size(40,34),
		new google.maps.Point(0,0),
		new google.maps.Point(10,34)    
	);
	
	$('#map_canvas').gmap( {
		'center': hanoi.destination,
		'mapTypeId' : google.maps.MapTypeId.ROADMAP,
		'mapTypeControl': true,
		'mapTypeControlOptions' : {
			'position' : google.maps.ControlPosition.TOP_RIGHT,
			'style' : google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
		'zoom': 15,
		'zoomControl': true,
		'zoomControlOptions': {
			'position': google.maps.ControlPosition.RIGHT_BOTTOM,
			'style': google.maps.ZoomControlStyle.SMALL
		}
	}).bind("init", function(event, map) {
		console.log("map init. get current position");
		google.maps.event.addListener(map, 'bounds_changed', function() {
			console.log(map.getBounds());
			if (map.getBounds().getNorthEast() !== map.getBounds().getSouthWest()) {
				addWatchPosition();
				google.maps.event.clearListeners(map, 'bounds_changed');
			}
		});
	});
	
	function addWatchPosition() {
		var options = {
			timeout : 5000,
			enableHighAccuracy : true,
			maximumAge : 5000
		};
		
		var watchId = navigator.geolocation.watchPosition(
			function onSuccess(position) {
				console.log("watch position success");
				driverLat = position.coords.latitude;
				driverLon = position.coords.longitude;
				var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	
				var markers = $('#map_canvas').gmap('get', 'markers');
				$('#map_canvas').gmap('option', 'center', latlng);
				if (markers.length > 0) {
					console.log("set marker to new position get by geolocation");
					markers[0].setPosition(latlng);
				} else {
					addMarker(latlng, true);
				}
			},
			function onError(error) {
				console.log("watch position error");
				navigator.notification.alert(geolocationErrorStr, function(index) {
					$.mobile.changePage("index.html", {});
				}, 'Cảnh báo', 'Đồng ý');
			}, options
		);
	}
	
	function fadingMsg(locMsg) {
		$("<div class='ui-overlay-shadow ui-body-e ui-corner-all fading-msg'>" + locMsg + "</div>").css({
			"display" : "block",
			"opacity" : 0.9,
			"top" : $(window).scrollTop() + 100
		}).appendTo($.mobile.pageContainer).delay(1500).fadeOut(1500, function() {
			$(this).remove();
		});
	}

	function addMarker(latlng, isDriver) {
		var markers = $('#map_canvas').gmap('get', 'markers');
		console.log(markers.length);
		if (markers.length > 1) {
			console.log('marker exist, set new position');
			var len = markers.length;
			console.log("markers length " + len);
			markers[len - 1].setPosition(latlng);
			markers[len - 1].setVisible(true);
		}
		else {
			console.log("create new marker");
			var icon = isDriver ? driverImage : clientImage;
			var tags = isDriver ? 'driver' : 'customer';
			$('#map_canvas').gmap('addMarker', {
				'position' : latlng,
				'icon': icon,
				'animation' : google.maps.Animation.DROP,
				'bounds' : false
			}, function(map, marker) {
				var $map = $('#map_canvas');
				/*while (!($('#map_canvas').gmap('inViewport', marker))) {
					console.log("new marker not in viewport.");
					var zoom = $('#map_canvas').gmap('option', 'zoom');
					$('#map_canvas').gmap('option', 'zoom', zoom - 1);
				}*/
			});
		}
	}

	function removeMarker(tags) {
		$('#map_canvas').gmap('find', 'markers', { 'property': 'tags', 'value': tags },
				function(marker, isFound) {
			if (isFound) {
				console.log("found marker with tags");
				marker.setMap(null);
			} else {
				console.log("not found client marker with tags");
			}
		});
		var markers = $('#map_canvas').gmap('get', 'markers');
		if (markers.length > 1) {
			for (var i = 1; i < markers.length; i++) {
				markers[i].setVisible(false);
			}
			console.log("markers length > 1, set all client marker to not visible");
			console.log("markers length = " + i);
		}
	}
	
	$('#waitOn').live('click', function() {
		if (!waiting) {
			waiting = true;
			fadingMsg("Đã chuyển sang trạng thái đợi khách");
		}
		$(this).removeClass('.ui-btn-active');
		$('#OnState').attr('src','images/buttons/dangbatbtn.png');
		$('#OffState').attr('src','images/buttons/tatbtn.png');
	});

	$('#waitOff').live('click', function() {
		if (waiting) {
			navigator.notification.confirm("Bạn chắc chắn muốn tắt trạng thái đợi khách ?", function(bttIndex) {
				if (bttIndex === 2) {
					console.log("tat trang thai doi khach");
					waiting = false;
					fadingMsg('Đã tắt trạng thái đợi khách'); 
					$('#OnState').attr('src','images/buttons/batbtn.png');
					$('#OffState').attr('src','images/buttons/dangtatbtn.png');
				} 
			}, "Xác nhận", "Hủy bỏ,Đồng ý");
		}
		$(this).removeClass('.ui-btn-active');
		
	}); 

	var ringInterval = setInterval(function() {
    	if (ringing) {
    		console.log("ringing = true");
    		navigator.notification.beep(1);
            navigator.notification.vibrate(1000);
            return;
    	} 
    }, 1000);

	var ajaxInterval = setInterval(function() {
		if (!waiting || resumingFromCall || showingCallMenu) { 
			if (!waiting) { console.log("trang thai doi khach bi tat"); }
			if (resumingFromCall) { console.log("dang thuc hien cuoc goi, ko cho doi yeu cau moi"); }
			if (showingCallMenu) { console.log("call menu dang hien thi, ko nhan yeu cau moi"); }
			return false; 
		}

		var jsonURL = 'http://localhost:8080/bom/pingtaxi_api/api_anh.php';
		$.ajax({
			url: jsonURL,
			type: 'GET',
			data: {
				'action': 'getCustvomerLog',
				'lat': driverLat,
				'lon': driverLon  
			},
			dataType: 'jsonp',
			success: processResponse
		});
		console.log("end set interval");
	}, 10000);   
	
	function processResponse(data) {
		console.log('new result come');
		if (data.phoneNumber.length > 0) {
			console.log("ket qua tra ve hop le, co yeu cau moi");
			var latlng = new google.maps.LatLng(data.latitude, data.longitude);
			addMarker(latlng);
			ringing = true;
			showCallButton(data.phoneNumber);
		}
	} 

	function showCallButton(phoneNumber) {
		showingCallMenu = true;
		console.log("show call button, showingCallMenu = true");
		var callControl = $('#footer-notification');
		callControl.css({ 'display': 'inline' });
		$('.call-button').attr('href', 'tel:' + phoneNumber);

		$('.call-button').live('click', function() {
			console.log('call button click');
			console.log('tel:+' + phoneNumber);
			callControl.fadeOut(1000, function() {
				callControl.css({ 'display': 'none' });
				resumingFromCall = true;
				showingCallMenu = false;
				console.log("showingCallMenu = false");
				console.log("resuming from call = true");
				ringing = false;
				console.log("ring = false");
			});
		});

		$('.reject-button').live('click', function() {
			console.log('reject button click');
			callControl.fadeOut(1000, function() {
				callControl.css({ 'display': 'none' });
				showingCallMenu = false;
				console.log("showingCallMenu = false");
				console.log("xoa marker cu sau khi reject");
				removeMarker('customer');
				ringing = false;
                console.log("ring = false");
			});
		});
		console.log("end show call button");
	}

	document.addEventListener("resume", onResume, false);
	function onResume() {
		console.log("on resume fired");
		if (resumingFromCall) {
			resumingFromCall = false;
			removeMarker('customer');
			console.log("resumingFromCall = false");
			console.log("xoa marker sau khi calling");
		}
	}

	document.addEventListener("pause", onPause, false);
	function onPause() {
		console.log("on pause fired");
	}

	document.addEventListener("offline", onOffline, false);
	function onOffline() {
		console.log("offline fired");
	}
});

$('#page-map').live("pageshow", function() {
	console.log("page show");
	$('#map_canvas').gmap('refresh');
});

