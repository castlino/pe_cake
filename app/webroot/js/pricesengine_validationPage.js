// Javascript pricesengine_default.js


$(document).ready(function(){
    $("#searchBtn").click(function(){
        $("#OrderSearchString").val($("#searchStr").val());
        $("#OrderValidationForm").submit();
    });

});

    function AjaxValidateLightspeed(divObj, id2edit, lightspeedId){
                  var pObj = divObj.parent();
                  pObj.html(
                                         "<span id='orderDet"+id2edit+"'><img src='/img/ajax-loader.gif'/></span> "
                                        +"<img src='/img/b_edit.png' "
                                        +" style='cursor: pointer;' onclick='MakeEditable($(this), "+id2edit+", "+lightspeedId+");' />"
                                );

                  $.ajax({
                                  type: "POST",
                                  url: "/orders/validationAjax",
                                  data: "data[Order][Id2Edit]="+id2edit+"&data[Order][ligthspeedOrderId]="+lightspeedId,
                                  success: function(msg){
                                                            $('#orderDet'+id2edit).html(msg);
                                                        }
                       });
    }
