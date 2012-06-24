<div class="customers form">
<?php echo $form->create('Customer');?>
	<fieldset>
 		<legend><?php __('Add Customer');?></legend>
	<?php
		echo $form->input('last_name');
		echo $form->input('first_name');
		echo $form->input('company_name');
		echo $form->input('unit_number');
		echo $form->input('street_address');
		echo $form->input('suburb');
		echo $form->input('postcode');
		echo $form->input('state');
		echo $form->input('country');
		echo $form->input('email');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Customers', true), array('action' => 'index'));?></li>
	</ul>
</div>
