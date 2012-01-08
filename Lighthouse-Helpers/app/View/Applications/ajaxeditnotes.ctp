<?php //debug($data)?>
<h3>Edit Notes</h3>
<table>
	<?php echo $this->Form->create('Application');?>
	<tr><th>Notes</th><th class="actions">Actions</th></tr>
	<tr>
		<td><?php echo $this->Form->input('notes', array('value'=>$data['Application']['Notes'],
								'rows'=>3)
					);?> </td>
		<td class="actions">
					<?php echo $this->Js->submit('Save', array('update' => '#tabs-12'));					?>
		</td>
	</tr>
</table>
<?php echo $this->Js->writeBuffer(); // Write cached scripts?>
