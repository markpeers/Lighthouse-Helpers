<div class="roles view">
<h2><?php  echo __('Role');?></h2>
	<dl>
		<dt><?php echo __('Role ID'); ?></dt>
		<dd>
			<?php echo h($role['Role']['Role_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('RoleName'); ?></dt>
		<dd>
			<?php echo h($role['Role']['RoleName']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($role['Role']['Description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($role['Role']['Type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role Per Agegroup'); ?></dt>
		<dd>
			<?php echo h($role['Role']['Role_per_agegroup']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Minimum Age'); ?></dt>
		<dd>
			<?php echo h($role['Role']['Minimum_age']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Maximum Number'); ?></dt>
		<dd>
			<?php echo h($role['Role']['Maximum_number']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Role'), array('action' => 'edit', $role['Role']['Role_ID'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Role'), array('action' => 'delete', $role['Role']['Role_ID']), null, __('Are you sure you want to delete # %s?', $role['Role']['Role_ID'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('action' => 'add')); ?> </li>
	</ul>
</div>
