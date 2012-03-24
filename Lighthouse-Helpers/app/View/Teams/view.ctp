<!-- File: /app/View/Teams/view.ctp -->
<?php //debug($rolegroup)?>
<?php //debug($helpersbyrole)?>

<div class="index">
<h2><?php echo __('%s Team %s',$rolegroup,$this->Session->read('Filter.Year'));?></h2>
<table>
<?php foreach ($helpersbyrole as $role => $helpers): ?>
	<tr>
		<th><h3><?php echo $role?></h3></th>
		<th></th>
		<th></th>
		<th></th>
		<th class="actions"></th>
	</tr>
    <tr>
		<th>Name</th>
		<th>Telephone 1</th>
		<th>Telephone 2</th>
		<th>email</th>
		<th class="actions"><?php echo __('Actions');?></th>
    </tr>

    <?php foreach ($helpers as $application): ?>
		<tr>
			<td><?php echo __('%s %s',$application['Person']['Nickname'],
										$application['Person']['Last_Name']);?>
			<td><?php echo $application['Person']['Telephone_1'];?></td>
			<td><?php echo $application['Person']['Telephone_2']; ?></td>
			<td><?php echo $application['Person']['email']; ?></td>
			<td class="actions">
				<?php 
					//echo $this->Html->link('Details', array('action' => 'view', $application['Application']['Application_ID'])); 
					echo $this->Html->link('Application Details', 
												array(	'controller' => 'applications', 'action' => 'helper', 
														$application['Application'][0]['Application_ID'],
														$application['Person']['Person_ID'], 
														$application['Application'][0]['Year']//,
														//$prev,
														//$next
														)
											); 
				?>
			</td>
		</tr>
    <?php endforeach; ?>
    <tr>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td class="actions"></td>
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
		<li><?php //echo $this->Form->input('ApplicationProblem', array(
			//'options' => $problemFilterOptions,
		    //'default' => $this->Session->read('Filter.Problem')
					    //'empty' => '(choose one)'
			//));?></li>
	</ul>
	<?php echo $this->Form->end('Update Filter');?>
	
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Helper Summary'), array('controller' => 'applications','action' => 'index')); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('Print Team'), '', array('class' => 'printMe')); ?></li>
		<li><?php //echo $this->Html->link(__('Cancel Print'), array('action' => 'helperlist')); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>

<?php echo $this->Html->script('ajaxautocomplete'); // script for ajax call?>