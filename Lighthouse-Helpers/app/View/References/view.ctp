<div class="references view">
<h2><?php  echo __('Reference');?></h2>
	<dl>
		<dt><?php echo __('Reference ID'); ?></dt>
		<dd>
			<?php echo h($reference['Reference']['Reference_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Person'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reference['Person']['Last_Name'], array('controller' => 'people', 'action' => 'view', $reference['Person']['Person_ID'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Referee'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reference['Referee']['Last_Name'], array('controller' => 'referees', 'action' => 'view', $reference['Referee']['Referee_ID'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($reference['Reference']['Year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reference Requested Date'); ?></dt>
		<dd>
			<?php echo h($reference['Reference']['Reference_Requested_Date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reference Received Date'); ?></dt>
		<dd>
			<?php echo h($reference['Reference']['Reference_Received_Date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reference OK'); ?></dt>
		<dd>
			<?php echo h($reference['Reference']['Reference_OK']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reference Status'); ?></dt>
		<dd>
			<?php echo h($reference['Reference']['Reference_Status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Reference'), array('action' => 'edit', $reference['Reference']['Reference_ID'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Reference'), array('action' => 'delete', $reference['Reference']['Reference_ID']), null, __('Are you sure you want to delete # %s?', $reference['Reference']['Reference_ID'])); ?> </li>
		<li><?php echo $this->Html->link(__('List References'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reference'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Referees'), array('controller' => 'referees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referee'), array('controller' => 'referees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List People'), array('controller' => 'people', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Person'), array('controller' => 'people', 'action' => 'add')); ?> </li>
	</ul>
</div>
