<?php //debug($data)?>
<table>
	<tr><th>Notes</th><th class="actions">Actions</th></tr>
	<tr>
		<td><?php echo $data['Application']['Notes'];?> </td>
		<td class="actions">
			<?php echo $this->Js->link('Edit', 
										array('action' => 'editnotes', $data['Application']['Application_ID']), 
										array('update' => '#tabs-12',
												'data' => array('step'=>'edit')
												));?>
		</td>
	</tr>
</table>
<?php echo $this->Js->writeBuffer(); // Write cached scripts?>
