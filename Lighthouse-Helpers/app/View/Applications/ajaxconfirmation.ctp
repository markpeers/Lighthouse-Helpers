<table>
	<tr><td>Confirmation e-mail sent:</td><td><?php if($data['Application']['Confirmation_email_sent'] == 0) 
													echo 'No'; 
												else 
													echo date('jS F Y',strtotime($data['Application']['Confirmation_email_date']));?></td></tr>
</table>
