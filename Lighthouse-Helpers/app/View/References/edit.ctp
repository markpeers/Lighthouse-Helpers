<?php //debug($this->Session->read('Filter.Year'))?>
<div class="references form">
<?php echo $this->Form->create('Reference');?>
	<fieldset>
		<legend><?php echo 'Edit Reference for '.$helper; ?></legend>
	<?php
		echo $this->Form->input('Reference_ID');
		echo $this->Form->hidden('tblPerson_Person_ID');
		echo $this->Form->input('tblReferee_Referee_ID', array('options' => $referees, 'label' => 'Referee'));
		echo $this->Form->hidden('Year');
		echo $this->Form->input('Reference_Status',array('options'=> array(	1 => 'Not requested',
														  					2 => 'Requested',
																			3 => 'Awaiting reply',
																			4 => 'Received')));
		echo $this->Form->input('Reference_Requested_Date', array('dateFormat' => 'DMY', 
																'timeFormat' => null, 
																'separator' => ' / ',
																'empty' => true,
																'minYear' => $this->Session->read('Filter.Year') - 1, 
																'maxYear' => $this->Session->read('Filter.Year')
																));
		echo $this->Form->input('Reference_Received_Date', array('dateFormat' => 'DMY', 
																'timeFormat' => null, 
																'separator' => ' / ',
																'empty' => true,
																'minYear' => $this->Session->read('Filter.Year') - 1, 
																'maxYear' => $this->Session->read('Filter.Year')
																));
		echo $this->Form->input('Reference_OK', array('options' => array(-1 => 'Yes', 0 => 'No'),
														'label' => 'Reference OK',
														'empty' => 'Select'));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Update'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Helper Summary'), array('controller' => 'applications','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Helpers'), array('controller' => 'applications','action' => 'helperlist')); ?></li>
		<li><?php echo $this->Html->link(__('Cancel Update'), array('controller' => 'applications', 
																	'action' => 'helper',
																	$this->Session->read('Current.Application'),
																	$this->Session->read('Current.Person'),
																	$this->Session->read('Filter.Year'))); ?></li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>
