<!-- File: /app/View/Applications/helperlist.ctp -->
<?php //debug($applications); ?>

<div class="index">
<h2>Helpers - <?php echo $this->Session->read('Filter.Year');
					echo ' ('.$problemFilterOptions[$this->Session->read('Filter.Problem')].')'?></h2>
<table>
    <tr>
		<th><?php echo 'Title';?></th>
		<th><?php echo $this->Paginator->sort('Person.First_Name', 'First Name');?></th>
		<th><?php echo $this->Paginator->sort('Person.Last_Name', 'Last Name');?></th>
		<th><?php echo $this->Paginator->sort('Person.Person_ID', 'Badge Number');?></th>
		<th><?php echo $this->Paginator->sort('Person.Application.Application_ID', 'Application Ref');?></th>
		<th class="actions"><?php echo __('Actions');?></th>
    </tr>

    <?php 
//    	$count = 0;
    	foreach ($applications as $application): 
/*     		if ($count > 0) {
    			$prev = $applications[$count - 1]['Application']['Application_ID'];
			} else {
				$prev = 0;
			}
			if ($count < count($applications) - 1) {
				$next = $applications[$count + 1]['Application']['Application_ID'];
			} else {
				$next = 0;
			}
			$count++;
 */    		?>
		<tr>
				<td><?php echo $application['Person']['Title']; ?></td>
				<td><?php echo $application['Person']['First_Name']; 
							if (!($application['Person']['First_Name'] == $application['Person']['Nickname'])) {
								echo ' ('.$application['Person']['Nickname'].')';
							}?></td>
				<td><?php echo $application['Person']['Last_Name']; ?></td>
				<td><?php echo $application['Person']['Person_ID']; ?></td>
				<td><?php echo $application['Application']['Application_ID']; ?></td>
				<td class="actions">
					<?php 
						//echo $this->Html->link('Details', array('action' => 'view', $application['Application']['Application_ID'])); 
						echo $this->Html->link('Application Details', 
													array(	'action' => 'helper', 
															$application['Application']['Application_ID'],
															$application['Person']['Person_ID'], 
															$this->Session->read('Filter.Year')//,
															//$prev,
															//$next
															)
												); 
					?>
					<?php 
						echo $this->Form->postLink('Delete Application', array('controller' => 'Applications',
																		'action' => 'delete', 
																		$application['Application']['Application_ID']), 
																		null, 
																		__('Are you sure you want to delete the "%s" application from %s %s?', 
																		$this->Session->read('Filter.Year'),
																		$application['Person']['Nickname'],
																		$application['Person']['Last_Name'])); 
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

<div class="actions">
	<h3>Filters</h3>
	<?php echo $this->Form->create('Filter');?>
	<ul>
		<li><?php echo $this->Form->input('Year', array(
				    'options' => $LHYears,
					'default' => $this->Session->read('Filter.Year')
				    //'empty' => '(choose one)'
					));?></li>
		<li><?php echo $this->Form->input('ApplicationProblem', array(
			'options' => $problemFilterOptions,
		    'default' => $this->Session->read('Filter.Problem')
					    //'empty' => '(choose one)'
			));?></li>
	</ul>
	<?php echo $this->Form->end('Update Filter');?>
	
	<h3>Helper Search</h3>	
    <?php echo $this->Form->create('Person',array('action'=>'search'));?>
    <?php
        echo $this->Form->input('helpername',array('type'=>'text','id'=>'helpername','label'=>' '));
        echo $this->Form->input('id',array('type'=>'hidden'));
    ?>
    <?php echo $this->Form->end(__('Show Helper', true));?>
	    
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Helper Summary'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>

<?php echo $this->Html->script('ajaxautocomplete'); // script for ajax call?>