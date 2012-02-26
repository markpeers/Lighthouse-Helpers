<?php //debug($refereetemp);?>
<div class="referees form">
<?php echo $this->Form->create('Reference');?>
	<fieldset>
		<legend><?php echo 'Confirm Referee for '.$refereetemp['Person']['full_name']; ?></legend>
	<?php
		echo $this->Form->hidden('refereeoffered_ID', array('value'=>$refereetemp['RefereeTemp']['Referee_temp_ID']));
		//echo $this->Form->input('Notes');
	?>
		<table>
			<tr>
				<th>Referee Offered</th><th>Known Referees</th>
			</tr>
			<tr>
				<td>
				<?php echo $refereetemp['RefereeTemp']['Title'].' '.$refereetemp['RefereeTemp']['First_Name'].' '.$refereetemp['RefereeTemp']['Last_Name'];?><br />
				<?php echo $refereetemp['RefereeTemp']['Address_1'];?><br />
				<?php echo $refereetemp['RefereeTemp']['Address_2'];?><br />
				<?php echo $refereetemp['RefereeTemp']['Town'];?><br />
				<?php echo $refereetemp['RefereeTemp']['County'];?><br />
				<?php echo $refereetemp['RefereeTemp']['Post_Code'];?><br /><br />
				<?php echo $refereetemp['RefereeTemp']['Telephone'];?>
				</td>
				<td>
				<?php 
					if (empty($referees)) {
							$selectmessage = 'Unkown Referee';
						} else {
							$selectmessage = 'Select Known Referee';
						}
					echo $this->Form->select('referee', $referees, array('empty'=>$selectmessage));?>
				</td>
			</tr>
		</table>
	</fieldset>
<?php echo $this->Form->end(__('Confirm'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Helper Summary'), array('controller' => 'applications','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Helpers'), array('controller' => 'applications','action' => 'helperlist')); ?></li>
		<li><?php echo $this->Html->link(__('Cancel Confirm'), array('controller' => 'applications', 
																	'action' => 'helper',
																	$this->Session->read('Current.Application'),
																	$this->Session->read('Current.Person'),
																	$this->Session->read('Filter.Year'))); ?></li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>
