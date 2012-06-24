<?php echo $javascript->link('pricesengine_products.js'); ?>

<div id="ajaxNotifyDiv" style="text-align: right; color: #C0C0C0;">...</div>

<div class="products index">
<h2><?php __('Products');?></h2
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Add New Product', true), array('action' => 'add')); ?></li>
	</ul>
</div>
<br />
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('is_main');?></th>
	<th><?php echo $paginator->sort('is_active');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('stock');?></th>
        <th><?php echo $paginator->sort('stock facebook');?></th>
	<th><?php echo $paginator->sort('stock_on_hold');?></th>
	<!-- <th><?php echo $paginator->sort('stock_to_go');?></th> -->  <th><?php echo $paginator->sort('stock sold');?></th>
	<!-- <th><?php echo $paginator->sort('stock_to_go_fb');?></th> -->  <th><?php echo $paginator->sort('stock sold fb');?></th>
        <th><?php echo $paginator->sort('target to sell');?></th>
        <th><?php echo $paginator->sort('target to sell fb');?></th>
	<th><?php echo $paginator->sort('price');?></th>
	<th><?php echo $paginator->sort('weight');?></th>
	<th><?php echo $paginator->sort('model');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php echo $form->create('Product'); ?>
<?php
$i = 0;
foreach ($products as $product):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $product['Product']['id']; ?>
		</td>
		<td>
			<?php if($product['Product']['is_main']==1){
				echo $form->checkbox('is_main', array('id'=>'chkIsMain_'.$product['Product']['id'], 'class'=>'checkBoxIsMain', 'checked'=>true));
			}else{
				echo $form->checkbox('is_main', array('id'=>'chkIsMain_'.$product['Product']['id'], 'class'=>'checkBoxIsMain', 'checked'=>false));
			}
		?>
		</td>
		<td>
			<?php if($product['Product']['is_active']==1){
				echo $form->checkbox('is_active', array('id'=>'chkIsActive_'.$product['Product']['id'], 'class'=>'checkBoxIsActive', 'checked'=>true));
			}else{
				echo $form->checkbox('is_active', array('id'=>'chkIsActive_'.$product['Product']['id'], 'class'=>'checkBoxIsActive', 'checked'=>false)); 
			} 
		?>
		</td>
		<td>
                    <?php
                        $rawDate = substr($product['Product']['created'], 2, 8);  //yy-mm-dd
                        $rawDateArr = explode('-', $rawDate);
                        $fuseToUrl = $rawDateArr[0].$rawDateArr[1].$rawDateArr[2].$product['Product']['id'];
                    ?>
                        <a href="http://pricesengine.com/productdeals/pe<?php echo $fuseToUrl; ?>"><?php echo $product['Product']['name']; ?></a>
		</td>
		<td>
			<?php echo $product['Product']['stock']; ?>
		</td>
		<td>
			<?php echo $product['Product']['stock_fb']; ?>
		</td>
		<td>
			<?php echo $product['Product']['stock_on_hold']; ?>
		</td>
		<td>
                    <span style="color: #dd0000;"><?php echo $product['Product']['stock_to_go']; ?></span>
		</td>
		<td>
                    <span style="color: #dd0000;"><?php echo $product['Product']['stock_to_go_fb']; ?></span>
		</td>
		<td>
                    <span style="color: #0000dd;"><?php echo $product['Product']['stock_sell_target']; ?></span>
		</td>
		<td>
                    <span style="color: #0000dd;"><?php echo $product['Product']['stock_sell_target_fb']; ?></span>
		</td>
		<td>
			<?php echo $product['Product']['price']; ?>
		</td>
		<td>
			<?php echo $product['Product']['weight']; ?>
		</td>
		<td>
			<?php echo $product['Product']['model']; ?>
		</td>
		<td>
			<?php echo $product['Product']['created']; ?>
		</td>
		<td>
			<?php echo $product['Product']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $product['Product']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php // echo $html->link(__('Delete', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php echo $form->end(); ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
