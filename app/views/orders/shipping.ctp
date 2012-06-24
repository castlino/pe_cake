
<?php echo $javascript->link('pricesengine_ordersShipping.js'); ?>
<?php echo $html->css('admindefault',null,null,false); ?>

<script type="text/javascript">

$(document).ready(function(){

	//$('#<?php echo $nextFocus; ?>').focus();

});

</script>

<?php if(!$orderId) {?>

	<?php echo $form->create('Order', array('action'=>'shipping')); ?>
	<?php echo $form->input('Id2Edit', array('type'=>'hidden', 'value'=>'')); ?>
	<?php echo $form->input('isPacked', array('type'=>'hidden', 'value'=>'')); ?>
	<?php echo $form->input('isDispatched', array('type'=>'hidden', 'value'=>'')); ?>
	
	<?php echo $form->input('invoiceNumber', array('type'=>'hidden', 'value'=>'')); ?>
	<?php echo $form->input('trackingCode', array('type'=>'hidden', 'value'=>'')); ?>
	<?php echo $form->end(); ?>
	
	<div class="orders index">
	<h2><?php __('Shipping');?></h2>
	<p>
	<?php
	echo $paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></p>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $paginator->sort('id');?></th>
<!-- 		<th><?php echo $paginator->sort('is_packed');?></th>            -->
<!--		<th><?php echo $paginator->sort('is_dispatched');?></th>        -->
		<th><?php echo $paginator->sort('invoice_number');?></th>
		<th><?php echo $paginator->sort('tracking_code');?></th>
		<th><?php echo $paginator->sort('lightspeed_orderid');?></th>
		<th><?php echo $paginator->sort('shipping_name');?></th>
		<th><?php echo $paginator->sort('shipping_street_address');?></th>
		<th><?php echo $paginator->sort('shipping_street_address2');?></th>
		<th><?php echo $paginator->sort('shipping_suburb');?></th>
		<th><?php echo $paginator->sort('shipping_postcode');?></th>
		<th><?php echo $paginator->sort('shipping_state');?></th>
		<th><?php echo $paginator->sort('shipping_email');?></th>
		<th><?php echo $paginator->sort('shipping_contact_number');?></th>
		<th><?php echo $paginator->sort('Purchase Date');?></th>
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
                    <tr<?php echo $class;?> id="row_<?php echo $order['Order']['id']; ?>" >
			<td>
				<?php echo $order['Order']['id']; ?>
			</td>
<!--
			<td>
				<?php if($order['Order']['is_packed']==0){ ?>
					<div style='width:100px;'><input type="button" value="Pack" onClick="$('#OrderId2Edit').val(<?php echo $order['Order']['id']; ?>); $('#OrderIsPacked').val(1); $('#OrderShippingForm').submit();" /></div>
				<?php } else { ?>
					<div style='width:100px;'><i>Packed</i></div>
				<?php } ?>
			</td>
			<td>
				<?php if($order['Order']['is_dispatched']==0){ ?>
					<div style='width:100px;'><input type="button" value="Dispatch" onClick="$('#OrderId2Edit').val(<?php echo $order['Order']['id']; ?>); $('#OrderIsDispatched').val(1); $('#OrderShippingForm').submit();" /></div>
				<?php } else { ?>
					<div style='width:100px;'><i>Dispatched</i></div>
				<?php } ?>
			</td>
-->
			<td>
                                <div id="orderidDiv_<?php echo $order['Order']['id']; ?>" style='width:200px;'>
                                    <?php if(!$order['Order']['invoice_number']){ ?>
                                            <input type='text' class='invoiceRabbit' id='invoiceRabbit_<?php echo $order['Order']['id']; ?>' style='width: 160px;' />
                                    <?php } else { ?>
                                    <?php echo $order['Order']['invoice_number']; } ?>
                                </div>
			</td>		
			<td>
                                <div id="trackingcodeDiv_<?php echo $order['Order']['id']; ?>" style='width:200px;'>
                                    <?php if(!$order['Order']['tracking_code']){ ?>

                                                    <?php if($order['Order']['invoice_number'] == NULL) {?>
                                                        <i>(no invoice# yet)</i>
                                                    <?php } else { ?>
                                                        <input type='text' class='trackingRat' id='trackingRat_<?php echo $order['Order']['id']; ?>' style='width: 160px;' />
                                                    <?php }        ?>
                                    <?php } else { ?>
                                    <?php echo $order['Order']['tracking_code']; } ?>
                                </div>
			</td>			
			<td>
				<?php echo $order['Order']['lightspeed_orderid']; ?>
			</td>
			<td>
				<?php echo $order['Order']['shipping_name']; ?>
			</td>
			<td>
				<?php echo $order['Order']['shipping_street_address1']; ?>
			</td>
			<td>
				<?php echo $order['Order']['shipping_street_address2']; ?>
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
				<?php echo $order['Order']['shipping_email']; ?>
			</td>
			<td>
				<?php echo $order['Order']['shipping_contact_number']; ?>
			</td>
			<td>
				<?php echo $order['Order']['created']; ?>
			</td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('action' => 'shipping', $order['Order']['id'])); ?>
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
	<h2><?php  __('Shipping View');?></h2>
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['id']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Packed'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $order['Order']['is_packed']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Dispatched'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['is_dispatched']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Invoice Number'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['invoice_number']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tracking Code'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['tracking_code']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Customer'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link($order['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lightspeed Orderid'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				&nbsp;&nbsp;&nbsp;
				<?php echo $order['Order']['lightspeed_orderid']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Company Name'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_company_name']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Unit Number'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_unit_number']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Name'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_name']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Street Address:'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $order['Order']['shipping_street_address']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Street Address2:'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $order['Order']['shipping_street_address2']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Suburb'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_suburb']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Postcode'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_postcode']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping State'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_state']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Country'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_country']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Email'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_email']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Contact Number'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $order['Order']['shipping_contact_number']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Method'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_method']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Payment Method'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['payment_method']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['currency']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ip Address'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['ip_address']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Firstname'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_firstname']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Lastname'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_lastname']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Transid'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_transid']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Payerid'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_payerid']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Payerstatus'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_payerstatus']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Transactiontype'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $order['Order']['paypal_transactiontype']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Paymenttype'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $order['Order']['paypal_paymenttype']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['created']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['modified']; ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Back to Shipping List', true), array('action' => 'shipping')); ?> </li>
			<li><?php //echo $html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		</ul>
	</div>



<?php }?>
