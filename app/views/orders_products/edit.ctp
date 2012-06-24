<div class="ordersProducts form">
<?php echo $form->create('OrdersProduct');?>
	<fieldset>
 		<legend><?php __('Edit OrdersProduct');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('order_id');
		echo $form->input('product_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('OrdersProduct.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('OrdersProduct.id'))); ?></li>
		<li><?php echo $html->link(__('List OrdersProducts', true), array('action' => 'index'));?></li>
	</ul>
</div>
