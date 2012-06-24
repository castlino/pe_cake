// Javascript pricesengine_products.js


$(document).ready(function(){

    //$(".checkBoxIsActive").click(function(){
        //alert('testing...');

        //$('.checkBoxIsActive').attr('checked', false);
        //$(this).attr('checked', true);


    //});

    $('.checkBoxIsMain').click(function(){
                                    var currMainId = $(this).attr('id');
                                    $.ajax({
                                                type: "POST",
                                                url: "/products/setMainProduct",
                                                data: "data[Product][checkBoxIsMain_id]="+currMainId,
                                                success: function(msg){
                                                                        $('#ajaxNotifyDiv').html(msg);
                                                                        $('#ajaxNotifyDiv').show("slow");
                                                                        $('#ajaxNotifyDiv').hide(8000);
                                                            },
                                                beforeSend: function(XMLHttpRequest){
                                                                        $('.checkBoxIsMain').attr('checked', false);
                                                                        $('#'+currMainId).attr('checked', true);
                                                            }

                                                });
    });

    $('.checkBoxIsActive').click(function(){
                                    var currActiveId = $(this).attr('id');
                                    var val;
                                    if($(this).attr('checked')){
                                        val = "/products/activateProduct/1";
                                    }else{
                                        val = "/products/activateProduct/0";
                                    }
                                    $.ajax({
                                                type: "POST",
                                                url: val,
                                                data: "data[Product][checkBoxIsActive_id]="+currActiveId,
                                                success: function(msg){
                                                                        $('#ajaxNotifyDiv').html(msg);
                                                                        $('#ajaxNotifyDiv').show("slow");
                                                                        $('#ajaxNotifyDiv').hide(8000);
                                                            }
                                                });
    });
    





});

function UpdateUploadDivImage(){
            $('#imgview1').html("<img src='../img/bigimageloader.gif' />");
            $('#ProductAddForm').ajaxSubmit({target: '#imgview1', url: '/products/uploadImage', success: function(){}  });
}

