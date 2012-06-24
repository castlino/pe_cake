<?php echo $html->css('jquery-ui-1.8.2.custom',null,null,false); ?>
<?php echo $javascript->link("jquery-ui-1.8.2.custom.min.js"); ?>
<?php echo $javascript->link("pricesengine_editProducts.js"); ?>

<div class="products form">
<?php echo $form->create('Product');?>
<div class="actions">
	<ul>
		<!-- <li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Product.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Product.id'))); ?></li> -->
		<li><?php echo $html->link(__('List Products', true), array('action' => 'index'));?></li>
	</ul>
</div>
	<fieldset>
 		<legend><?php __('Edit Product');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('stock');
		echo $form->input('stock_fb');
		echo $form->input('stock_sell_target');
		echo $form->input('stock_sell_target_fb');
		echo $form->input('price');
                echo $form->input('no_shippingcharge', array('options' => array('0'=>'no','1'=>'yes')));
                echo $form->input('no_paypalsurcharge', array('options' => array('0'=>'no','1'=>'yes')));
                echo $form->input('zero_totalamount', array('options' => array('0'=>'no','1'=>'yes')));
		echo $form->input('weight');
		echo $form->input('description');
		echo $form->input('model');
		echo $form->input('date');
		echo $form->input('manufacturer');
		echo $form->input('imageview_1');
		echo $form->input('imageview_2');
		echo $form->input('imageview_3');
		echo $form->input('imageview_4');
		echo $form->input('imageview_5');
                echo $form->input('imageview_fb');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
