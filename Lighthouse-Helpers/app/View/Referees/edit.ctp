<div class="referees form">
<?php echo $this->Form->create('Referee');?>
	<fieldset>
		<legend><?php echo __('Edit Referee'); ?></legend>
	<?php
		echo $this->Form->input('Referee_ID');
		echo $this->Form->input('Title');
		echo $this->Form->input('First_Name');
		echo $this->Form->input('Last_Name');
		echo $this->Form->input('Address_1');
		echo $this->Form->input('Address_2');
		echo $this->Form->input('Town');
		echo $this->Form->input('County');
		echo $this->Form->input('Post_Code');
		echo $this->Form->input('Telephone');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Referee.Referee_ID')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Referee.Referee_ID'))); ?></li>
		<li><?php echo $this->Html->link(__('List Referees'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List References'), array('controller' => 'references', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reference'), array('controller' => 'references', 'action' => 'add')); ?> </li>
	</ul>
</div>
