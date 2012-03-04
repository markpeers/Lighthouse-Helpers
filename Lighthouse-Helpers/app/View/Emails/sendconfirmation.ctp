<?php //debug($data);?>
<div class="email form">
<?php echo $this->Form->create(false);?>
	<fieldset>
		<legend><?php echo 'Send confirmation emails'; ?></legend>
		<table>
			<tr><th>Helper</th><th>Role</th></tr>
		
		<?php foreach($data as $person) : ?>
			<?php foreach($person['AssignedRole'] as $role) : ?>
				<tr><td><?php echo $person['Person']['full_name']; ?></td>
					<td><?php echo $role['Role']['RoleName']; ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
		</table>
	</fieldset>
<?php echo $this->Form->end(__('Confirm'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Helper Summary'), array('controller' => 'applications','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Helpers'), array('controller' => 'applications','action' => 'helperlist')); ?></li>
		<li><?php echo $this->Html->link(__('Cancel Send'), array('controller' => 'applications', 
																	'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>
