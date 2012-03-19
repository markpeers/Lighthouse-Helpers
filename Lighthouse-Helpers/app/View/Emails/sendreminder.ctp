<?php //debug($data);?>
<div class="email form">
<?php echo $this->Form->create(false);?>
	<fieldset>
		<legend><?php echo 'Send '.$data.' reminder emails'; ?></legend>
		<p>This may take up to 30 minutes to complete, please don't close the browser or press confirm a second time.</p>
		<p>The browser will return to the helper summary page when all emails have been sent.</p>
		<p> Press confirm to send the reminder emails.</p>
	</fieldset>
<?php echo $this->Form->end(__('Confirm'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Helper Summary'), array('controller' => 'applications','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Helpers'), array('controller' => 'applications','action' => 'helperlist')); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('Cancel Send'), array('controller' => 'applications', 
																	'action' => 'index')); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>
