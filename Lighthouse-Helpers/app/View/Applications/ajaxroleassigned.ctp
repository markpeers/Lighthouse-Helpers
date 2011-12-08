<?php debug($data);?>
<table>
	<tr><th>Role</th><th>Sessions</th><th>Sent to Leader</th><th>Badge Printed</th></tr>
<?php foreach ($data as $assignedrole): ?>
	<tr><td><?php echo $assignedrole['Role']['RoleName'];?></td>
		<td>Sessions go here</td>
		<td><?php if ($assignedrole['AssignedRole']['Sent_to_AGL'] == NULL) {
						echo 'No';
					}else{
						echo date('jS F Y',strtotime($assignedrole['AssignedRole']['Sent_to_AGL']));
					}?></td>
		<td><?php if($assignedrole['AssignedRole']['badge_printed'] == 0) {
						echo 'No';
					}
					else {
						echo 'Yes';
					}?></td>
	</tr>
<?php endforeach; ?>
</table>
