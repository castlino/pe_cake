// Javascript pricesengine_default.js


$(document).ready(function(){


});

    function AjaxApproveOrder(divStr, id2edit, isApprovedVal){
                  $('#'+divStr).html(
                             "<img src='/img/ajax-loader.gif'/>"
                           );

                  $.ajax({
                                  type: "POST",
                                  url: "/orders/approvalAjax",
                                  data: "data[Order][Id2Edit]="+id2edit+"&data[Order][isApproved]="+isApprovedVal,
                                  success: function(msg){
                                                            $('#'+divStr).html(msg);
                                                        }
                       });
    }
