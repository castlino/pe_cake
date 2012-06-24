// Javascript pricesengine_default.js


$(document).ready(function() {
    // Start for Countdown timer.
        $('#countdown_dashboard').data('omitWeeks', true);

   // Start for other effects.
        setMOver();
	$(".tabButton").attr("style", "list-style-type:none; float:left; height: 90px; background: transparent no-repeat center bottom;");


});

function setMOver(){
    	$("#tbMenuDiv1").mouseover(function(){
		$("#tbMenu1").attr("style", "list-style-type:none; float:left; height: 80px; background: transparent url(/img/buttonshadow.png) no-repeat center bottom;");
		//alert('adsf');
	});
	$("#tbMenuDiv1").mouseout(function(){
		$("#tbMenu1").attr("style", "list-style-type:none; float:left; height: 80px; background: transparent no-repeat center bottom;");
	});


        $("#tbMenuDiv2").mouseover(function(){
		$("#tbMenu2").attr("style", "list-style-type:none; float:left; height: 80px; background: transparent url(/img/buttonshadow.png) no-repeat center bottom;");
		//alert('adsf');
	});
	$("#tbMenuDiv2").mouseout(function(){
		$("#tbMenu2").attr("style", "list-style-type:none; float:left; height: 80px; background: transparent no-repeat center bottom;");
	});


        $("#tbMenuDiv3").mouseover(function(){
		$("#tbMenu3").attr("style", "list-style-type:none; float:left; height: 80px; background: transparent url(/img/buttonshadow.png) no-repeat center bottom;");
		//alert('adsf');
	});
	$("#tbMenuDiv3").mouseout(function(){
		$("#tbMenu3").attr("style", "list-style-type:none; float:left; height: 80px; background: transparent no-repeat center bottom;");
	});



}
