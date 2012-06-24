<div class="ordersProducts form">
<?php echo $form->create('OrdersProduct');?>
	<fieldset>
 		<legend><?php __('Add OrdersProduct');?></legend>
	<?php
		echo $form->input('order_id');
		echo $form->input('product_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List OrdersProducts', true), array('action' => 'index'));?></li>
	</ul>
</div>
