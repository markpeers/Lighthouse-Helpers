<!-- File: /app/View/Applications/printhelperlist.ctp -->
<?php //debug($applications); ?>

<div class="index">
<h2>Helpers - <?php echo __('%s (%s)',$this->Session->read('Filter.Year'),
									$problemFilterOptions[$this->Session->read('Filter.Problem')]);?></h2>
<table>
    <tr>
		<th>Name</th>
		<th>Telephone 1</th>
		<th>Telephone 2</th>
		<th>email</th>
    </tr>

    <?php foreach ($applications as $application): ?>
		<tr>
			<td><?php if (!($application['Person']['First_Name'] == $application['Person']['Nickname'])) {
							$nickname = __(' (%s)',$application['Person']['Nickname']);
						} else {
							$nickname = null;
						}
						echo __('%s %s%s %s',$application['Person']['Title'],
											$application['Person']['First_Name'],
											$nickname,
											$application['Person']['Last_Name']);?>
			<td><?php echo $application['Person']['Telephone_1'];?></td>
			<td><?php echo $application['Person']['Telephone_2']; ?></td>
			<td><?php echo $application['Person']['email']; ?></td>
		</tr>
    <?php endforeach; ?>

</table>

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
	
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Helper Summary'), array('action' => 'index')); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('Print Requests'), '', array('class' => 'printMe')); ?></li>
		<li><?php echo $this->Html->link(__('Cancel Print'), array('action' => 'helperlist')); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>

