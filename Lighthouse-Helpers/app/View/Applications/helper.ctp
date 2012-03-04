<!-- File: /app/View/Application/helper.ctp -->

<?php //debug($data) ?>
<div class="index">
	<table>
		<tr>
			<th>
			<?php echo	'Helper: '.$data['Person']['Nickname'].' '.$data['Person']['Last_Name'];?>
			</th>
			<th>
			<?php echo 'Number: '.$data['Application']['Application_ID']; ?>
			</th>
			<th>
			<?php echo 'Year: '.$data['Application']['Year']; ?>
			</th>
		</tr>
	</table>

	<div id="tabs">
		<ul>
			<li><a href="#tabs-helper">Helper</a></li>
			<li><a href="#tabs-referees-offered">Referees Offered</a></li>
			<li><a href="#tabs-references">References</a></li>
			<li><a href="#tabs-help-offered">Help Offered</a></li>
			<li><a href="#tabs-roles-assigned">Roles Assigned</a></li>
			<li><a href="#tabs-experience">Experience</a></li>
			<li><a href="#tabs-health">Health</a></li>
			<li><a href="#tabs-declaration">Declaration</a></li>
			<li><a href="#tabs-crb">CRB</a></li>
			<li><a href="#tabs-lh-address">LH Address</a></li>
			<li><a href="#tabs-emergency-contact">Emergency Contact</a></li>
			<li><a href="#tabs-notes">Notes</a></li>
			<li><a href="#tabs-confirmation">Confirmation</a></li>
			<li><a href="#tabs-confidential">Confidential</a></li>
		</ul>
		<div id="tabs-helper">
			<table>
				<tr>
					<td>Address:</td>
					<td><?php echo $data['Person']['Address_1'].'<br/>';
					if(strlen($data['Person']['Address_2']) > 0) echo  $data['Person']['Address_2'].'<br/>';
					echo $data['Person']['Town'].'<br/>'.
					$data['Person']['County'].'<br/>'.
					$data['Person']['Post_Code'];?>
					</td>
				</tr>
				<tr>
					<td>e-mail:</td>
					<td><?php echo $data['Person']['email'];?></td>
				</tr>
				<tr>
					<td>Telephone Home:</td>
					<td><?php echo $data['Person']['Telephone_1'];?></td>
				</tr>
				<tr>
					<td>Telephone Daytime:</td>
					<td><?php echo $data['Person']['Telephone_2'];?></td>
				</tr>
				<tr>
					<td>Date of Birth:</td>
					<td><?php echo date('jS F Y',strtotime($data['Person']['Date_of_birth']));?>
					</td>
				</tr>
				<tr>
					<td>Church Attended:</td>
					<td><?php echo $data['Person']['Church']['Name'];?>
					</td>
				</tr>
			</table>
		</div>
		<div id="tabs-referees-offered">
			<table>
				<tr><th>Referee 1</th><th>Referee 2</th></tr>
				<tr>
			<?php foreach ($data['Person']['RefereeTemp'] as $referee): ?>
				<td><?php echo $referee['Title'].' '.$referee['First_Name'].' '.$referee['Last_Name'];?><br />
					<?php echo $referee['Address_1'];?><br />
					<?php echo $referee['Address_2'];?><br />
					<?php echo $referee['Town'];?><br />
					<?php echo $referee['County'];?><br />
					<?php echo $referee['Post_Code'];?><br /><br />
					<?php echo $referee['Telephone'];?>
				</td>
			<?php endforeach; ?>
				</tr>
				<tr>
			<?php foreach ($data['Person']['RefereeTemp'] as $referee): ?>
				<td class="actions">
					<?php echo $this->Html->link('Confirm Referee', array('controller' => 'referees',
																'action' => 'confirm',
																$referee['Referee_temp_ID']
																)
												); ?>
				</td>
			<?php endforeach; ?>
				</tr>
			</table>
		</div>
		<div id="tabs-references">
			<table>
				<tr>
					<th>Referee</th>
					<th>Status</th>
					<th>Requested Date</th>
					<th>Received Date</th>
					<th>OK</th>
					<th>Year</th>
					<th>Actions</th>
				</tr>
				
			<?php foreach ($data['Person']['Reference'] as $reference): 
					if ($reference['Year'] == $data['Application']['Year']) {
						$refclass = 'ref-current-year';
					} else {
						$refclass = 'ref-last-year';
					}?>
				<tr class="<?php echo $refclass;?>">
				<td><?php echo $reference['Referee']['Title'].' '.$reference['Referee']['First_Name'].' '.$reference['Referee']['Last_Name'];?></td>
				<td><?php switch ($reference['Reference_Status']){
														case 1:
														  echo 'Not requested';
														  break;
														case 2:
														  echo 'Requested';
														  break;
														case 3:
														  echo 'Awaiting reply';
														  break;
														case 4:
														  echo 'Received';
														  break;
														  default:
														  echo 'Should never get here';
														};?></td>
				<?php if ($reference['Reference_Status'] == 1) {
					echo '<td>-</td><td>-</td><td>-</td>';
				}
				else {?>
				
				<td><?php if(!(is_null($reference['Reference_Requested_Date']))){
					echo date('jS F Y',strtotime($reference['Reference_Requested_Date']));
				}
					else {echo '-';
				}?></td>
				<td><?php if(!(is_null($reference['Reference_Received_Date']))){
					echo date('jS F Y',strtotime($reference['Reference_Received_Date']));
				}
					else {echo '-';
				}?></td>
				<td><?php if ($reference['Reference_Status'] == 4) {
					if ($reference['Reference_OK'] == 0) {
						echo 'No';
					}
					else {
						echo 'Yes';
					}; 
				}
				else {
					echo '-';
				}
				}?></td>
				<td><?php echo $reference['Year']?></td>
				<td class="actions">
					<?php 
						if ($reference['Year'] == $data['Application']['Year']) {
							echo $this->Html->link('Edit', array('controller' => 'references',
																'action' => 'edit',
																$reference['Reference_ID']
																)
													); 
							echo $this->Form->postLink('Delete', array('controller' => 'References',
																		'action' => 'delete', 
																		$reference['Reference_ID']
																		),
																null,
																'Are you sure you want to remove the reference?'
														); 
						} else {
							echo $this->Html->link('Copy to this year', array('controller' => 'references',
																'action' => 'copy',
																$reference['Reference_ID'],
																$data['Application']['Year']
																)
													);
						}
					?>
				</td>
				</tr>
			<?php endforeach; ?>
			</table>
		</div>
		<div id="tabs-help-offered">
			<table>
				<tr><th>Role</th><th>Sessions</th><th>Actions</th></tr>
			<?php 
				$assignedroletype = array();
				foreach ($data['AssignedRole'] as $assignedrole):
					$assignedroletype[] = $assignedrole['tblRole_Role_ID'];
				endforeach;
				//debug($assignedroletype);
				foreach ($data['OfferedRole'] as $offeredrole): 
					$sessiontable = array(	array('heading' => 'am',
														'week' => '-',
														'mon' => '-',
														'tue' => '-',
														'wed' => '-',
														'thu' => '-',
														'fri' => '-',
														'sat' => '-',
														'w/e' => '-'),
										  	array('heading' => 'pm',
														'week' => '-',
														'mon' => '-',
														'tue' => '-',
														'wed' => '-',
														'thu' => '-',
														'fri' => '-',
														'sat' => '-',
														'w/e' => '-'),
											array('heading' => 'evening',
														'week' => '-',
														'mon' => '-',
														'tue' => '-',
														'wed' => '-',
														'thu' => '-',
														'fri' => '-',
														'sat' => '-',
														'w/e' => '-'),
											array('heading' => 'night',
														'week' => '-',
														'mon' => '-',
														'tue' => '-',
														'wed' => '-',
														'thu' => '-',
														'fri' => '-',
														'sat' => '-',
														'w/e' => '-')
									);?>
				<tr><td><?php echo $offeredrole['Role']['RoleName'];?></td>
					<td><?php  foreach ($offeredrole['OfferedSession'] as $lhsession) {
						switch ($lhsession['tblSessions_Sessions_ID']) {
							case 1: 	$sessiontable[0]['mon']='Y'; break;
							case 2: 	$sessiontable[1]['mon']='Y'; break;
							case 3: 	$sessiontable[2]['mon']='Y'; break;
							case 4: 	$sessiontable[3]['mon']='Y'; break;
							case 5: 	$sessiontable[0]['tue']='Y'; break;
							case 6: 	$sessiontable[1]['tue']='Y'; break;
							case 7: 	$sessiontable[2]['tue']='Y'; break;
							case 8: 	$sessiontable[3]['tue']='Y'; break;
							case 9: 	$sessiontable[0]['wed']='Y'; break;
							case 10:	$sessiontable[1]['wed']='Y'; break;
							case 11:	$sessiontable[2]['wed']='Y'; break;
							case 12:	$sessiontable[3]['wed']='Y'; break;
							case 13: 	$sessiontable[0]['thu']='Y'; break;
							case 14:	$sessiontable[1]['thu']='Y'; break;
							case 15:	$sessiontable[2]['thu']='Y'; break;
							case 16:	$sessiontable[3]['thu']='Y'; break;
							case 17: 	$sessiontable[0]['fri']='Y'; break;
							case 18:	$sessiontable[1]['fri']='Y'; break;
							case 19:	$sessiontable[2]['fri']='Y'; break;
							case 20:	$sessiontable[3]['fri']='Y'; break;
							case 21: 	$sessiontable[0]['sat']='Y'; break;
							case 22:	$sessiontable[1]['sat']='Y'; break;
							case 23:	$sessiontable[2]['sat']='Y'; break;
							case 24:	$sessiontable[3]['sat']='Y'; break;
							case 25: 	$sessiontable[0]['week']='Y'; break;
							case 26:	$sessiontable[1]['week']='Y'; break;
							case 27:	$sessiontable[2]['week']='Y'; break;
							case 28:	$sessiontable[3]['week']='Y'; break;
							case 29:	$sessiontable[0]['w/e']='Y'; break;
							case 30:	$sessiontable[1]['w/e']='Y'; break;
								
							default: ; break;
						};
					}?>
						<table>
						<?php echo $this->Html->tableHeaders(array('', 
																	'All Week',
																	'Mon',
																	'Tue',
																	'Wed',
																	'Thu',
																	'Fri',
																	'Sat',
																	'Weekend'));
							echo $this->Html->tableCells($sessiontable);
						?>
						</table>
					</td>
					<td class="actions">
						<?php if (in_array($offeredrole['tblRole_Role_ID'], $assignedroletype)) {
							echo 'Accepted';
						}
						else {
							echo $this->Html->link('Accept', array('controller' => 'OfferedRoles',
																	'action' => 'accept',
																	$offeredrole['Role_Offered_ID']
																	)
													);
						}
						?>
					</td>
				</tr>
			<?php endforeach; ?>
			</table>
		</div>
		<div id="tabs-roles-assigned">
			<table>
				<tr><th>Role</th><th>Sessions</th><th>Sent to Leader</th><th>Badge Printed</th><th>Actions</th></tr>
			<?php foreach ($data['AssignedRole'] as $assignedrole): 
					$sessiontable = array(	array('heading' => 'am',
														'week' => '-',
														'mon' => '-',
														'tue' => '-',
														'wed' => '-',
														'thu' => '-',
														'fri' => '-',
														'sat' => '-',
														'w/e' => '-'),
										  	array('heading' => 'pm',
														'week' => '-',
														'mon' => '-',
														'tue' => '-',
														'wed' => '-',
														'thu' => '-',
														'fri' => '-',
														'sat' => '-',
														'w/e' => '-'),
											array('heading' => 'evening',
														'week' => '-',
														'mon' => '-',
														'tue' => '-',
														'wed' => '-',
														'thu' => '-',
														'fri' => '-',
														'sat' => '-',
														'w/e' => '-'),
											array('heading' => 'night',
														'week' => '-',
														'mon' => '-',
														'tue' => '-',
														'wed' => '-',
														'thu' => '-',
														'fri' => '-',
														'sat' => '-',
														'w/e' => '-')
									);?>
				<tr><td><?php echo $assignedrole['Role']['RoleName'];?></td>
					<td><?php  foreach ($assignedrole['AssignedSession'] as $lhsession) {
						switch ($lhsession['tblSessions_Sessions_ID']) {
							case 1: 	$sessiontable[0]['mon']='Y'; break;
							case 2: 	$sessiontable[1]['mon']='Y'; break;
							case 3: 	$sessiontable[2]['mon']='Y'; break;
							case 4: 	$sessiontable[3]['mon']='Y'; break;
							case 5: 	$sessiontable[0]['tue']='Y'; break;
							case 6: 	$sessiontable[1]['tue']='Y'; break;
							case 7: 	$sessiontable[2]['tue']='Y'; break;
							case 8: 	$sessiontable[3]['tue']='Y'; break;
							case 9: 	$sessiontable[0]['wed']='Y'; break;
							case 10:	$sessiontable[1]['wed']='Y'; break;
							case 11:	$sessiontable[2]['wed']='Y'; break;
							case 12:	$sessiontable[3]['wed']='Y'; break;
							case 13: 	$sessiontable[0]['thu']='Y'; break;
							case 14:	$sessiontable[1]['thu']='Y'; break;
							case 15:	$sessiontable[2]['thu']='Y'; break;
							case 16:	$sessiontable[3]['thu']='Y'; break;
							case 17: 	$sessiontable[0]['fri']='Y'; break;
							case 18:	$sessiontable[1]['fri']='Y'; break;
							case 19:	$sessiontable[2]['fri']='Y'; break;
							case 20:	$sessiontable[3]['fri']='Y'; break;
							case 21: 	$sessiontable[0]['sat']='Y'; break;
							case 22:	$sessiontable[1]['sat']='Y'; break;
							case 23:	$sessiontable[2]['sat']='Y'; break;
							case 24:	$sessiontable[3]['sat']='Y'; break;
							case 25: 	$sessiontable[0]['week']='Y'; break;
							case 26:	$sessiontable[1]['week']='Y'; break;
							case 27:	$sessiontable[2]['week']='Y'; break;
							case 28:	$sessiontable[3]['week']='Y'; break;
							case 29:	$sessiontable[0]['w/e']='Y'; break;
							case 30:	$sessiontable[1]['w/e']='Y'; break;
								
							default: ; break;
						};
					}?>
						<table>
						<?php echo $this->Html->tableHeaders(array('', 
																	'All Week',
																	'Mon',
																	'Tue',
																	'Wed',
																	'Thu',
																	'Fri',
																	'Sat',
																	'Weekend'));
							echo $this->Html->tableCells($sessiontable);
						?>
						</table>
					</td>
				
			
					<td><?php if ($assignedrole['Sent_to_AGL'] == NULL) {
									echo 'No';
								}else{
									echo date('jS F Y',strtotime($assignedrole['Sent_to_AGL']));
								}?></td>
					<td><?php if($assignedrole['badge_printed'] == 0) {
									echo 'No';
								}
								else {
									echo 'Yes';
								}?></td>
					<td class="actions">
						<?php echo $this->Html->link('Edit', array('controller' => 'AssignedRoles',
																	'action' => 'edit',
																	$assignedrole['Role_Assigned_ID']
																	)
													); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'AssignedRoles',
																			'action' => 'delete', 
																			$assignedrole['Role_Assigned_ID']), 
																			null, 
																			__('Are you sure you want to remove role "%s" from %s %s?', 
																				$assignedrole['Role']['RoleName'],
																				$data['Person']['Nickname'],
																				$data['Person']['Last_Name'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="actions">
						<?php echo $this->Html->link('Add New Role', 
														array('controller' => 'AssignedRoles',
																'action' => 'add',
																$data['Application']['Application_ID'],
																$data['Person']['Person_ID']
																)
													); ?>
					</td>
				</tr>
			</table>
		</div>
		<div id="tabs-experience">
			<table>
				<tr><td>Worked with children:</td><td><?php if($data['Application']['Previous_experience'] == 1) 
																echo 'Yes'; 
															else 
																echo 'No' ;?></td>
					<td rowspan = "5"><?php echo $data['Application']['Experience_notes'];?></td> 
				</tr>
				<tr><td>Special needs:</td><td><?php if($data['Application']['Special_needs'] == 1) 
																echo 'Yes'; 
															else 
																echo 'No' ;?></td></tr>
				<tr><td>Language:</td><td><?php if($data['Application']['Language'] == 1) 
																echo 'Yes'; 
															else 
																echo 'No' ;?></td></tr>
				<tr><td>First Aid Certificate:</td><td><?php if($data['Application']['First_aid_cert'] == 1) 
																echo 'Yes'; 
															else 
																echo 'No' ;?></td></tr>
				<tr><td>Helped before:</td><td><?php if($data['Application']['Helped_before'] == 1) 
																echo 'Yes'; 
															else 
																echo 'No' ;?></td></tr>
			</table>
		</div>
		<div id="tabs-health">
			<table>
				<tr><td>Health Issues:</td><td><?php if($data['Application']['Medical'] == 0) 
																echo 'None'; 
															else 
																echo $data['Application']['Medical_note'] ;?></td>
				</tr>
			</table>
		</div>
		<div id="tabs-declaration">
			<table>
				<tr><td>Parental Consent:</td><td><?php switch ($data['Application']['Parental_consent']){
														case 1:
														  echo 'No';
														  break;
														case 2:
														  echo 'Yes';
														  break;
														case 3:
														  echo 'Not required';
														  break;
														default:
														  echo 'Should never get here';
														} ;?></td>
				</tr>
				<tr><td>Declaration Signed:</td><td><?php if($data['Application']['Declaration_signed'] == 0) 
																echo 'No'; 
															else 
																echo $data['Application']['Signature'] ;?></td>
				</tr>
			</table>
		</div>
		<div id="tabs-crb">
			<table>
				<tr><th>CRB Disclosure</th><th></th><th>Actions</th></tr>
				<?php
					$editbutton = '<td class="actions">'. $this->Html->link('Edit', array('action' => 'editcrb', 
																							$data['Application']['Application_ID']
																							)
																			). '</td>';
					
				 	switch ($data['Application']['CRB']){
														case 0:
														  echo '<tr><td>Not Required</td><td></td>'.$editbutton.'</tr>';
														  break;
														case 1:
														  echo '<tr><td>None</td><td></td>'.$editbutton.'</tr>';
														  break;
														case 2:
														  echo ''; //Yes
														  break;
														case 3:
														  echo '<tr><td>Applied For</td><td></td>'.$editbutton.'</tr>';
														  break;
														default:
														  echo '<tr><td>Should never get here</td><td></td>'.$editbutton.'</tr>';
														} ;
					if ($data['Application']['CRB'] == 2) {
							echo '<tr><td>Type: '; 
							echo '<br/>Date: ';
							echo '<br/>Number: ';
							echo '</td><td>';
							switch ($data['Application']['CRB_type']){
																case 0:
																  echo 'None';
																  break;
																case 1:
																  echo 'Basic';
																  break;
																case 2:
																  echo 'Standard';
																  break;
																case 3:
																  echo 'Enhanced';
																  break;
																case 4:
																  echo 'Lighthouse';
																  break;
																default:
																  echo 'Should never get here';
																} ;
							echo '<br/>';
							echo date('jS F Y',strtotime($data['Application']['CRB_date']));
							echo '<br/>';
							echo $data['Application']['CRB_number'];
							echo '</td>'.$editbutton.'</tr>';
							echo '<tr><td>CRB Notes:</td><td>';
							echo $data['Application']['CRB_note'];
							echo '</td></tr>';
				 		} 
				 ?>
			</table>
		</div>
		<div id="tabs-lh-address">
			<table>
				<tr><td>Address during Lighthouse:</td><td><?php echo $data['Application']['LH_Address_1'].'<br/>';
												if(strlen($data['Application']['LH_Address_2']) > 0)
													echo  $data['Application']['LH_Address_2'].'<br/>';
												echo $data['Application']['LH_Town'].'<br/>'.
												$data['Application']['LH_County'].'<br/>'.
												$data['Application']['LH_Post_Code'];?></td></tr>
				<tr><td>Telephone:</td><td><?php echo $data['Application']['LH_Telephone'];?></td></tr>
			</table>
		</div>
		<div id="tabs-emergency-contact">
			<table>
				<tr><td>Contact Name:</td><td><?php echo $data['Application']['Emergency_contact'];?></td></tr>
				<tr><td>Telephone 1:</td><td><?php echo $data['Application']['Emergency_phone1'];?></td></tr>
				<tr><td>Telephone 2:</td><td><?php echo $data['Application']['Emergency_phone2'];?></td></tr>
				<tr><td>Relationship:</td><td><?php echo $data['Application']['Emergency_relationship'];?></td></tr>
			</table>
		</div>
		<div id="tabs-notes">
			<table>
				<tr><th>Notes</th><th>Actions</th></tr>
				<tr>
					<td><?php echo $data['Application']['Notes'];?> </td>
					<td class="actions">
						<?php echo $this->Html->link('Edit', array('action' => 'editnotes',	$data['Application']['Application_ID'])); ?>
					</td>
				</tr>
			</table>
		</div>
		<div id="tabs-confirmation">
			<table>
				<tr>
					<td>Confirmation e-mail sent:</td>
					<td><?php if($data['Application']['Confirmation_email_sent'] == 0) {
					echo 'No';}
					else {
					echo date('jS F Y',strtotime($data['Application']['Confirmation_email_date']));}?>
					</td>
				</tr>
			</table>
		</div>
		<div id="tabs-confidential">
			<table>
			<?php
			if($data['Application']['Conviction'] <> 0)
			echo '<tr><td>Conviction:</td><td>';
			echo $data['Application']['Conviction_details'];
			echo '</td></tr>';
			if($data['Application']['Caution'] <> 0)
			echo '<tr><td>Caution:</td><td>';
			echo $data['Application']['Caution_details'];
			echo '</td></tr>';
			if($data['Application']['Court'] <> 0)
			echo '<tr><td>Court:</td><td>';
			echo $data['Application']['Court_details'];
			echo '</td></tr>';
			if($data['Application']['Conduct'] <> 0)
			echo '<tr><td>Conduct:</td><td>';
			echo $data['Application']['Conduct_details'];
			echo '</td></tr>';
			if($data['Application']['Childprotection'] <> 0)
			echo '<tr><td>Childprotection:</td><td>';
			echo $data['Application']['Childprotection_details'];
			echo '</td></tr>';
			if($data['Application']['Healthproblems'] <> 0)
			echo '<tr><td>Health problems:</td><td>';
			echo $data['Application']['Healthproblems_details'];
			echo '</td></tr>';
			if($data['Application']['Othername'] <> 0)
			echo '<tr><td>Other Names:</td><td>';
			echo $data['Application']['Othername_details'];
			echo '</td></tr>';
			if($data['Application']['Otheraddress'] <> 0)
			echo '<tr><td>Other Address:</td><td>';
			echo $data['Application']['Otheraddress_details'];
			echo '</td></tr>';
			?>
			</table>
		</div>
	</div>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Helper Summary'), array('controller' => 'applications','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Helpers'), array('controller' => 'applications','action' => 'helperlist')); ?></li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>

<?php echo $this->Html->script('ajaxscript'); // script for ajax call?>
