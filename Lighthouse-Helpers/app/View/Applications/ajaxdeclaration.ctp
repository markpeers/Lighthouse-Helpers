<table>
	<tr><td>Parental Consent:</td><td><?php switch ($data['Application']['Parental_consent']){
											case 1:
											  echo 'No';
											  break;
											case 2:
											  echo 'Yes';
											  break;
											case 3:
											  echo 'Not required';
											  break;
											default:
											  echo 'Should never get here';
											} ;?></td>
	</tr>
	<tr><td>Declaration Signed:</td><td><?php if($data['Application']['Declaration_signed'] == 0) 
													echo 'No'; 
												else 
													echo $data['Application']['Signature'] ;?></td>
	</tr>
</table>
