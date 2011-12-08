<div class="roles form">
<?php echo $this->Form->create('Role');?>
	<fieldset>
		<legend><?php echo __('Edit Role'); ?></legend>
	<?php
		echo $this->Form->input('Role_ID');
		echo $this->Form->input('RoleName');
		echo $this->Form->input('Description');
		echo $this->Form->input('Type');
		echo $this->Form->input('Role_per_agegroup');
		echo $this->Form->input('Minimum_age');
		echo $this->Form->input('Maximum_number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Role.Role_ID')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Role.Role_ID'))); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('action' => 'index'));?></li>
	</ul>
</div>
