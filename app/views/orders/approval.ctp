
<?php   echo $javascript->link('pricesengine_approvalPage.js'); ?>
<?php   echo $html->css('admindefault',null,null,false); ?>


<?php if(!$orderId) {?>

	<?php echo $form->create('Order', array('action'=>'approval')); ?>
	<?php echo $form->input('Id2Edit', array('type'=>'hidden', 'value'=>'')); ?>
        <?php echo $form->input('isApproved', array('type'=>'hidden', 'value'=>'')); ?>
	<?php echo $form->end(); ?>

	<div class="orders index">
	<h2><?php __('Approval');?></h2>
	<p>
	<?php
	echo $paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></p>
	<div class="paging" style="margin-bottom: 5px;">
		<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $paginator->numbers();?>
		<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $paginator->sort('id');?></th>
                <th><?php echo $paginator->sort('is_orderapproved');?></th>
		<th><?php echo $paginator->sort('lightspeed_orderid');?></th>
                <th><?php echo $paginator->sort('paypal_transid');?></th>
		<th><?php echo $paginator->sort('paypal_payerstatus');?></th>
		<th><?php echo $paginator->sort('amount_paid');?></th>
		<th><?php echo $paginator->sort('created');?></th>
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
		<tr <?php if($order['Order']['paypal_paymenttype']=='echeck'){ echo "class=\"echeck\""; }else{ echo $class; } ?> >
			<td>
				<?php echo $order['Order']['id']; ?>
			</td>
			<td class="approveButtons">
                            <div id="approveDiv_<?php echo $order['Order']['id']; ?>" style='width:100px;'>
				<?php if($order['Order']['is_orderapproved']==0){ ?>
                                        <?php if($order['Order']['lightspeed_orderid']){ ?>
                                            <input type="button" value="Approve" onClick="AjaxApproveOrder('approveDiv_<?php echo $order['Order']['id']; ?>', '<?php echo $order['Order']['id']; ?>', 1);" />
                                        <?php }else{ ?>
                                            <input type="button" value="Approve" disabled="true" />
                                        <?php } ?>
				<?php } else { ?>
					<i>Approved</i>
				<?php } ?>
                            </div>
			</td>
			<td class="lightspeedTD">
				<?php echo $order['Order']['lightspeed_orderid']; ?>
			</td>
			<td>
				<?php echo $order['Order']['paypal_transid']; ?>
			</td>
			<td>
				<?php echo $order['Order']['paypal_payerstatus']; ?>
			</td>
			<td>
				<?php echo $order['Order']['amount_paid']; ?>
			</td>
			<td>
				<?php echo $order['Order']['created']; ?>
			</td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('action' => 'approval', $order['Order']['id'])); ?>
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


<?php } else {?>

	<div class="orders view">
	<h2><?php  __('Order Validation View');?></h2>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Back to Approval List', true), array('action' => 'approval')); ?> </li>
			<li><?php // echo $html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		</ul>
	</div>
        <hr/>
		<dl><?php $i = 1; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['id']; ?>
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is OrderApproved'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['is_orderapproved']; ?>
			</dd>
                        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Packed'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				
				<?php echo $order['Order']['is_packed']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Dispatched'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['is_dispatched']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Invoice Number'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['invoice_number']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tracking Code'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['tracking_code']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Customer'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link($order['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lightspeed Orderid'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['lightspeed_orderid']; ?>
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Company Name'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_company_name']; ?>
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Unit Number'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_unit_number']; ?>
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Name'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_name']; ?>
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Street Address:'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_street_address']; ?>
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Street Address2:'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_street_address2']; ?>

			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Suburb'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_suburb']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Postcode'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_postcode']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping State'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_state']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Country'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_country']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Email'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_email']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Contact Number'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				
				<?php echo $order['Order']['shipping_contact_number']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Method'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['shipping_method']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Payment Method'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['payment_method']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['currency']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ip Address'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['ip_address']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Firstname'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_firstname']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Lastname'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_lastname']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Transid'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_transid']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Payerid'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_payerid']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Payerstatus'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['paypal_payerstatus']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Transactiontype'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				
				<?php echo $order['Order']['paypal_transactiontype']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Paymenttype'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				
				<?php echo $order['Order']['paypal_paymenttype']; ?>
				
			</dd>
                    <!-- ///////////////////////  -->
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paypal Surcharge'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo number_format($order['Order']['paypal_surcharge'], 2); ?>

			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shipping Surcharge'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo number_format($order['Order']['shipping_charge'], 2); ?>

			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product Quantity'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo $order['Product'][0]['OrdersProduct']['quantity']; ?>

			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product Price'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo number_format($order['Product'][0]['price'], 2); ?>

			</dd>
                        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product Model'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo $order['Product'][0]['model']; ?>

			</dd>
                        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount Paid'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>

				<?php echo number_format($order['Order']['amount_paid'], 2); ?>

			</dd>
                     <!-- ///////////////////////  -->
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['created']; ?>
				
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $order['Order']['modified']; ?>
				
			</dd>
		</dl>
	</div
        <hr/>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Back to Approval List', true), array('action' => 'approval')); ?> </li>
			<li><?php // echo $html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		</ul>
	</div>



<?php }?>


