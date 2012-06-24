<?php echo $html->css('admindefault',null,null,false); ?>

<div class="products view">
<h2><?php  __('Product');?></h2>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Product', true), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Products', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Product', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['id']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['name']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stock'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['stock']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stock Facebook'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['stock_fb']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stock On Hold'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['stock_on_hold']; ?>

		</dd>
                <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stock Sold'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['stock_to_go']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stock Shipped'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['stock_gone']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['price']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No Shipping Charge'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['no_shippingcharge']==0 ? "no" : "yes"; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No Paypal Surcharge'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
                        <?php echo $product['Product']['no_paypalsurcharge']==0 ? "no" : "yes"; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zero Total Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
                        <?php echo $product['Product']['zero_totalamount']==0 ? "no" : "yes"; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Weight'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['weight']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<p<?php if ($i++ % 2 == 0) echo $class;?> style="margin-left:  250px;">
			<?php echo $product['Product']['description']; ?>

		</p>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Model'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['model']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Manufacturer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['manufacturer']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imageview 1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['imageview_1']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imageview 2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['imageview_2']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imageview 3'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['imageview_3']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imageview 4'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['imageview_4']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imageview 5'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['imageview_5']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imageview fb'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['imageview_fb']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['created']; ?>

		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['modified']; ?>

		</dd>
	</dl>
</div>
