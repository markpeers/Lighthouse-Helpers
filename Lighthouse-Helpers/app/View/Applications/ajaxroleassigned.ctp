<?php //debug($data);?>
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
