var bright=false;
$(function(){setInterval(function(){if(bright){$("#hg, #wolken").css({"z-index":-1});
$("#hg1, #mond").css({opacity:0,"z-index":0}).animate({opacity:1},4000);}
else{$("#hg1, #mond").css({"z-index":-1});
$("#hg, #wolken").css({opacity:0,"z-index":0}).animate({opacity:1},4000);}
bright=!bright;},9000);});