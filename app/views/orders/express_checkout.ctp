<?php echo $html->css('expresscheckout',null,null,false); ?>
<?php echo $javascript->link('pricesengine_expressCheckout.js'); ?>


<?php
      
      $payStat = isset($result3["PAYMENTSTATUS"]) ? $result3["PAYMENTSTATUS"] : "";
      if($payStat=="Completed")
      {
?>
                <div id='thankYouDiv'>
                    <p>Thank you</p>
                </div>
                <div id='PayCompDiv'>
                    <span id='SuccessSpan'>Purchase payment confirmed. Thank you for shopping with us...</span>
                </div>

<?php
      }
      else
      {  // START Of Payment Confirmation Page
              if($error!=NULL)
              {
?>
                <div id='thankYouDiv'>
                    <p>Ooops!</p>
                </div>
                <div id='PayCompDiv'>
                    <span id='SuccessSpan'>Session expired...<br /> Please check your paypal account or contact customer service. <br /> service@pricesengine.com</span>
                </div>
<?php
              }else{

?>
                <div id="paymentcountdownDiv">
                        <div id="countdown_dashboard">
                                <div id="timeLabel">Time to Confirm</div>
                                <div class="dash minutes_dash">
                                        <div class="digit" >0</div>
                                        <div class="digit">0</div>
                                </div>
                                <div class="dash separator">
                                        <span>:</span>
                                </div>
                                <div class="dash seconds_dash">
                                        <div class="digit" >0</div>
                                        <div class="digit">0</div>
                                </div>
                                <div class="dash separator">
                                        <span>:</span>
                                </div>
                                <div class="dash milliseconds_dash">
                                    <div class="digit" >00</div>
                                </div>
                        </div>
                        <div id="countdownNoteDiv">
                                
                        </div>
                </div>
                <div id="confMain" class="radiusWide">
                    <div class="infoDiv">
                        <label class="infolabel">Reciever Information</label>
                        <div class="details recieverDetails ">
                            <span class="iLabel">Name: </span>
                            <div class="iValue">
                                   <?php echo $result['SHIPTONAME']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="infoDiv">
                        <label class="infolabel">Shipping Information</label>
                        <div class="details shippingDetails radius">
                            <span class="iLabel">Address: </span>
                            <div class="iValue">
                                   <?php
                                        echo $result['SHIPTOSTREET']." ".$result['SHIPTOSTREET2'].", <br />".
                                             $result['SHIPTOCITY'].", <br />".
                                             $result['SHIPTOSTATE']." ".$result['SHIPTOZIP'].", <br />".
                                             $result['SHIPTOCOUNTRYNAME'];
                                   ?>
                            </div>
                        </div>
                    </div>
                    <div class="infoDiv">
                        <label class="infolabel">Contact Information</label>
                        <div class="details contactDetails radius">
                            <span class="iLabel">Email: </span>
                            <div class="iValue">
                                   <?php echo $result['EMAIL']; ?>
                            </div>
                            <br />
                            <span class="iLabel">Phone Number: </span>
                            <div class="iValue">
                                   <?php echo $result['PHONENUM']; ?>
                            </div>
                            <!--
                            <span class="iLabel" style="clear: left;">Preffered Contact Number: </span>
                            <div class="iValue" style="clear: left;">
                                <?php echo $form->input('telephone_dummy', array('label' => false, 'type'=>'text', 'value'=>'', 'class'=>'telephone-text radius')); ?>
                            </div>
                            -->
                        </div>
                    </div>
                    <div class="infoDiv">
                        <label class="infolabel">Transaction Information</label>
                        <div class="details transactionDetails radius">
                            <span class="iLabel">Item Description: </span>
                                 <div class="iValue">
                                   <?php echo "[".$result['PRODUCTMANUFACTURER']."] ".$result['PRODUCTMODEL']; ?>
                                </div>
                            <span class="iLabel">Item Price: </span>
                            <span class="iAmtValue">
                                   <?php echo $result['ORDERITEMPRICE']." (".$result['ORDERITEMQTY'].")"; ?>
                            </span>
                            <br />
                            <span class="iLabel">Shipping Charge: </span>
                            <span class="iAmtValue">
                                   <?php echo $result['ORDERSHIPPING']; ?>
                            </span>
                            <br />
                            <span class="iLabel">Paypal Sucharge: </span>
                            <span class="iAmtValue">
                                   <?php echo $result['PAYPALSURCHARGE']; ?>
                            </span>
                            <hr style="width:260px;"/>
                            <span class="iLabel">Total Price: </span>
                            <span class="iAmtValue">
                                   <?php echo $result['ORDERTOTAL']; ?>
                            </span>
                        </div>
                    </div>
                    <div class="noteDiv">
                        <label class="infolabel">
                            Please make sure your Paypal account is <span class="highlight">Verified</span> or get it <span class="highlight">Verified</span> soon.
                            We <span class="highlight">ONLY</span> accept payment from <span class="highlight">Verified</span> Paypal account.
                        </label>
                    </div>

                </div>

                <div id="cancelDiv">
                   <a href='#dummyA' onClick="$('#CancelForm').submit();">
                       Cancel
                   </a>
                </div>
                <div id="submitDiv">
<?php if($isPaymentValid){  ?>
                   <a href='#dummyA' onClick="$('#OrderShippingContactNumber').attr('value', $('#telephone_dummy').val()); $('#expressCheckoutForm').submit();">
                       Confirm
                   </a>
<?php }else{ ?>
                   <a href='#dummyA' onClick="$('#CancelForm').submit();" style="color: #FFaaaa;" >
                       Timed out
                   </a>
<?php } ?>
                </div>
<script type="text/javascript">
    $(document).ready(function(){
        if(<?php echo $isPaymentValid; ?>==1)
        {
            $('#countdown_dashboard').countDown({
                                                targetOffset: {'day': 0,'month': 0,'year': 0,'hour': 0,'min': 2,'sec': 1},
                                                //onComplete: function (){ alert('2 minutes is over...'); }
                                                onComplete: function (){
                                                     $('#submitDiv').html(
                                                                '<a href="#dummyA" style="color: #FFaaaa;" onClick="$(\'#CancelForm\').submit();">Timed out</a>'
                                                     );
                                                     AjaxDeclinePaymentConfirm();
                                                }
                                            }
                                        );
        }

        $("#countdownNoteDiv").fadeIn('slow');
        $("#countdown_dashboard").mouseover(function(){
                                            if(!$("#countdownNoteDiv").is(':visible')){
                                                $("#countdownNoteDiv").fadeIn('slow'); setTimeout("hideCountdownNote()", 5000);
                                            }
                                        }
                                    );
        setTimeout("hideCountdownNote()", 5000);
        
    });

    function hideCountdownNote(){
         $("#countdownNoteDiv").fadeOut('slow');
    }
</script>
<?php
              }
	 	echo $form->create('Order', array('action'=>'expressCheckout/3', 'id'=>'expressCheckoutForm'));
	 	echo $form->input('shipping_contact_number', array('type'=>'hidden'));
	 	echo $form->end();

	 	echo $form->create('Order', array('action'=>'cancelPurchase', 'id'=>'CancelForm'));
	 	echo $form->input('shipping_contact_number', array('type'=>'hidden'));
	 	echo $form->end();
      }     // END Of Payment Confirmation Page

 ?>
