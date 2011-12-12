<?php debug($data);?>
<table>
<?php foreach ($data['RefereeTemp'] as $referee): ?>
	<tr><td><?php echo $referee['LastName'];?></td>
	</tr>
<?php endforeach; ?>
</table>
