<div class="ordersProducts view">
<h2><?php  __('OrdersProduct');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ordersProduct['OrdersProduct']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Order Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ordersProduct['OrdersProduct']['order_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ordersProduct['OrdersProduct']['product_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ordersProduct['OrdersProduct']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ordersProduct['OrdersProduct']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit OrdersProduct', true), array('action' => 'edit', $ordersProduct['OrdersProduct']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete OrdersProduct', true), array('action' => 'delete', $ordersProduct['OrdersProduct']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ordersProduct['OrdersProduct']['id'])); ?> </li>
		<li><?php echo $html->link(__('List OrdersProducts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New OrdersProduct', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
