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
			<li><a href="#tabs-1">Helper</a></li>
			<li><a href="#tabs-2">Referees Offered</a></li>
			<li><a href="#tabs-3">References</a></li>
			<li><a href="#tabs-4">Help Offered</a></li>
			<li><a href="#tabs-5">Roles Assigned</a></li>
			<li><a href="#tabs-6">Experience</a></li>
			<li><a href="#tabs-7">Health</a></li>
			<li><a href="#tabs-8">Declaration</a></li>
			<li><a href="#tabs-9">CRB</a></li>
			<li><a href="#tabs-10">LH Address</a></li>
			<li><a href="#tabs-11">Emergency Contact</a></li>
			<li><a href="#tabs-12">Notes</a></li>
			<li><a href="#tabs-13">Confirmation</a></li>
			<li><a href="#tabs-14">Confidential</a></li>
		</ul>
		<div id="tabs-1">
			<table>
				<tr>
					<td>Address:</td>
					<td><?php echo $data['Person']['Address_1'].'<br/>';
					if(strlen($data['Person']['Address_2']) > 0)
					echo  $data['Person']['Address_2'].'<br/>';
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
		<div id="tabs-2">
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
			</table>
		</div>
		<div id="tabs-3">
			<table>
				<tr><th>Referee</th><th>Reference Status</th><th>Reference Requested Date</th><th>Reference Received Date</th><th>Reference OK</th></tr>
				
			<?php foreach ($data['Person']['Reference'] as $reference): ?>
				<tr>
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
				</tr>
			<?php endforeach; ?>
				
			</table>
		</div>
		<div id="tabs-4">
			<table>
				<tr><th>Role</th><th>Sessions</th></tr>
			<?php foreach ($data['OfferedRole'] as $offeredrole): ?>
				<tr><td><?php echo $offeredrole['Role']['RoleName'];?></td>
					<td><?php foreach ($offeredrole['OfferedSession'] as $lhsession) {
						echo $lhsession['Session']['Description'].', ';
					}?></td>
				</tr>
			<?php endforeach; ?>
			</table>
		</div>
		<div id="tabs-5">
			<table>
				<tr><th>Role</th><th>Sessions</th><th>Sent to Leader</th><th>Badge Printed</th></tr>
			<?php foreach ($data['AssignedRole'] as $assignedrole): ?>
				<tr><td><?php echo $assignedrole['Role']['RoleName'];?></td>
					<td><?php foreach ($assignedrole['AssignedSession'] as $lhsession) {
						echo $lhsession['Session']['Description'].', ';
					}?></td>
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
				</tr>
			<?php endforeach; ?>
			</table>
		</div>
		<div id="tabs-6">
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
		<div id="tabs-7">
			<table>
				<tr><td>Health Issues:</td><td><?php if($data['Application']['Medical'] == 0) 
																echo 'None'; 
															else 
																echo $data['Application']['Medical_note'] ;?></td>
				</tr>
			</table>
		</div>
		<div id="tabs-8">
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
		<div id="tabs-9">
			<table>
				<tr><td>CRB Disclosure:</td><td><?php switch ($data['Application']['CRB']){
														case 1:
														  echo 'None';
														  break;
														case 2:
														  echo ''; //Yes
														  break;
														case 3:
														  echo 'Applied For';
														  break;
														default:
														  echo 'Should never get here';
														} ;?></td>
				</tr>
				<?php if ($data['Application']['CRB'] = 2)
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
					echo '</td></tr>';
				?>
				<tr><td>CRB Notes:</td><td><?php echo $data['Application']['CRB_note']; ?></td></tr>
			</table>
		</div>
		<div id="tabs-10">
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
		<div id="tabs-11">
			<table>
				<tr><td>Contact Name:</td><td><?php echo $data['Application']['Emergency_contact'];?></td></tr>
				<tr><td>Telephone 1:</td><td><?php echo $data['Application']['Emergency_phone1'];?></td></tr>
				<tr><td>Telephone 2:</td><td><?php echo $data['Application']['Emergency_phone2'];?></td></tr>
				<tr><td>Relationship:</td><td><?php echo $data['Application']['Emergency_relationship'];?></td></tr>
			</table>
		</div>
		<div id="tabs-12">
			<table>
				<tr><td><?php echo $data['Application']['Notes'];?> </td></tr>
			</table>
		</div>
		<div id="tabs-13">
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
		<div id="tabs-14">
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
	<h3>



	<?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Helpers'), array('action' => 'helperlist')); ?>
		</li>
	</ul>
</div>
