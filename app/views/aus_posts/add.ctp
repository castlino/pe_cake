<div class="ausPosts form">
<?php echo $form->create('AusPost');?>
	<fieldset>
 		<legend><?php __('Add AusPost');?></legend>
	<?php
		echo $form->input('Pcode');
		echo $form->input('Locality');
		echo $form->input('State');
		echo $form->input('Comments');
		echo $form->input('DeliveryOffice');
		echo $form->input('PresortIndicator');
		echo $form->input('ParcelZone');
		echo $form->input('BSPnumber');
		echo $form->input('BSPname');
		echo $form->input('Category');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List AusPosts', true), array('action' => 'index'));?></li>
	</ul>
</div>
