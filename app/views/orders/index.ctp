<div class="orders index">
<h2><?php __('Orders');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('customer_id');?></th>
	<th><?php echo $paginator->sort('lightspeed_orderid');?></th>
	<th><?php echo $paginator->sort('shipping_company_name');?></th>
	<th><?php echo $paginator->sort('shipping_unit_number');?></th>
	<th><?php echo $paginator->sort('shipping_name');?></th>
	<th><?php echo $paginator->sort('shipping_street_address');?></th>
	<th><?php echo $paginator->sort('shipping_street_address2');?></th>
	<th><?php echo $paginator->sort('shipping_suburb');?></th>
	<th><?php echo $paginator->sort('shipping_postcode');?></th>
	<th><?php echo $paginator->sort('shipping_state');?></th>
	<th><?php echo $paginator->sort('shipping_country');?></th>
	<th><?php echo $paginator->sort('shipping_email');?></th>
	<th><?php echo $paginator->sort('shipping_contact_number');?></th>
	<th><?php echo $paginator->sort('shipping_method');?></th>
	<th><?php echo $paginator->sort('payment_method');?></th>
	<th><?php echo $paginator->sort('currency');?></th>
	<th><?php echo $paginator->sort('ip_address');?></th>
	<th><?php echo $paginator->sort('paypal_firstname');?></th>
	<th><?php echo $paginator->sort('paypal_lastname');?></th>
	<th><?php echo $paginator->sort('paypal_transid');?></th>
	<th><?php echo $paginator->sort('paypal_payerid');?></th>
	<th><?php echo $paginator->sort('paypal_payerstatus');?></th>
	<th><?php echo $paginator->sort('paypal_transactiontype');?></th>
	<th><?php echo $paginator->sort('paypal_paymenttype');?></th>
	<th><?php echo $paginator->sort('is_packed');?></th>
	<th><?php echo $paginator->sort('is_dispatched');?></th>
	<th><?php echo $paginator->sort('invoice_number');?></th>
	<th><?php echo $paginator->sort('tracking_code');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
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
	<tr<?php echo $class;?>>
		<td>
			<?php echo $order['Order']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($order['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?>
		</td>
		<td>
			<?php echo $order['Order']['lightspeed_orderid']; ?>
		</td>
		<td>
			<?php echo $order['Order']['shipping_company_name']; ?>
		</td>
		<td>
			<?php echo $order['Order']['shipping_unit_number']; ?>
		</td>
		<td>
			<?php echo $order['Order']['shipping_name']; ?>
		</td>
		<td>
			<?php echo $order['Order']['shipping_street_address']; ?>
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
			<?php echo $order['Order']['shipping_country']; ?>
		</td>
		<td>
			<?php echo $order['Order']['shipping_email']; ?>
		</td>
		<td>
			<?php echo $order['Order']['shipping_contact_number']; ?>
		</td>
		<td>
			<?php echo $order['Order']['shipping_method']; ?>
		</td>
		<td>
			<?php echo $order['Order']['payment_method']; ?>
		</td>
		<td>
			<?php echo $order['Order']['currency']; ?>
		</td>
		<td>
			<?php echo $order['Order']['ip_address']; ?>
		</td>
		<td>
			<?php echo $order['Order']['paypal_firstname']; ?>
		</td>
		<td>
			<?php echo $order['Order']['paypal_lastname']; ?>
		</td>
		<td>
			<?php echo $order['Order']['paypal_transid']; ?>
		</td>
		<td>
			<?php echo $order['Order']['paypal_payerid']; ?>
		</td>
		<td>
			<?php echo $order['Order']['paypal_payerstatus']; ?>
		</td>
		<td>
			<?php echo $order['Order']['paypal_transactiontype']; ?>
		</td>
		<td>
			<?php echo $order['Order']['paypal_paymenttype']; ?>
		</td>
		<td>
			<?php echo $order['Order']['is_packed']; ?>
		</td>
		<td>
			<?php echo $order['Order']['is_dispatched']; ?>
		</td>
		<td>
			<?php echo $order['Order']['invoice_number']; ?>
		</td>		
		<td>
			<?php echo $order['Order']['tracking_code']; ?>
		</td>
		<td>
			<?php echo $order['Order']['created']; ?>
		</td>
		<td>
			<?php echo $order['Order']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $order['Order']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $order['Order']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $order['Order']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $order['Order']['id'])); ?>
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
		<li><?php echo $html->link(__('New Order', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Customers', true), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Customer', true), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
