
<p>Dear <?php echo $helpername; ?></p>
<p>Thank you for your offer of help at Lighthouse <?php echo $lhyear; ?>.</p>
<p>Your details have been passed on to the following group leaders and they will contact you soon.</p>
<table>
	<tr><th>Role</th><th>Group Leader</th><th>Leader's Name</th><th>Phone</th><th>email</th></tr>
	<?php foreach ($roles as $role):?>
	<tr>
		<td><?php echo $role['RoleName']?></td>
		<td><?php echo $role['LeaderRole']?></td>
		<td><?php echo $role['LeaderName']?></td>
		<td><?php echo $role['LeaderPhone']?></td>
		<td><?php echo $role['LeaderEmail']?></td>
	</tr>
	<?php endforeach;?>
</table>
<p>If you have any queries, please contact us as soon as possible quoting your application reference number - <?php echo $application_id?>.</p>
<p>Lighthouse Helper's Registration Team</p>

 