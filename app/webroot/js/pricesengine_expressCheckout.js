// Javascript pricesengine_default.js


$(document).ready(function(){


});

    function AjaxDeclinePaymentConfirm(){
                  $.ajax({
                                  type: "POST",
                                  url: "/orders/declinePaymentConfirmAjax",
                                  data: "",
                                  success: function(msg){
                                                            alert(msg);
                                                        }
                       });
    }