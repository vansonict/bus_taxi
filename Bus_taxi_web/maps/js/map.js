//////////////////////////////////////////////////////////////////////////
// JScript source code
// author: vansonict + anhtn
//////////////////////////////////////////////////////////////////////////

var hanoi = { destination: new google.maps.LatLng(21.03333330, 105.85000000) };
var markerRemain = 0;

var driverImage = new google.maps.MarkerImage(
	'images/markers/icon_driver.png',
	new google.maps.Size(96, 96),
	new google.maps.Point(0, 0),
	new google.maps.Point(48, 96)
);

var clientImage = new google.maps.MarkerImage(
	'images/markers/icon_client.png',
	new google.maps.Size(96, 96),
	new google.maps.Point(0, 0),
	new google.maps.Point(48, 96)
);

//Login & register Control
$(document).ready(function() {
    function logout(token) {
            $.ajax({
                    url: './map_functions.php?action=logout',
                    type: 'POST',
                    data: {
                        'token': token		    
                    },
                    //async: true,
                    cache: false,
                    timeout: 5000,
                    success: function (result) {
                            var data = $.parseJSON(result);
                            if (data.status === 'success') {

                                    $('#p-welcome').text('Hello Guest');
                                    $('#p-open').text(' Sign In/Register');
                                    $("a.dropdown-toggle > span").addClass('welcome-hidden');
                                    $('.dropdown-menu').addClass('welcome-hidden');
                                    
                                    $('#login-status').val('no');
                                    $('#login-username').val('');
                                    $('#login-token').val('');
                                    
                                    fadingMsg('Đăng xuất thành công');
                            } else {
                                    alert('Đăng xuất thất bại');
                            }
                            console.log(data);
                            hideToast();
                    },
                    error: function (err) {
                            hideToast();
                            alert('Đăng xuất không thành công');
                            console.log(err);
                    }
            });
    }
    
    $("#open").click(function () {
        if ($('#login-status').val() === 'yes') {
            showToast('Loading...');
            var token = $('#login-token').val();
            //alert(token);
            logout(token);
        } 
    });
    
    $('#sign_in').live('click', function() {
        showToast('Loading...');
        var name = $('#userid').val();
        var pass = $('#passwordinput').val();
        var rememberme = $('#rememberme').val();
        if(name !== '' && pass !== '')
            login(name, pass, rememberme);    
        
        function login(name, pass, rememberme) {
            $.ajax({
                url: './map_functions.php?action=login',
                type: 'POST',
                data: {
                    username: name,
                    password: pass,
                    remember: rememberme        
                },
                async: true,
                cache: false,
                timeout: 5000,
                success: function (data) {
                    console.log('ajax login success');
                    console.log(data);
                    var result = $.parseJSON(data);
                    if (result.status === 'success') {
                        $('#p-welcome').text('Hello ' + name);
                        $('#p-open').text(' Log Out');
                        $("a.dropdown-toggle > span").removeClass('welcome-hidden');
                        $('.dropdown-menu').removeClass('welcome-hidden');
                        
                        $('#login-status').val('yes');                
                        $('#login-username').val(name);
                        $('#login-token').val(result.token);
                        
                        var latlng = new google.maps.LatLng(data.fix_lat / 1000000, data.fix_lng/ 1000000);
                        $('#map_canvas').gmap('option', 'center', latlng);
                    } else {
                        alert('Tên truy nhập hoặc mật khẩu không đúng');
                    }
                    hideToast();
                },  
                error: function (err) {
                    hideToast();
                    alert('Đăng nhập thất bại, hãy thử lại');
                    console.log(err);
                }
            });
        }
    });
});

jQuery(document).ready(function() {
	
    $('#map_canvas').gmap({
        'center': hanoi.destination,
        'mapTypeId': google.maps.MapTypeId.ROADMAP,
        'mapTypeControl': true,
        'mapTypeControlOptions': {
            'position': google.maps.ControlPosition.TOP_RIGHT,
            'style': google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        'zoom': 13,
        'zoomControl': true,
        'zoomControlOptions': {
            'position': google.maps.ControlPosition.TOP_LEFT,
            'style': google.maps.ZoomControlStyle.LARGE
        }
    }).bind("init", function (event, map) {
        fadingMsg('load map bound ok. trigger init event');
        window.setTimeout(function() {
            console.log('set timeout: ' + $('#login-token').val());            
            window.setInterval(function() {
                if ($('#login-status').val() !== 'yes') {
                    console.log('not login. can not request to server');
                    return false;
                } 
                else {
                    $.ajax({    
                        url: './map_functions.php?action=getLog',
                        type: 'POST',
                        data: {
                            token: $('#login-token').val()
                        },
                        success: function (jsonData) {
                            var data = $.parseJSON(jsonData);
                            console.log('request to server success' + jsonData);
                            if (data != null && data.status === 'success') {
                                console.log('status success');
                                markerRemain = data.requests.length;
                                addMarkers(data.requests); 
                            }
                        },
                        error: function (error) {
                            console.log('error ' + error);
                        }
                    });
                    console.log('request to server with token ' + $('#login-token').val());
                }
            }, 5000);
        }, 5000);
    });
});

function log(msg) {
    console.log(msg);
}

function fadingMsg(locMsg) {
    $("<div class='ui-overlay-shadow ui-body-e ui-corner-all fading-msg'>" + locMsg + "</div>").css({
        "display": "block",
        "opacity": 0.9,
        "top": $(window).scrollTop() + 100
    }).appendTo($('body')).delay(1500).fadeOut(1500, function () {
        $(this).remove();
    });
}

function showToast(locMsg) {
    $("<div id='toast' class='ui-overlay-shadow ui-body-e ui-corner-all fading-msg'>" 
            + locMsg + "</div>").css({
        "display": "block",
        "opacity": 0.9,
        "top": $(window).scrollTop() + 100
    }).appendTo($('body'));
}

function hideToast() {
    $('#toast').fadeOut(1500, function() {
        $(this).remove();
    });
}

function addMarkers(params) {
    if (markerRemain <= 0) return;
    var data = params[params.length - markerRemain];
    markerRemain--;
    log("create new marker at " + data.lat + ' ' + data.lon);
    var latlng = new google.maps.LatLng(data.lat / 1000000, data.lon / 1000000);
    
    $('#map_canvas').gmap('addMarker', {
        'position': latlng,
        'animation': google.maps.Animation.DROP,
        'bounds': true,
        'clickable': true,
        'draggable': false        
    }, function (map, marker) {
        var $map = $('#map_canvas');
        var position = marker.getPosition();
        var contentHTML = '<p>Loại xe: ' + data.loaitaxi + '</p>' 
                        + '<p>Hãng: ' + data.hangtaxi + '</p>'
                        + '<p>SĐT: ' + data.phonenumber + '</p>';
        $map.gmap('option', 'zoom', 13);
        var infowindow = new google.maps.InfoWindow({
            content: contentHTML
        });
        infowindow.open(map, marker);
        
        while (!($map.gmap('inViewport', marker))) {
            log("new marker not in viewport.");
            log("map center: " + map.getCenter().lat());
            log("marker position: " + marker.getPosition().lat());
            var zoom = $map.gmap('option', 'zoom');
            $map.gmap('option', 'zoom', zoom - 1);
        }
        addMarkers(params); // de quy ^^
                        
        setTimeout(function () {
            console.log('timeout after 5 minutes. delete marker');
            marker.setVisible(false);
            marker.setMap(null);
        }, 300000);
    })
    .dblclick(function() {
        console.log('marker double clicked');
        this.setVisible(false);
        this.setMap(null);  
    });
}

function checkMarkerInViewport() {
    var markers = $('#map_canvas').gmap('get', 'marker');
    for (var i = 0; i < markers.length; i++) {
        while (!($map.gmap('inViewport', marker))) {
            log("new marker not in viewport.");
            log("map center: " + map.getCenter().lat());
            log("marker position: " + marker.getPosition().lat());
            var zoom = $map.gmap('option', 'zoom');
            $map.gmap('option', 'zoom', zoom - 1);
        }
    }
}