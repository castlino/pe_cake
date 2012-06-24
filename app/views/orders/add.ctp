<div class="orders form">
<?php echo $form->create('Order');?>
	<fieldset>
 		<legend><?php __('Add Order');?></legend>
	<?php
		echo $form->input('customer_id');
		echo $form->input('shipping_company_name');
		echo $form->input('shipping_unit_number');
		echo $form->input('shipping_street_address');
		echo $form->input('shipping_suburb');
		echo $form->input('shipping_postcode');
		echo $form->input('shipping_state');
		echo $form->input('shipping_country');
		echo $form->input('shipping_email');
		echo $form->input('shipping_method');
		echo $form->input('payment_method');
		echo $form->input('currency');
		echo $form->input('ip_address');
		echo $form->input('paypal_transid');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Orders', true), array('action' => 'index'));?></li>
	</ul>
</div>
