var sonnaStt = 1;
var load = 1;
var urlServer = url + 'api_vansonict_map.php';
// page-map

$('#page-map').live("pageinit", function() {
	//vô hiệu backbutton
	document.addEventListener("backbutton", onBackKeyDown, true);
	function onBackKeyDown() {
		console.log("back button click");
	}
	//$.mobile.changePage("#page-startup")
	var mapLoaded = false;
	var online = false;
	var centerChanged = 0;
	
	//tao ra 1 message xuat hien va bien mat sau 2.2s
	function fadingMsg (locMsg) {
	    $("<div class='ui-overlay-shadow ui-body-e ui-corner-all fading-msg'>" + locMsg + "</div>")
	    .css({ "display": "block", "opacity": 0.9, "top": $(window).scrollTop() + 100 })
	    .appendTo( $.mobile.pageContainer )
	    .delay( 1500 )
	    .fadeOut( 1000, function() {
	        $(this).remove();
	   });
	}
	
    function addShape(shapeType) {
        // add shape at center
        $('#map_canvas').gmap('addShape', shapeType, { 
            'strokeWeight': 0, 
            'fillColor': "#008595", 
            'fillOpacity': 0.25, 
            'center': clientPosition, 
            'radius': 15, 
            'clickable': false 
        });
    }
    
    function onSuccess(position) {
        sonnaStt = 0;
//    	$('#location-service-status').val('1');
    	var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        var markers = $('#map_canvas').gmap('get', 'markers');
        if (markers.length > 0) {
            markers[0].setPosition(latlng);
            $('#map_canvas').gmap('option', 'center', latlng);
        } 
        else {
			var icon = new google.maps.MarkerImage(
				'images/user-marker-red.png',
				new google.maps.Size(50,53),
				new google.maps.Point(0,0),
				new google.maps.Point(17,34)
			);
			
            $('#map_canvas').gmap('addMarker', {
                'position': latlng,
                'icon': icon,
                'animation': google.maps.Animation.DROP,
                'bounds': true,
                'draggable': true   
            }, function(map, marker) {
            	var pageWidth = $('[data-role="page"]').first().width();
            	console.log("device width:" + pageWidth);
                $('#map_canvas').gmap('openInfoWindow', {
                    'content': 'Kéo tới vị trí chính xác mà bạn muốn gọi xe khách',
                    'position': marker.getPosition(),
                    'maxWidth': pageWidth / 2
                }, marker);
                $('#map_canvas').gmap('option', 'zoom', 15);
            })     
            .drag(function() {
                $('#map_canvas').gmap('closeInfoWindow');    
            })      
            .dragend(function() {
                var marker = this;
                var position = marker.getPosition();
                console.log("lat :  " +position.lat());
                sonnaLat = position.lat()*1000000;
                sonnaLng = position.lng()*1000000;
                //$('#lat-hidden').val(position.lat());
                //$('#lng-hidden').val(position.lng());
                $('#map_canvas').gmap('search', { 'location': position }, function(results, status) {
                    if ( status === 'OK' ) {
                        var streetNumber, route, state, country;
                        $.each(results[0].address_components, function(i, v) {
                           if ( v.types[0] === "administrative_area_level_1" 
                                   || v.types[0] === "administrative_area_level_2" ) {
                               state = v.long_name;
                           } 
                           else if ( v.types[0] === "country") {
                               country = v.long_name;
                           } 
                           else if (v.types[0] === "street_number") {
                               streetNumber = (v.long_name === "undefined") ? '' : v.long_name;
                           } 
                           else if (v.types[0] === "route") {
                               route = (v.long_name === "undefined") ? '' : v.long_name;
                           } 
                        });
                        var contentHTML = '<p>' + streetNumber + ' ' + route + '</p>' 
                                + '<p>' + state + ' ' + country + ' ' + '</p>';
                        $('#map_canvas').gmap('openInfoWindow', { 
                            'content': contentHTML,
                            'position': marker.getPosition() 
                        }, marker);
                    } 
                });     
            });
        }
    }

    function onError(error) {       
    	$('#location-service-status').val('0');
    	var msg = "Không thể xác định vị trí hiện tại. Kiểm tra lại cấu hình dịch vụ vị trí";
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
    	}, "Cảnh báo", "Từ chối,Đồng ý");
    }
    
    function loadMap() {
    	var hanoi = { 
    		destination: new google.maps.LatLng(21.03333330, 105.85000000) 
    	};
    	$("<div id='loadingMsg' class='ui-overlay-shadow ui-body-e ui-corner-all fading-msg'>Loading map...</div>")
			.css({ "display": "block", "opacity": 0.9, "top": $(window).scrollTop() + 100 })
			.appendTo( $.mobile.pageContainer );
    	
    	$('#map_canvas').gmap( {
    		'center': hanoi.destination,
    		'mapTypeControl': false,
    		'mapTypeId': google.maps.MapTypeId.ROADMAP,
    		'zoom': 15,
    		'zoomControl': true,
    		'zoomControlOptions': {
    			'position': google.maps.ControlPosition.RIGHT_BOTTOM,
    			'style': google.maps.ZoomControlStyle.SMALL
    		}
    	})
    	.bind('init', function(evt, map) {
    		console.log('map init');
    		mapLoaded = true;
    		if ( navigator.geolocation ) {
            	console.log("navigator ok");
                var options = { timeout: 5000, enableHighAccuracy: true, maximumAge: 5000 };
                navigator.geolocation.getCurrentPosition (onSuccess, onError, options);
            }
    		google.maps.event.addListenerOnce(map, 'idle', function() {
				$('#loadingMsg').fadeOut( 1000, function() {
		    		$(this).remove();
		    	});
    			console.log('idle event occur');
    		});
    	});
		$('#map_canvas').gmap('refresh');
    }
    
    function checkNetwork() {
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
			var msg = "Ứng dụng cần có Internet, kết nối dữ liệu hiện không khả dụng. Thử lại";
			navigator.notification.confirm(msg, function(index) {
        		if (index === 2) {
        			cordova.exec(success, error, "GoSetting", "nativeAction", ['setting']);
        			console.log("go setting button tapped");
        			function success() {
        				fadingMsg("Di chuyển tới mục thiết lập dịch vụ vị trí");
        				console.log("go to location setting");
        			}
            		function error() {
            			console.log("error, exit app");
            			navigator.app.exitApp();
            		}
            		document.addEventListener("online", function() {
            			online = true;
            		}, false);
        		} else {
        			console.log("user denied change setting.");
        			$.mobile.changePage("#page-home");
        		}
        	}, "Cảnh báo", "Từ chối,Đồng ý");
    	} else {
    		console.log("network state ok");
    		online = true;
    	}
    }
    
    $('#page-map div[data-role="footer"] li').live('click', function() {
    	checkNetwork();
    	if (online) {
    		if (!mapLoaded) loadMap();
    		else if ( navigator.geolocation ) {
	        	console.log("navigator ok");
	            var options = { timeout: 5000, enableHighAccuracy: true, maximumAge: 5000 };
	            navigator.geolocation.getCurrentPosition (onSuccess, onError, options);
    		}
    	} 
    	else return;
        $(this).removeClass('.ui-btn-active');
        console.log("refresh clicked");
    });
    
    function updateConfig() {
    	$.ajax({
			url: urlServer,
			type: 'GET',
			data: {
				'action': 'getConfig',
			},
			dataType: 'jsonp',
			success: function(data) {
				console.log('ajax success');
				window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, getFileSystemSuccess, fail);
				
				function getFileSystemSuccess(fileSystem) {
					console.log('get file system susscess');
					fileSystem.root.getDirectory("ptittaxi", {create: true, exclusive: false},
							getDirectoryEntrySuccess, fail);
				}

			    function getDirectoryEntrySuccess(directoryEntry) {
			    	console.log('get directory entry success');
			        directoryEntry.getFile("config.txt", {create: true, exclusive: false},
			        		getFileEntrySuccess, fail);
			    }

			    function getFileEntrySuccess(fileEntry) {
			    	console.log('get file entry success');
			        fileEntry.createWriter(getFileWriterSuccess, fail);
			    }

			    function getFileWriterSuccess(writer) {
			    	console.log('get file writer success');
			        writer.onwriteend = function(evt) {
			        	console.log('write end');
		        		console.log(evt);
			        };
			        writer.write(data.giaidoan +";"+ data.sdt_tg);
			    }
			    
			    function fail(error) {
			        console.log(error.code);
				}
			}
    	});
    }
    
    document.addEventListener("deviceready", onDeviceReady, false);
    function onDeviceReady() {
    	console.log("device ready");
    	updateConfig();
    	$('#refreshBtn').trigger('click');
    }
});

function calculateDistance(latitude1, longitude1, latitude2, longitude2) {
	var dLat = (latitude2 - latitude1).toRad();
	var dLon = (longitude2 - longitude1).toRad();
	var lat1 = (latitude1).toRad();
	var lat2 = (latitude2).toRad();
	
	var radius = 6378.1;
	var a = Math.sin(dLat / 2)*Math.sin(dLat/2) 
		+ Math.sin(dLon / 2)*Math.sin(dLon / 2)*Math.cos(lat1)*Math.cos(lat2);
	var c = 2*Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
	return radius*c;
}