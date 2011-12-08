<table>
	<tr><td>CRB Disclosure:</td><td><?php switch ($data['Application']['CRB']){
											case 1:
											  echo 'None';
											  break;
											case 2:
											  echo ''; //Yes
											  break;
											case 3:
											  echo 'Applied For';
											  break;
											default:
											  echo 'Should never get here';
											} ;?></td>
	</tr>
	<?php if ($data['Application']['CRB'] = 2)
		echo '<tr><td>Type: '; 
		echo '<br/>Date: ';
		echo '<br/>Number: ';
		echo '</td><td>';
		switch ($data['Application']['CRB_type']){
											case 0:
											  echo 'None';
											  break;
											case 1:
											  echo 'Basic';
											  break;
											case 2:
											  echo 'Standard';
											  break;
											case 3:
											  echo 'Enhanced';
											  break;
											case 4:
											  echo 'Lighthouse';
											  break;
											default:
											  echo 'Should never get here';
											} ;
		echo '<br/>';
		echo date('jS F Y',strtotime($data['Application']['CRB_date']));
		echo '<br/>';
		echo $data['Application']['CRB_number'];
		echo '</td></tr>';
	?>
	<tr><td>CRB Notes:</td><td><?php echo $data['Application']['CRB_note']; ?></td></tr>
</table>
