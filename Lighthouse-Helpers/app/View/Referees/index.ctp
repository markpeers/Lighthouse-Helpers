<div class="referees index">
	<h2><?php echo __('Referees');?></h2>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('Referee_ID');?></th>
			<th><?php echo $this->Paginator->sort('Title');?></th>
			<th><?php echo $this->Paginator->sort('First_Name');?></th>
			<th><?php echo $this->Paginator->sort('Last_Name');?></th>
			<th><?php echo $this->Paginator->sort('Address_1');?></th>
			<th><?php echo $this->Paginator->sort('Address_2');?></th>
			<th><?php echo $this->Paginator->sort('Town');?></th>
			<th><?php echo $this->Paginator->sort('County');?></th>
			<th><?php echo $this->Paginator->sort('Post_Code');?></th>
			<th><?php echo $this->Paginator->sort('Telephone');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($referees as $referee): ?>
	<tr>
		<td><?php echo h($referee['Referee']['Referee_ID']); ?>&nbsp;</td>
		<td><?php echo h($referee['Referee']['Title']); ?>&nbsp;</td>
		<td><?php echo h($referee['Referee']['First_Name']); ?>&nbsp;</td>
		<td><?php echo h($referee['Referee']['Last_Name']); ?>&nbsp;</td>
		<td><?php echo h($referee['Referee']['Address_1']); ?>&nbsp;</td>
		<td><?php echo h($referee['Referee']['Address_2']); ?>&nbsp;</td>
		<td><?php echo h($referee['Referee']['Town']); ?>&nbsp;</td>
		<td><?php echo h($referee['Referee']['County']); ?>&nbsp;</td>
		<td><?php echo h($referee['Referee']['Post_Code']); ?>&nbsp;</td>
		<td><?php echo h($referee['Referee']['Telephone']); ?>&nbsp;</td>
		<td><?php echo h($referee['Referee']['email']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $referee['Referee']['Referee_ID'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $referee['Referee']['Referee_ID'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $referee['Referee']['Referee_ID']), null, __('Are you sure you want to delete # %s?', $referee['Referee']['Referee_ID'])); ?>
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
		<li><?php echo $this->Html->link(__('New Referee'), array('action' => 'add')); ?></li>
		<li><?php //echo $this->Html->link(__('List References'), array('controller' => 'references', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Reference'), array('controller' => 'references', 'action' => 'add')); ?> </li>
	</ul>
</div>
