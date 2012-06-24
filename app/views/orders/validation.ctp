<?php   echo $html->css('admindefault',null,null,false); ?>
<?php   echo $javascript->link('pricesengine_validationPage.js'); ?>
<?php if(!$orderId) {?>

	<?php echo $form->create('Order', array('action'=>'validation')); ?>
	<?php echo $form->input('Id2Edit', array('type'=>'hidden')); ?>
	<?php echo $form->input('ligthspeedOrderId', array('type'=>'hidden')); ?>
        <?php echo $form->input('searchString', array('type'=>'hidden')); ?>
	<?php echo $form->end(); ?>
	
	<div class="orders index">
	<h2><?php __('Orders Validation');?></h2>
        <div id="searchDiv" style="height: 50px;">
            <div style="height: 50px; float: left;"><input type="button" id="searchBtn" value="search" style="width: 100px; height: 35px; font-size: 12px;"></div>
            <div style="height: 50px; float: left; padding-left: 4px;"><input type="text" id="searchStr"   style="width: 200px; height: 25px;"/></div>
        </div>
	<p>
	<?php
	echo $paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></p>
        <div class="paging" style="margin-bottom: 5px;">
		<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $paginator->numbers();?>
		<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th class="actions"><?php __('Actions');?></th>
		<th><?php echo $paginator->sort('id');?></th>
		<th><?php echo $paginator->sort('lightspeed_orderid');?></th>
                <th><?php echo $paginator->sort('paypal_payerid');?></th>
		<th><?php echo $paginator->sort('shipping_name');?></th>
		<th><?php echo $paginator->sort('shipping_street_address');?></th>
		<th><?php echo $paginator->sort('shipping_suburb');?></th>
		<th><?php echo $paginator->sort('shipping_postcode');?></th>
		<th><?php echo $paginator->sort('shipping_state');?></th>
		<th><?php echo $paginator->sort('shipping_country');?></th>
		<th><?php echo $paginator->sort('shipping_email');?></th>
		<th><?php echo $paginator->sort('shipping_contact_number');?></th>
		<th><?php echo $paginator->sort('paypal_firstname');?></th>
		<th><?php echo $paginator->sort('paypal_lastname');?></th>
		<th><?php echo $paginator->sort('paypal_payerstatus');?></th>
                <th><?php echo $paginator->sort('paypal_surcharge');?></th>
                <th><?php echo $paginator->sort('shipping_charge');?></th>
		<th><?php echo $paginator->sort('product_quantity');?></th>
		<th><?php echo $paginator->sort('product_price');?></th>
		<th><?php echo $paginator->sort('product_model');?></th>
		<th><?php echo $paginator->sort('amount_paid');?></th>
		<th><?php echo $paginator->sort('invoice_number');?></th>
		<th><?php echo $paginator->sort('tracking_code');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($orders as $order):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
		<tr<?php echo $class;?>>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('action' => 'validation', $order['Order']['id'])); ?>
			</td>
			<td>
				<?php echo $order['Order']['id']; ?>
			</td>
			<td>
				<?php if(!$order['Order']['lightspeed_orderid']) {?>
				<?php 	echo "<input type='text' id='newlight".$order['Order']['id']."' style='width: 100px;'>"; ?>
				<?php 	//echo "<a href='#' type='Button' onClick='$(\"#OrderId2Edit\").val(".$order['Order']['id']."); $(\"#OrderLigthspeedOrderId\").val($(\"#newlight".$order['Order']['id']."\").val()); $(\"#OrderValidationForm\").submit();'>update</a>";  ?>
                                <?php 	echo "<a style='text-decoration: none; font-size: 0.8em; background: transparent;' href='#' type='Button' onClick='AjaxValidateLightspeed($(this), ".$order['Order']['id'].", $(\"#newlight".$order['Order']['id']."\").val());'>update</a>";  ?>
				<?php } else { ?>
				<?php echo $order['Order']['lightspeed_orderid']; ?>
                                        <img src="/img/b_edit.png" style="cursor: pointer;" onclick="MakeEditable($(this), '<?php echo $order['Order']['id']; ?>', '<?php echo $order['Order']['lightspeed_orderid']; ?>');" />

                                <?php }?>
			</td>
			<td>
				<?php echo $order['Order']['paypal_payerid']; ?>
			</td>
			<td>
				<?php echo $order['Order']['shipping_name']; ?>
			</td>
			<td>
				<?php echo $order['Order']['shipping_street_address1'].", ".$order['Order']['shipping_street_address2']; ?>
			</td>
			<td>
				<?php echo $order['Order']['shipping_suburb']; ?>
			</td>
			<td>
				<?php echo $order['Order']['shipping_postcode']; ?>
			</td>
			<td>
				<?php echo $order['Order']['shipping_state']; ?>
			</td>
			<td>
				<?php echo $order['Order']['shipping_country']; ?>
			</td>
			<td>
				<?php echo $order['Order']['shipping_email']; ?>
			</td>
			<td>
				<?php echo $order['Order']['shipping_contact_number']; ?>
			</td>
			<td>
				<?php echo $order['Order']['paypal_firstname']; ?>
			</td>
			<td>
				<?php echo $order['Order']['paypal_lastname']; ?>
			</td>
			<td>
				<?php echo $order['Order']['paypal_payerstatus']; ?>
			</td>
			<td>
				<?php echo number_format($order['Order']['paypal_surcharge'], 2); ?>
			</td>
			<td>
				<?php echo number_format($order['Order']['shipping_charge'], 2); ?>
			</td>
			<td>
				<?php echo $order['Product'][0]['OrdersProduct']['quantity']; ?>
			</td>
			<td>
				<?php echo number_format($order['Product'][0]['price'], 2); ?>
			</td>
			<td>
				<?php echo $order['Product'][0]['model']; ?>
			</td>
			<td>
				<?php echo number_format($order['Order']['amount_paid'], 2); ?>
			</td>
			<td>
				<?php echo $order['Order']['invoice_number']; ?>
			</td>		
			<td>
				<?php echo $order['Order']['tracking_code']; ?>
			</td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('action' => 'validation', $order['Order']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	</div>
	<div class="paging">
		<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $paginator->numbers();?>
		<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		</ul>
	</div>

	
<?php } else {?>
	
	<div class="orders view">
	<h2><?php  __('Order Validation View');?></h2>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Back to Validation List', true), array('action' => 'validation')); ?> </li>
			<li><?php //echo $html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		</ul>
	</div>
        <hr />
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['id']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Customer'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link($order['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lightspeed Orderid'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				
				<?php echo $order['Order']['lightspeed_orderid']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Company Name'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_company_name']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Unit Number'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_unit_number']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Name'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_name']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Street Address:'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				
				<?php echo $order['Order']['shipping_street_address']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Street Address2:'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				
				<?php echo $order['Order']['shipping_street_address2']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Suburb'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_suburb']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Postcode'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_postcode']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping State'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_state']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Country'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_country']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Email'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_email']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Contact Number'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				
				<?php echo $order['Order']['shipping_contact_number']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Method'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_method']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Payment Method'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['payment_method']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['currency']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ip Address'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['ip_address']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Firstname'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_firstname']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Lastname'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_lastname']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Transid'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_transid']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Payerid'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_payerid']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Payerstatus'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_payerstatus']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Transactiontype'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				
				<?php echo $order['Order']['paypal_transactiontype']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Paymenttype'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo $order['Order']['paypal_paymenttype']; ?>

			</dd>
                    <!-- ///////////////////////  -->
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Surcharge'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo number_format($order['Order']['paypal_surcharge'], 2); ?>

			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Surcharge'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo number_format($order['Order']['shipping_charge'], 2); ?>

			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product Quantity'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo $order['Product'][0]['OrdersProduct']['quantity']; ?>

			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product Price'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo number_format($order['Product'][0]['price'], 2); ?>

			</dd>
                        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product Model'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo $order['Product'][0]['model']; ?>

			</dd>
                        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount Paid'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo number_format($order['Order']['amount_paid'], 2); ?>

			</dd>
                     <!-- ///////////////////////  -->
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Packed'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				
				<?php echo $order['Order']['is_packed']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Dispatched'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['is_dispatched']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Invoice Number'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['invoice_number']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tracking Code'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['tracking_code']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['created']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['modified']; ?>
				
			</dd>
		</dl>
	</div>
        <hr />
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Back to Validation List', true), array('action' => 'validation')); ?> </li>
			<li><?php //echo $html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		</ul>
	</div>



<?php }?>

<script type="text/javascript">

    function MakeEditable(jqObj, orderId, currVal){
        temp = "<img src=\"/img/b_edit.png\" style=\"cursor: pointer;\" onclick=\" MakeEditable($(this), \\\'"+orderId+"\\\', \\\'"+currVal+"\\\'); \" /> ";
        //alert(temp);
        jqObj.parent().html(
                                 "<input type='text' id='newlight"+orderId+"' style='width: 100px;' value='"+currVal+"' /> "
                                //+"<a href='#' type='Button' onClick='$(\"#OrderId2Edit\").val("+orderId+"); $(\"#OrderLigthspeedOrderId\").val($(\"#newlight"+orderId+"\").val()); $(\"#OrderValidationForm\").submit();'>update</a> "
                                +"<a style='text-decoration: none; font-size: 0.8em; background: transparent;' href='#' type='Button' onClick='AjaxValidateLightspeed($(this), "+orderId+", $(\"#newlight"+orderId+"\").val());'>update</a> &nbsp "
                                +"<a style='text-decoration: none; font-size: 0.8em; background: transparent;' href='#' type='Button' onClick=' MakeUneditable($(this),\""+orderId+"\",\""+currVal+"\"); ' >cancel</a> "

                            );
    }
    function MakeUneditable(jqObj, orderId, currVal){
        jqObj.parent().html(
                                currVal +" <img src='/img/b_edit.png' style='cursor: pointer;' onclick='MakeEditable($(this), \""+orderId+"\", \""+currVal+"\");' />"
                        );
    }
</script>