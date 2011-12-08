<table>
	<tr><td>Address during Lighthouse:</td><td><?php echo $data['Application']['LH_Address_1'].'<br/>';
									if(strlen($data['Application']['LH_Address_2']) > 0)
										echo  $data['Application']['LH_Address_2'].'<br/>';
									echo $data['Application']['LH_Town'].'<br/>'.
									$data['Application']['LH_County'].'<br/>'.
									$data['Application']['LH_Post_Code'];?></td></tr>
	<tr><td>Telephone:</td><td><?php echo $data['Application']['LH_Telephone'];?></td></tr>
</table>
