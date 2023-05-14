$('#logout').live('pageinit' ,function(){
	$('#exit').live('click',function(){
		
		$.mobile.changePage("index.html");
	});

});