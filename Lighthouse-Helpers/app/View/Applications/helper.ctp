<!-- File: /app/View/Application/helper.ctp -->
<?php //debug($data) ?>

<div class="index">
<table>
	<tr>
		<th>
			<?php echo	'Helper: '.
						$data['Application']['Person']['Nickname'].' '.
						$data['Application']['Person']['Last_Name'];
			?>
		</th>
		<th>
				<?php echo 'Number: '.$data['Application']['Application']['Application_ID']; ?>
		</th>
		<th>
				<?php echo 'Year: '.$data['Application']['Application']['Year']; ?>
		</th>
	</tr>
</table>



<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Helper</a></li>
		<li><a href="ajaxreferee">Referees</a></li>
		<li><a href="#tabs-3">References</a></li>
		<li><a href="ajaxhelpoffered">Help Offered</a></li>
		<li><a href="ajaxroleassigned">Roles Assigned</a></li>
		<li><a href="ajaxexperience">Experience</a></li>
		<li><a href="ajaxhealth">Health</a></li>
		<li><a href="ajaxdeclaration">Declaration</a></li>
		<li><a href="ajaxcrb">CRB</a></li>
		<li><a href="ajaxlhaddress">LH Address</a></li>
		<li><a href="ajaxemergencycontact">Emergency Contact</a></li>
		<li><a href="ajaxnotes">Notes</a></li>
		<li><a href="ajaxconfirmation">Confirmation</a></li>
		<li><a href="ajaxconfidential">Confidential</a></li>
	</ul>
	<div id="tabs-1">
		<table>
			<tr><td>Address:</td><td><?php echo $data['Application']['Person']['Address_1'].'<br/>';
											if(strlen($data['Application']['Person']['Address_2']) > 0)
												echo  $data['Application']['Person']['Address_2'].'<br/>';
											echo $data['Application']['Person']['Town'].'<br/>'.
											$data['Application']['Person']['County'].'<br/>'.
											$data['Application']['Person']['Post_Code'];?></td></tr>
			<tr><td>e-mail:</td><td><?php echo $data['Application']['Person']['email'];?></td></tr>
			<tr><td>Telephone Home:</td><td><?php echo $data['Application']['Person']['Telephone_1'];?></td></tr>
			<tr><td>Telephone Daytime:</td><td><?php echo $data['Application']['Person']['Telephone_2'];?></td></tr>
			<tr><td>Date of Birth:</td><td><?php echo date('jS F Y',strtotime($data['Application']['Person']['Date_of_birth']));?></td></tr>
			<tr><td>Church Attended:</td><td><?php echo $data['Church']['Church']['Name'];?></td></tr>
		</table>
	</div>
	<div id="tabs-2">
		<table>
		</table>
	</div>
	<div id="tabs-3">
		<table>
		</table>
	</div>
</div>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Helpers'), array('action' => 'helperlist')); ?></li>
	</ul>
</div>
