// Javascript pricesengine_default.js


$(document).ready(function(){
	
	$(".imglistClass").click(function(){
		$("#currentViewImg").attr("src", $("img", this).attr('src'));
	});

        bindToPostcodeButton();

	var $scrollingDiv = $("#compactInputDiv");

	// Initiate location of div to its current position to avoid initial movement on start of animation.
	offPos = $scrollingDiv.offset();
	//$('#compactInputDiv').attr('style', "margin-top: 0; margin-left: 0; position: absolute; top: 330px; left: "+offPos.left+"px;");
	$('#compactInputDiv').attr('style', "margin-top: 0; margin-left: 0; position: fixed; top: 250px; left: "+offPos.left+"px;");
	tp = $('#pe_content').position();
	//$scrollingDiv.animate({"left": (tp.left+800) + "px"}, "slow");
	$scrollingDiv.css('left',(tp.left+800) + 'px');

	// Animate div on browser scrolling.. 
	//$(window).scroll(function(){			
        //			$scrollingDiv
        //			.stop()
	//			.animate({"top": ($(window).scrollTop() + 330) + "px"}, "slow" );
	//});

	// Animate div on browser resizing.
	$(window).resize(function(){			
		p = $('#pe_content');
		pos = p.position();
			$scrollingDiv
				.stop()
				//.animate({"left": (pos.left + 800) + "px"}, "slow" );
				.css('left', (pos.left+800) + 'px');
	});

	//$('#compactInputDiv').click(function(){
	//	p = $(this).offset();
	//	alert(p.left);
	//});


});

    function AjaxGetShippingEstimate(){
                  $.ajax({
                                  type: "POST",
                                  url: "/orders/getShippingEstimate/"+$("#OrderProductID").val(),
                                  data: "data[Order][postcode]="+$("#postcode_dummy").val(),
                                  success: function(msg){
                                                          // Expecting a string similar to: "success|[N]", where [N] is any number greater than 0.
                                                            strTemp = msg;
                                                            strTemp = strTemp.replace(/^\s+/,"");   //trim left
                                                            strTemp = strTemp.replace(/\s+$/,"");   //trim right.
                                                            $("#shippingEstimateDiv").html(strTemp);

                                                            $("#shippingButton").html(
                                                                "<img src='/img/shippingrecheck.png' onClick='ResetShippingCalculator();' alt='Recheck'/>"
                                                                );
                                                        }
                       });
    }

    function ResetShippingCalculator(){
        $("#shippingEstimateDiv").html("<input id='postcode_dummy' type='text' maxlength='4' value='postcode' class='postcode-text radius' >");
        $("#shippingButton").html("<img src='/img/shippingcheck.png' onClick='AjaxGetShippingEstimate();' alt='Check'/>");
        bindToPostcodeButton();
    }

    function bindToPostcodeButton(){
        $("#postcode_dummy").keydown(function(event) {
		// Allow only backspace and delete
		if ( event.keyCode == 46 || event.keyCode == 8 ) {
			// let it happen, don't do anything
		}
		else {
			// Ensure that it is a number and stop the keypress
			if (
                            !(
                                (event.keyCode > 47 && event.keyCode < 58)
                                    || (event.keyCode > 95 && event.keyCode < 106)
                            ))
                        {
                                    event.preventDefault();
                        }
		}
	});

        $("#postcode_dummy").click(function(){
                if($(this).val()=="postcode"){
                    $(this).val("");
                }
        });
        $("#postcode_dummy").focusout(function(){
                if($(this).val()==""){
                    $(this).val("postcode");
                }
        });
    }
