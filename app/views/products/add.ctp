<?php echo $html->css('jquery-ui-1.8.2.custom',null,null,false); ?>
<?php echo $javascript->link("jquery-ui-1.8.2.custom.min.js"); ?>
<?php echo $javascript->link("pricesengine_addProducts.js"); ?>


<div class="products form">
<?php echo $form->create('Product', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Product');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('stock');
                echo $form->input('stock_fb', array('label'=>'Stock for Facebook'));
		echo $form->input('price');
                echo $form->input('no_shippingcharge', array('options' => array('0'=>'no','1'=>'yes')));
                echo $form->input('no_paypalsurcharge', array('options' => array('0'=>'no','1'=>'yes')));
                echo $form->input('zero_totalamount', array('options' => array('0'=>'no','1'=>'yes')));
		echo $form->input('weight');
		echo $form->input('description',array('type'=>'textarea'));
		echo $form->input('model');
		echo $form->input('manufacturer');
                echo $form->input('date');
                
		echo $form->label('Image view 1');
                echo $form->file('imageviewarr_1')."<br/>";
		echo $form->label('Image view 2');
                echo $form->file('imageviewarr_2')."<br/>";
		echo $form->label('Image view 3');
                echo $form->file('imageviewarr_3')."<br/>";
		echo $form->label('Image view 4');
                echo $form->file('imageviewarr_4')."<br/>";
		echo $form->label('Image view 5');
                echo $form->file('imageviewarr_5')."<br/>";
		echo $form->label('Image view facebook');
                echo $form->file('imageviewarr_6')."<br/>";
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Products', true), array('action' => 'index'));?></li>
	</ul>
</div>
