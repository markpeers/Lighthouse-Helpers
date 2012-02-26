<div class="references form">
<?php echo $this->Form->create('Reference');?>
	<fieldset>
		<legend><?php echo __('Add Reference'); ?></legend>
	<?php
		echo $this->Form->input('tblPerson_Person_ID');
		echo $this->Form->input('tblReferee_Referee_ID');
		echo $this->Form->input('Year');
		echo $this->Form->input('Reference_Requested_Date');
		echo $this->Form->input('Reference_Received_Date');
		echo $this->Form->input('Reference_OK');
		echo $this->Form->input('Reference_Status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List References'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Referees'), array('controller' => 'referees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Referee'), array('controller' => 'referees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List People'), array('controller' => 'people', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Person'), array('controller' => 'people', 'action' => 'add')); ?> </li>
	</ul>
</div>
