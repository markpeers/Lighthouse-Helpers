<div class="people form">
<?php echo $this->Form->create('Person');?>
	<fieldset>
		<legend><?php echo __('Edit Person'); ?></legend>
	<?php echo $this->Form->input('Person_ID');?>
		<table>
			<tr>
				<td>Name:</td>
				<td><?php echo $this->Form->input('Title', array('label' => false,
															'options' => array(''=>null,
																				'Mr'=>'Mr',
																				'Mrs'=>'Mrs',
																				'Miss'=>'Miss',
																				'Dr'=>'Dr',
																				'Rev'=>'Rev')));?></td>
				<td><?php echo $this->Form->input('First_Name', array('label' => false));?></td>
				<td><?php echo $this->Form->input('Nickname', array('label' => false));?></td>
				<td><?php echo $this->Form->input('Last_Name', array('label' => false));?></td>
			</tr>
			<tr>
				<td colspan="2">Address:</td>
				<td colspan="3"><?php echo $this->Form->input('Address_1', array('label' => false));
							echo $this->Form->input('Address_2', array('label' => false));?></td>
			</tr>
			<tr>
				<td colspan="2">Town:</td>
				<td colspan="2"><?php echo $this->Form->input('Town', array('label' => false));?></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2">County:</td>
				<td><?php echo $this->Form->input('County', array('label' => false));?></td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td colspan="2">Post Code:</td>
				<td><?php echo $this->Form->input('Post_Code', array('label' => false));?></td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td>Home Phone:</td>
				<td></td>
				<td><?php echo $this->Form->input('Telephone_1', array('label' => false));?></td>
				<td>Mobile Phone:</td>
				<td><?php echo $this->Form->input('Telephone_2', array('label' => false));?></td>
			</tr>
			<tr>
				<td colspan="2">email:</td>
				<td colspan="2"><?php echo $this->Form->input('email', array('label' => false));?></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2">Date of Birth:</td>
				<td colspan="3"><?php echo $this->Form->input('Date_of_birth', array('dateFormat' => 'DMY', 
																		'timeFormat' => null, 
																		'separator' => ' / ',
																		'empty' => true,
																		'minYear' => $this->Session->read('Filter.Year') - 90, 
																		'maxYear' => $this->Session->read('Filter.Year') - 12,
																		'label' => false
																		));?></td>
			</tr>
		</table>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
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
