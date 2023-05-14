var width = 0;
var height = 0;
// page-map
$('#page-map').live("pageinit", function() {
    width = screen.width;
	height = screen.height;
	console.log('width_page', width);
	$('#page-home').attr('style', 'height:' + height + 'px;');
	$('.div_call img').css({width: width*0.50 + 'px'});
	$('.div_refresh img').css({width: width*0.50 + 'px'});
	$('.logo img').css({width: width*0.45 + 'px'}, {height: width*0.45 + 'px'});
	$('#function img').css({width: width*0.35 + 'px'});
	$('#function div').css({margin: '0 ' + width*0.01 + 'px ' + width*0.01 + 'px ' +  width*0.01 + 'px'});
	$('#content').css({margin: '0 ' + width*0.085 + 'px ' + '0 ' +  width*0.085 + 'px'});
});
