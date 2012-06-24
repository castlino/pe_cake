// Javascript pricesengine_ordersShipping.js


$(document).ready(function(){
	
	//$(".TestRabbit").keydown(checkForEnter);
	initInputs();
	
});

function initInputs() {
    	$(".invoiceRabbit").keydown(function(event){
		if(event.keyCode == 13){							//Filter ENTER key.
                        AjaxSendInvoiceNumber($(this), $(this).attr('id'), $(this).val());
			return false;
		}
	});

	$(".trackingRat").keydown(function(event){
		if(event.keyCode == 13){							//Filter ENTER key.
                        AjaxSendTrackingCode($(this), $(this).attr('id'), $(this).val());
			return false;
		}
	});
}

function checkForEnter(event){
	if(event.keyCode == 13){
		return 1;
	}
	return 0;
}

function AjaxSendInvoiceNumber(divObj, id2edit, invoiceNumber){
                  var pObj = divObj.parent();
                  startStrId = id2edit.search("_");
                  var idEdit = id2edit.substr(startStrId+1, id2edit.length-startStrId);
                  pObj.html(
                                 "<span id='orderDet"+id2edit+"'><img src='/img/ajax-loader.gif'/></span> "
                         );
                  

                  $.ajax({
                                  type: "POST",
                                  url: "/orders/shippingAjax",
                                  data: "data[Order][Id2Edit]="+id2edit+"&data[Order][invoiceNumber]="+invoiceNumber,
                                  success: function(msg){
                                                            pObj.html(msg);
                                                            $("#trackingcodeDiv_"+idEdit).html("<input type='text' class='trackingRat' id='trackingRat_"+idEdit+"' style='width: 160px;' />");
                                                            //$("#trackingRat_"+idEdit).focus();
                                                            $("#row_"+idEdit+" + tr td + td .invoiceRabbit").focus();
                                                            $(".trackingRat").keydown(function(event){
                                                                    if(event.keyCode == 13){							//Filter ENTER key.
                                                                            AjaxSendTrackingCode($(this), $(this).attr('id'), $(this).val());
                                                                            return false;
                                                                    }
                                                            });

                                                        }
                       });
}

function AjaxSendTrackingCode(divObj, id2edit, trackingCode){
                  var pObj = divObj.parent();
                  startStrId = id2edit.search("_");
                  var idEdit = id2edit.substr(startStrId+1, id2edit.length-startStrId);
                  pObj.html(
                                 "<span id='orderDet"+id2edit+"'><img src='/img/ajax-loader.gif'/></span> "
                         );


                  $.ajax({
                                  type: "POST",
                                  url: "/orders/shippingAjax",
                                  data: "data[Order][Id2Edit]="+id2edit+"&data[Order][trackingCode]="+trackingCode,
                                  success: function(msg){
                                                            $("#row_"+idEdit).html("<td colspan='14' style='background-color: #90f490;'>"+msg+"</td>");
                                                            setTimeout('$("#row_'+idEdit+'").hide()', 1000);
                                                            $("#row_"+idEdit+" + tr td + td + td .trackingRat").focus();
                                                            
                                                        }
                       });
}


