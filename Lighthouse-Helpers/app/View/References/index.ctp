<div class="references index">
	<h2><?php echo __('References');?></h2>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('Reference_ID');?></th>
			<th><?php echo $this->Paginator->sort('tblPerson_Person_ID');?></th>
			<th><?php echo $this->Paginator->sort('tblReferee_Referee_ID');?></th>
			<th><?php echo $this->Paginator->sort('Year');?></th>
			<th><?php echo $this->Paginator->sort('Reference_Requested_Date');?></th>
			<th><?php echo $this->Paginator->sort('Reference_Received_Date');?></th>
			<th><?php echo $this->Paginator->sort('Reference_OK');?></th>
			<th><?php echo $this->Paginator->sort('Reference_Status');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($references as $reference): ?>
	<tr>
		<td><?php echo h($reference['Reference']['Reference_ID']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($reference['Person']['Last_Name'], array('controller' => 'people', 'action' => 'view', $reference['Person']['Person_ID'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($reference['Referee']['Last_Name'], array('controller' => 'referees', 'action' => 'view', $reference['Referee']['Referee_ID'])); ?>
		</td>
		<td><?php echo h($reference['Reference']['Year']); ?>&nbsp;</td>
		<td><?php echo h($reference['Reference']['Reference_Requested_Date']); ?>&nbsp;</td>
		<td><?php echo h($reference['Reference']['Reference_Received_Date']); ?>&nbsp;</td>
		<td><?php echo h($reference['Reference']['Reference_OK']); ?>&nbsp;</td>
		<td><?php echo h($reference['Reference']['Reference_Status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $reference['Reference']['Reference_ID'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $reference['Reference']['Reference_ID'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $reference['Reference']['Reference_ID']), null, __('Are you sure you want to delete # %s?', $reference['Reference']['Reference_ID'])); ?>
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
		<li><?php echo $this->Html->link(__('New Reference'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Referees'), array('controller' => 'referees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referee'), array('controller' => 'referees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List People'), array('controller' => 'people', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Person'), array('controller' => 'people', 'action' => 'add')); ?> </li>
	</ul>
</div>
