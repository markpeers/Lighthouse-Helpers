<div class="referees view">
<h2><?php  echo __('Referee');?></h2>
	<dl>
		<dt><?php echo __('Referee ID'); ?></dt>
		<dd>
			<?php echo h($referee['Referee']['Referee_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($referee['Referee']['Title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($referee['Referee']['First_Name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($referee['Referee']['Last_Name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address 1'); ?></dt>
		<dd>
			<?php echo h($referee['Referee']['Address_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address 2'); ?></dt>
		<dd>
			<?php echo h($referee['Referee']['Address_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Town'); ?></dt>
		<dd>
			<?php echo h($referee['Referee']['Town']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('County'); ?></dt>
		<dd>
			<?php echo h($referee['Referee']['County']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post Code'); ?></dt>
		<dd>
			<?php echo h($referee['Referee']['Post_Code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telephone'); ?></dt>
		<dd>
			<?php echo h($referee['Referee']['Telephone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($referee['Referee']['email']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Referee'), array('action' => 'edit', $referee['Referee']['Referee_ID'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Referee'), array('action' => 'delete', $referee['Referee']['Referee_ID']), null, __('Are you sure you want to delete # %s?', $referee['Referee']['Referee_ID'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Referees'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referee'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List References'), array('controller' => 'references', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reference'), array('controller' => 'references', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related References');?></h3>
	<?php if (!empty($referee['Reference'])):?>
	<table>
	<tr>
		<th><?php echo __('Reference ID'); ?></th>
		<th><?php echo __('TblPerson Person ID'); ?></th>
		<th><?php echo __('TblReferee Referee ID'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th><?php echo __('Reference Requested Date'); ?></th>
		<th><?php echo __('Reference Received Date'); ?></th>
		<th><?php echo __('Reference OK'); ?></th>
		<th><?php echo __('Reference Status'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($referee['Reference'] as $reference): ?>
		<tr>
			<td><?php echo $reference['Reference_ID'];?></td>
			<td><?php echo $reference['tblPerson_Person_ID'];?></td>
			<td><?php echo $reference['tblReferee_Referee_ID'];?></td>
			<td><?php echo $reference['Year'];?></td>
			<td><?php echo $reference['Reference_Requested_Date'];?></td>
			<td><?php echo $reference['Reference_Received_Date'];?></td>
			<td><?php echo $reference['Reference_OK'];?></td>
			<td><?php echo $reference['Reference_Status'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'references', 'action' => 'view', $reference['Reference_ID'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'references', 'action' => 'edit', $reference['Reference_ID'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'references', 'action' => 'delete', $reference['Reference_ID']), null, __('Are you sure you want to delete # %s?', $reference['Reference_ID'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Reference'), array('controller' => 'references', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
