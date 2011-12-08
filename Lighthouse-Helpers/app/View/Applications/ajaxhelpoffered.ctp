<table>
	<tr><th>Role</th><th>Sessions</th></tr>
<?php foreach ($application['OfferedRoles'] as $offeredrole): ?>
	<tr><td><?php echo $offeredrole['Role']['RoleName'];?></td></tr>
<?php endforeach; ?>
</table>
