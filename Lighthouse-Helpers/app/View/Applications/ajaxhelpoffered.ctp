<?php //debug($data);?>
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
