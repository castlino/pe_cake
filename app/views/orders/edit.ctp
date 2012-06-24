<div class="orders form">
<?php echo $form->create('Order');?>
	<fieldset>
 		<legend><?php __('Edit Order');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('customer_id');
		echo $form->input('lightspeed_orderid');
		echo $form->input('shipping_company_name');
		echo $form->input('shipping_unit_number');
		echo $form->input('shipping_name');
		echo $form->input('shipping_street_address');
		echo $form->input('shipping_street_address2');
		echo $form->input('shipping_suburb');
		echo $form->input('shipping_postcode');
		echo $form->input('shipping_state');
		echo $form->input('shipping_country');
		echo $form->input('shipping_email');
		echo $form->input('shipping_contact_number');
		echo $form->input('shipping_method');
		echo $form->input('payment_method');
		echo $form->input('currency');
		echo $form->input('ip_address');
		echo $form->input('paypal_firstname');
		echo $form->input('paypal_lastname');
		echo $form->input('paypal_transid');
		echo $form->input('paypal_payerid');
		echo $form->input('paypal_payerstatus');
		echo $form->input('paypal_transactiontype');
		echo $form->input('paypal_paymenttype');
		echo $form->input('is_packed');
		echo $form->input('is_dispatched');
		echo $form->input('invoice_number');
		echo $form->input('tracking_code');
		echo $form->input('Product');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Order.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Order.id'))); ?></li>
		<li><?php echo $html->link(__('List Orders', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Customers', true), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Customer', true), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
