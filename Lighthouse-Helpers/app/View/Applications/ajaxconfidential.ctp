<table>
	<?php 
		if($data['Application']['Conviction'] <> 0)
			echo '<tr><td>Conviction:</td><td>';
			echo $data['Application']['Conviction_details'];
			echo '</td></tr>';
		if($data['Application']['Caution'] <> 0)
			echo '<tr><td>Caution:</td><td>';
			echo $data['Application']['Caution_details'];
			echo '</td></tr>';
		if($data['Application']['Court'] <> 0)
			echo '<tr><td>Court:</td><td>';
			echo $data['Application']['Court_details'];
			echo '</td></tr>';
		if($data['Application']['Conduct'] <> 0)
			echo '<tr><td>Conduct:</td><td>';
			echo $data['Application']['Conduct_details'];
			echo '</td></tr>';
		if($data['Application']['Childprotection'] <> 0)
			echo '<tr><td>Childprotection:</td><td>';
			echo $data['Application']['Childprotection_details'];
			echo '</td></tr>';
		if($data['Application']['Healthproblems'] <> 0)
			echo '<tr><td>Health problems:</td><td>';
			echo $data['Application']['Healthproblems_details'];
			echo '</td></tr>';
		if($data['Application']['Othername'] <> 0)
			echo '<tr><td>Other Names:</td><td>';
			echo $data['Application']['Othername_details'];
			echo '</td></tr>';
		if($data['Application']['Otheraddress'] <> 0)
			echo '<tr><td>Other Address:</td><td>';
			echo $data['Application']['Otheraddress_details'];
			echo '</td></tr>';
	?>
</table>
