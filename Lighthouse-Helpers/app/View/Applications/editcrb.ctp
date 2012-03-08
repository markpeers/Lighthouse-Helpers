<?php //debug($crbValidYears);?>
<div class="application form">
<?php echo $this->Form->create('Application');?>
	<fieldset>
		<legend><?php echo 'Edit CRB details for '.$this->request->data['Person']['full_name']; ?></legend>
	<?php
		echo $this->Form->input('Application_ID');
		echo $this->Form->input('CRB', array('label' => 'CRB',
												'options' => array(0 => 'Not Required',
																	1 => 'None',
																	2 => 'Yes',
																	3 => 'Applied for')));
//removed CRB type as its no longer used		
/* 		echo $this->Form->input('CRB_type', array('label' => 'CRB Type',
												'options' => array(0 => 'None',
																	1 => 'Basic',
																	2 => 'Standard',
																	3 => 'Enhanced',
																	4 => 'Lighthouse')));
 */		
		echo $this->Form->input('CRB_date', array('dateFormat' => 'DMY', 
													'timeFormat' => null, 
													'separator' => ' / ',
													'empty' => true,
													'minYear' => $this->Session->read('Filter.Year') - $crbValidYears, 
													'maxYear' => $this->Session->read('Filter.Year'),
													'label' => 'CRB Date'
													));
		echo $this->Form->input('CRB_number', array('label' => 'CRB Number'));
		echo $this->Form->input('CRB_note', array('label' => 'CRB Notes'));
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
