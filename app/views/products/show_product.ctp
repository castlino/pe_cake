
<?php echo $javascript->link('pricesengine_showProduct.js'); ?>
<?php //echo $javascript->link('jquery-ui-1.8.custom.min'); ?>

<div id="wrapperImgInp">
    <div id="imgCurrentViewDiv" class="wraptocenter">
           <span></span>
    <?php
            //echo $html->image('product_images/p2_img00001.jpg');
            echo $html->image('product_images/'.$productDetails['Product']['imageview_3'], array('id'=>'currentViewImg'));
    ?>
    </div>

    <div id="compactInputDiv" class="radius">
            <?php if($productDetails['Product']['no_shippingcharge']==1){ ?>
            <div id="shippingInputFillerDiv">
            </div>
            <?php } ?>
            <div id="checkoutInputDiv" class="radius">
                    <span class="compactValue">$<?php echo number_format($productDetails['Product']['price'],2,'.',','); ?></span>
                    <?php echo $form->input('quantity_dummy', array('style'=>'text-align: center;', 'label' => false, 'type'=>'text', 'value'=>'EXPIRED', 'disabled'=>'true', 'class'=>'quantity-text radius')); ?>
                    <a href='#goCheckout'>
                        <img src='https://www.paypal.com/en_AU/AU/i/btn/btn_xpressCheckout.gif'
                             onClick='alert("This deal is not anymore active...");'
                             alt="Click here to pay via PayPal Express Checkout"
                           />
                    </a>
            </div>
            <?php if($productDetails['Product']['no_shippingcharge']!=1){ ?>
            <div id="shippingInputDiv" class="radius">
                    <span class="compactValue">Shipping Calculator</span>
                    <div id="shippingEstimateDiv">
                        <?php echo $form->input('postcode_dummy', array('label' => false, 'type'=>'text', 'maxlength'=>'4', 'value'=>'postcode', 'class'=>'postcode-text radius')); ?>
                    </div>

                        <a id="shippingButton" href='#getShipping'>
                            <img src='/img/shippingcheck.png'
                             onClick="AjaxGetShippingEstimate();"
                             alt="Check"
                            />
                        </a>

            </div>
            <?php } ?>
    </div>


</div>

<!--
<div id='formInputDiv' >
<div id='formInsideQty' >
            <label style='margin-left: 20px; color: red; font-family: fantasy; font-size: smaller; font-weight: bold; margin-bottom: -6px;'>QUANTITY</label>
            <?php echo $form->input('quantity_dummy', array('label' => false, 'type'=>'text', 'value'=>'1', 'class'=>'quantity-text radius')); ?>
</div>
<div id='formInsidePaypal' >
            <?php // echo "<a href='#dummyA'><img src='https://www.paypal.com/en_AU/AU/i/btn/btn_xpressCheckout.gif' onClick='$(\"#OrderQuantity\").attr(\"value\", $(\"#quantity_dummy\").val()); $(\"#OrderExpressCheckoutForm\").submit();' alt=\"Click here to pay via PayPal Express Checkout\" /></a>"; ?>
            <a href='#dummyA'>
                <img src='https://www.paypal.com/en_AU/AU/i/btn/btn_xpressCheckout.gif'
                     onClick='if($("#quantity_dummy").val()=="" || $("#quantity_dummy").val()<1){alert("Please specify a quantity..."); return false;} $("#OrderQuantity").attr("value", $("#quantity_dummy").val()); $("#OrderExpressCheckoutForm").submit();'
                     alt="Click here to pay via PayPal Express Checkout"
                   />
            </a>
            <div id="priceDiv">
                <span class="peLabel">atPrice:</span> <span class="peValue">AUD $<?php echo number_format($productDetails['Product']['price'],2,'.',','); ?></span>
            </div>
</div>
</div>
-->


<div id="imgListDiv">
    <div id="imgWrapper">
        <?php for($xCtr=1; $xCtr<6; $xCtr++) {?>
        <div class="imglistClass wraptocenter">
		<span></span>
            <?php  echo $html->image('product_images/'.$productDetails['Product']['imageview_'.$xCtr]);  ?>
        </div>
        <?php } ?>
    </div>
</div>


<div id='productDetailsDiv'>
    <div id='productDetailsWrapper' class="radius">
        <?php echo "<div class='detailLabel'><strong>Model name:</strong></div>      <div class='detailVal'>".$productDetails['Product']['model']."</div>"; ?>
        <?php echo "<div class='detailLabel'><strong>Manufactured by:</strong></div> <div class='detailVal'>".$productDetails['Product']['manufacturer']."</div>"; ?>
        <?php echo "<div class='detailLabel'><strong>Specifications:</strong></div>   <div class='detailVal'>".$productDetails['Product']['description']."</div>"; ?>
    </div>
    <!--
        <?php echo "Pcnt: ".$productDetails['Product']['stock']; ?>
    -->
</div>
<script type="text/javascript">

    $(document).ready(function(){
    });

</script>

