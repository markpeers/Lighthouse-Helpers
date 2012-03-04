<?php //debug($application_id);?>
<div class="assignedroles form">
<?php echo $this->Form->create('AssignedRole');?>
	<fieldset>
		<legend><?php echo 'Add role for '.$helper['Person']['full_name']; ?></legend>
		<?php
		echo $this->Form->hidden('tblApplication_Application_ID', array('value' => $application_id)); //need to make this show app id
		echo $this->Form->input('tblRole_Role_ID', array('options' => $roles, 'label' => 'Select New Role'));
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
