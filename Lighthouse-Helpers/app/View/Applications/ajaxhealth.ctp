<table>
	<tr><td>Health Issues:</td><td><?php if($data['Application']['Medical'] == 0) 
													echo 'None'; 
												else 
													echo $data['Application']['Medical_note'] ;?></td>
	</tr>
</table>
