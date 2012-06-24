// Javascript pricesengine_products.js


$(document).ready(function(){
    $("#ProductDate").datepicker({dateFormat: 'yy-mm-dd' });

    $('#ProductDate').keydown(function(event) {
		// Allow only mouse click...
		event.preventDefault();
	});
});
