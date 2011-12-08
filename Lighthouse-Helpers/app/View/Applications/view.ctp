<!-- File: /app/View/People/view.ctp -->

<h1>
	<?php echo	$person['Person']['Title'].' '.
				$person['Person']['First_Name'].' '.
				$person['Person']['Last_Name'];
	?>
</h1>

<table>
	<tr><td>Address</td><td><?php echo $person['Person']['Address_1'];?></td></tr>
	<tr><td>&nbsp</td><td><?php echo $person['Person']['Address_2'];?></td></tr>
	<tr><td>&nbsp</td><td><?php echo $person['Person']['Town'];?></td></tr>
	<tr><td>&nbsp</td><td><?php echo $person['Person']['County'];?></td></tr>
	<tr><td>&nbsp</td><td><?php echo $person['Person']['Post_Code'];?></td></tr>
</table>


