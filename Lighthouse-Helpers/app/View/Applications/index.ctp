<!-- File: /app/View/Applications/index.ctp -->
<?php //debug($summarys['NoRole']); ?>
<?php //echo $this->element('menu1'); ?>
<h2>Helper Summary <?php echo $this->Session->read('Filter.Year')?></h2>
<div class="index">
	<table>
		<tr>
			<th>Helpers Registered</th>
			<th>Helpers With No Reference</th>
			<th>Helpers With No Role Assigned</th>
			<th>Helpers With No CRB</th>
		</tr>
		<tr>
			<td><?php echo $summarys['TotalHelpers']; ?></td>
			<td><?php echo $summarys['ReferenceNeedsAttentionCount']?></td>
			<td><?php echo $summarys['NoRoleCount']?></td>
			<td><?php echo $summarys['CRBNeedsAttentionCount']?></td>
		</tr>
	</table>
	<br />
	<table>
		<?php 
			echo $this->Html->tableHeaders($summarys['AgeGroupHeader']); 
			echo $this->Html->tableCells($summarys['AgeGroupRoles']);
		?>
	</table>
	<br />
	<table>
		<?php 
			echo $this->Html->tableHeaders($summarys['OtherRolesHeader']); 
			echo $this->Html->tableCells($summarys['OtherRoles']);
		?>
	</table>
</div>
<div class="filter actions">
<h3>Filters</h3>
<?php echo $this->Form->create('Filter');?>
	<table>
		<tr>
			<td><?php echo $this->Form->input('Year', array(
						'options' => $this->Session->read('Filter.Years'),
					    'default' => $this->Session->read('Filter.Year')
					    //'empty' => '(choose one)'
						));?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('ApplicationProblem', array(
				'options' => $summarys['problemFilterOptions'],
			    'default' => $this->Session->read('Filter.Problem')
						    //'empty' => '(choose one)'
				));?></td>
		</tr>
	</table>
	<?php echo $this->Form->end('Update Filter');?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Helpers'), array('action' => 'helperlist')); ?></li>
		<li><?php echo $this->Html->link(__('Send Confirmations'), array('controller' => 'emails','action' => 'sendconfirmation')); ?></li>
		<li><?php echo $this->Html->link(__('Send Reminder Emails'), array('controller' => 'emails','action' => 'sendreminder')); ?></li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>


<?php //print_r($summarys['LHYears']); ?>
