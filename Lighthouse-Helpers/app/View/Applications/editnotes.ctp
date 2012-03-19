<?php //debug($this->request);?>
<div class="application form">
<?php echo $this->Form->create('Application');?>
	<fieldset>
		<legend><?php echo 'Edit application notes for '.$this->request->data['Person']['full_name']; ?></legend>
	<?php
		echo $this->Form->input('Application_ID');
		echo $this->Form->input('Notes');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Helper Summary'), array('controller' => 'applications','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Helpers'), array('controller' => 'applications','action' => 'helperlist')); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('Cancel Update'), array('controller' => 'applications', 
																	'action' => 'helper',
																	$this->Session->read('Current.Application'),
																	$this->Session->read('Current.Person'),
																	$this->Session->read('Filter.Year'))); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>
