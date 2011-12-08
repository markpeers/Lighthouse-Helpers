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
