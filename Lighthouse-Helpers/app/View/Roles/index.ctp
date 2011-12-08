<div class="roles index">
	<h2><?php echo __('Roles');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Role_ID');?></th>
			<th><?php echo $this->Paginator->sort('RoleName');?></th>
			<th><?php echo $this->Paginator->sort('Description');?></th>
			<th><?php echo $this->Paginator->sort('Type');?></th>
			<th><?php echo $this->Paginator->sort('Role_per_agegroup');?></th>
			<th><?php echo $this->Paginator->sort('Minimum_age');?></th>
			<th><?php echo $this->Paginator->sort('Maximum_number');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($roles as $role): ?>
	<tr>
		<td><?php echo h($role['Role']['Role_ID']); ?>&nbsp;</td>
		<td><?php echo h($role['Role']['RoleName']); ?>&nbsp;</td>
		<td><?php echo h($role['Role']['Description']); ?>&nbsp;</td>
		<td><?php echo h($role['Role']['Type']); ?>&nbsp;</td>
		<td><?php echo h($role['Role']['Role_per_agegroup']); ?>&nbsp;</td>
		<td><?php echo h($role['Role']['Minimum_age']); ?>&nbsp;</td>
		<td><?php echo h($role['Role']['Maximum_number']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $role['Role']['Role_ID'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $role['Role']['Role_ID'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $role['Role']['Role_ID']), null, __('Are you sure you want to delete # %s?', $role['Role']['Role_ID'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Role'), array('action' => 'add')); ?></li>
	</ul>
</div>
