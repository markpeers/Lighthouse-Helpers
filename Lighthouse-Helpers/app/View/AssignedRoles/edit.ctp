<?php //debug($this->request->data);?>
<div class="assignedroles form">
<?php echo $this->Form->create('AssignedRole');?>
	<fieldset>
		<legend><?php echo 'Edit assigned role for '.$helper['Person']['full_name']; ?></legend>
	<?php
		$sessiontable = array(array('heading' => 'am',
									'week' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],25)),
									'mon' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],1)),
									'tue' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],5)),
									'wed' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],9)),
									'thu' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],13)),
									'fri' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],17)),
									'sat' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],21)),
									'w/e' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],29))),
							  array('heading' => 'pm',
									'week' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],26)),
									'mon' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],2)),
									'tue' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],6)),
									'wed' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],10)),
									'thu' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],14)),
									'fri' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],18)),
									'sat' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],22)),
									'w/e' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],30))),
							  array('heading' => 'evening',
									'week' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],27)),
									'mon' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],3)),
									'tue' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],7)),
									'wed' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],11)),
									'thu' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],15)),
									'fri' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],19)),
									'sat' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],23)),
									'w/e' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],31))),
							  array('heading' => 'night',
									'week' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],28)),
									'mon' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],4)),
									'tue' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],8)),
									'wed' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],12)),
									'thu' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],16)),
									'fri' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],20)),
									'sat' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],24)),
									'w/e' => '- ' . $this->Html->link('Add', array('controller' => 'AssignedSessions', 'action' => 'add',$this->request->data['AssignedRole']['Role_Assigned_ID'],32))),
						);
		
		foreach ($this->request->data['AssignedSession'] as $lhsession) {
			switch ($lhsession['tblSessions_Sessions_ID']) {
				case 1: 	$sessiontable[0]['mon']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 2: 	$sessiontable[1]['mon']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 3: 	$sessiontable[2]['mon']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 4: 	$sessiontable[3]['mon']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 5: 	$sessiontable[0]['tue']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 6: 	$sessiontable[1]['tue']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 7: 	$sessiontable[2]['tue']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 8: 	$sessiontable[3]['tue']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 9: 	$sessiontable[0]['wed']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 10:	$sessiontable[1]['wed']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 11:	$sessiontable[2]['wed']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 12:	$sessiontable[3]['wed']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 13: 	$sessiontable[0]['thu']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 14:	$sessiontable[1]['thu']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 15:	$sessiontable[2]['thu']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 16:	$sessiontable[3]['thu']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 17: 	$sessiontable[0]['fri']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 18:	$sessiontable[1]['fri']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 19:	$sessiontable[2]['fri']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 20:	$sessiontable[3]['fri']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 21: 	$sessiontable[0]['sat']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 22:	$sessiontable[1]['sat']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 23:	$sessiontable[2]['sat']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 24:	$sessiontable[3]['sat']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 25: 	$sessiontable[0]['week']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 26:	$sessiontable[1]['week']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 27:	$sessiontable[2]['week']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 28:	$sessiontable[3]['week']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 29:	$sessiontable[0]['w/e']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
				case 30:	$sessiontable[1]['w/e']='Y ' . $this->Html->link('Del', array('controller' => 'AssignedSessions', 'action' => 'delete',$lhsession['Session_Assigned_ID'])); break;
		
				default: ; break;
			};
		}
		echo $this->Form->input('Role_Assigned_ID');
		//echo $this->Form->hidden('tblPerson_Person_ID');
		echo $this->Form->input('tblRole_Role_ID', array('options' => $roles, 'label' => 'Role'));
		//echo $this->Form->hidden('Year');
		echo $this->Form->input('Sent_to_AGL', array('dateFormat' => 'DMY', 
													'timeFormat' => null, 
													'separator' => ' / ',
													'empty' => true,
													'minYear' => $this->Session->read('Filter.Year') - 1, 
													'maxYear' => $this->Session->read('Filter.Year'),
													'label' => 'Sent to AGL'
													));
		echo $this->Form->input('badge_printed', array('options' => array(-1 => 'Yes', 0 => 'No'),
														'label' => 'Badge Printed'));
	?>
	</fieldset>
	<table>
		<?php echo $this->Html->tableHeaders(array('','All Week','Mon','Tue','Wed','Thu','Fri','Sat','Weekend'));
			echo $this->Html->tableCells($sessiontable);
		?>
	</table>
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
