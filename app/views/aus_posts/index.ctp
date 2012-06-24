<div class="ausPosts index">
<h2><?php __('AusPosts');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('Pcode');?></th>
	<th><?php echo $paginator->sort('Locality');?></th>
	<th><?php echo $paginator->sort('State');?></th>
	<th><?php echo $paginator->sort('Comments');?></th>
	<th><?php echo $paginator->sort('DeliveryOffice');?></th>
	<th><?php echo $paginator->sort('PresortIndicator');?></th>
	<th><?php echo $paginator->sort('ParcelZone');?></th>
	<th><?php echo $paginator->sort('BSPnumber');?></th>
	<th><?php echo $paginator->sort('BSPname');?></th>
	<th><?php echo $paginator->sort('Category');?></th>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('rate_from_sydney');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($ausPosts as $ausPost):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $ausPost['AusPost']['Pcode']; ?>
		</td>
		<td>
			<?php echo $ausPost['AusPost']['Locality']; ?>
		</td>
		<td>
			<?php echo $ausPost['AusPost']['State']; ?>
		</td>
		<td>
			<?php echo $ausPost['AusPost']['Comments']; ?>
		</td>
		<td>
			<?php echo $ausPost['AusPost']['DeliveryOffice']; ?>
		</td>
		<td>
			<?php echo $ausPost['AusPost']['PresortIndicator']; ?>
		</td>
		<td>
			<?php echo $ausPost['AusPost']['ParcelZone']; ?>
		</td>
		<td>
			<?php echo $ausPost['AusPost']['BSPnumber']; ?>
		</td>
		<td>
			<?php echo $ausPost['AusPost']['BSPname']; ?>
		</td>
		<td>
			<?php echo $ausPost['AusPost']['Category']; ?>
		</td>
		<td>
			<?php echo $ausPost['AusPost']['id']; ?>
		</td>
		<td>
			<?php echo $ausPost['AusPost']['rate_from_sydney']; ?>
		</td>		
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $ausPost['AusPost']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $ausPost['AusPost']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $ausPost['AusPost']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ausPost['AusPost']['id'])); ?>
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
		<li><?php echo $html->link(__('New AusPost', true), array('action' => 'add')); ?></li>
	</ul>
</div>
