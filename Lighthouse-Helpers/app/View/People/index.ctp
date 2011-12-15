<!-- File: /app/View/People/index.ctp -->
<div class="people index">
	<h2>Helpers</h2>
	<table>
		<tr>
			<th><?php echo $this->Paginator->sort('Person_ID');?></th>
			<th><?php echo $this->Paginator->sort('Title');?></th>
			<th><?php echo $this->Paginator->sort('First_Name');?></th>
			<th><?php echo $this->Paginator->sort('Last_Name');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
		</tr>

		<!-- Here is where we loop through our $people array, printing out person info -->

		<?php foreach ($people as $person): ?>
			<tr>
				<td><?php echo $person['Person']['Person_ID']; ?></td>
				<td><?php echo $person['Person']['Title']; ?></td>
				<td>
				    <?php echo $person['Person']['First_Name']; ?>
				</td>
				<td>
				    <?php echo $person['Person']['Last_Name']; ?>
				</td>
				<td class="actions">
					<?php 
						echo $this->Html->link('View', array('action' => 'view', $person['Person']['Person_ID'])); 
						echo $this->Html->link('Applications', 
													array('controller' => 'applications', 
															'action' => 'helper', 
															$person['Person']['Person_ID'], 
															'2011')); 
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
