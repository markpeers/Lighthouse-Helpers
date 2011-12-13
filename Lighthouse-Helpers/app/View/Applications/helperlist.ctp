<!-- File: /app/View/Applications/helperlist.ctp -->
<!-- <?php //debug($lighthouseyears); ?> -->
<h2>Helpers <?php echo $this->Session->read('Filter.Year')?></h2>

<div class="index">
<table>
    <tr>
		<th><?php echo 'Title';?></th>
		<th><?php echo $this->Paginator->sort('Person.First_Name', 'First Name');?></th>
		<th><?php echo $this->Paginator->sort('Person.Last_Name', 'Last Name');?></th>
		<th><?php echo 'Year';?></th>
		<th class="actions"><?php echo __('Actions');?></th>
    </tr>

    <!-- Here is where we loop through our $people array, printing out person info -->

    <?php foreach ($applications as $application): ?>
		<tr>
				<td><?php echo $application['Person']['Title']; ?></td>
				<td><?php echo $application['Person']['First_Name']; ?></td>
				<td><?php echo $application['Person']['Last_Name']; ?></td>
			    <td><?php echo $application['Application']['Year']; ?></td>
				<td class="actions">
					<?php 
						//echo $this->Html->link('Details', array('action' => 'view', $application['Application']['Application_ID'])); 
						echo $this->Html->link('Application Details', 
													array(	'action' => 'helper', 
															$application['Application']['Application_ID'],
															$application['Person']['Person_ID'], 
															$this->Session->read('Filter.Year'))); 
					?>
				</td>
		</tr>
    <?php endforeach; ?>

</table>

<div class = "pagination">
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
</div>

<div class="filter actions">
	<h3>Filters</h3>
	<?php echo $this->Form->create('Filter');?>
	<table>
		<tr>
			<td><?php echo $this->Form->input('Year', array(
					    'options' => $LHYears,
						'default' => $this->Session->read('Filter.Year')
					    //'empty' => '(choose one)'
						));?></td>
		</tr>
	</table>
	<?php echo $this->Form->end('Update filter');?>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Helper Summary'), array('action' => 'index')); ?></li>
	</ul>
</div>

