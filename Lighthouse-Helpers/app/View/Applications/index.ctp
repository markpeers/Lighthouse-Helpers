<!-- File: /app/View/Applications/index.ctp -->
<?php //debug($summarys['team']); ?>
<?php //echo $this->element('menu1'); ?>

<div class="index">
	<h2>Helper Summary - <?php echo $this->Session->read('Filter.Year')?></h2>
	<table>
		<tr>
			<th>Helpers Registered</th>
			<?php if (in_array($summarys['user_role'], array('admin', 'reg_user'))) {?>
			<th>Helpers With No Reference</th>
			<th>Helpers With No Role Assigned</th>
			<th>Helpers With No CRB</th>
			<?php }?>
		</tr>
		<tr>
			<td><?php echo $summarys['TotalHelpers']; ?></td>
			<?php if (in_array($summarys['user_role'], array('admin', 'reg_user'))) {?>
			<td><?php echo $summarys['ReferenceNeedsAttentionCount']?></td>
			<td><?php echo $summarys['NoRoleCount']?></td>
			<td><?php echo $summarys['CRBNeedsAttentionCount']?></td>
			<?php }?>
		</tr>
	</table>
	<br />
	<table>
		<tr>
		<?php foreach ($summarys['AgeGroupHeader'] as $header) : ?>
			<th><?php  if (in_array($summarys['user_role'], array('admin', 'reg_user'))) {
							echo $this->Html->link($header, array('controller' => 'teams', 'action' => 'view', $header));
						} else {
							echo $header;
						}
			?></th>	 
		<?php endforeach;?>
		</tr>
		<?php foreach ($summarys['AgeGroupRoles'] as $rows) : ?>
		<tr>
			<td><?php  if (in_array($summarys['user_role'], array('admin', 'reg_user'))) {
							echo $this->Html->link($rows[0], array('controller' => 'teams', 'action' => 'view', $rows[0]), array('class'=>'nodecoration'));
						} else {
							echo $rows[0];
						}
			?></td>
			<?php for ($i=1; $i < count($rows); $i++) { ?>
				<td><?php echo $rows[$i];?></td>
			<?php } ?>
		</tr>
		<?php endforeach;?>
	</table>
	<br />
	<table>
		<tr>
		<?php foreach ($summarys['OtherRolesHeader'] as $header) : ?>
			<th><?php echo $header;?></th>	 
		<?php endforeach;?>
		</tr>
		<?php foreach ($summarys['OtherRoles'] as $rows) : ?>
		<tr>
			<td><?php if (in_array($summarys['user_role'], array('admin', 'reg_user'))) {
							echo $this->Html->link($rows[0], array('controller' => 'teams', 'action' => 'view', $rows[0]), array('class'=>'nodecoration'));
						}else{
							echo $rows[0];
						}
			?></td>
			<?php for ($i=1; $i < count($rows); $i++) { ?>
				<td><?php echo $rows[$i];?></td>
			<?php } ?>
		</tr>
		<?php endforeach;?>
		<?php 
			//echo $this->Html->tableHeaders($summarys['OtherRolesHeader']); 
			//echo $this->Html->tableCells($summarys['OtherRoles']);
		?>
	</table>
</div>
<div class="filter actions">
<h3>Filters</h3>
<?php echo $this->Form->create('Filter');?>
	<ul>
		<li><?php echo $this->Form->input('Year', array(
					'options' => $this->Session->read('Filter.Years'),
				    'default' => $this->Session->read('Filter.Year')
				    //'empty' => '(choose one)'
					));?></li>
		<li><?php if (in_array($summarys['user_role'], array('admin', 'reg_user'))) {
						echo $this->Form->input('ApplicationProblem', array(
						'options' => $summarys['problemFilterOptions'],
					    'default' => $this->Session->read('Filter.Problem')
					    //'empty' => '(choose one)'
						));
					} else {
						echo $this->Form->hidden('ApplicationProblem');
					}?></li>
	</ul>
	<?php echo $this->Form->end('Update Filter');?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php if (in_array($summarys['user_role'], array('admin', 'reg_user'))) {?>
		<li><?php echo $this->Html->link(__('List Helpers'), array('action' => 'helperlist')); ?></li>
		<?php }else{?>
		<li><?php echo $this->Html->link(__('List My Team'), array('controller' => 'teams','action' => 'view',$summarys['team'])); ?></li>
		<?php }?>
		<li>&nbsp;</li>
		<?php if (in_array($summarys['user_role'], array('admin', 'reg_user'))) {?>
		<li><?php echo $this->Html->link(__('Print Summary'), '', array('class' => 'printMe')); ?></li>
		<li><?php echo $this->Html->link(__('Send Confirmations'), array('controller' => 'emails','action' => 'sendconfirmation')); ?></li>
		<li><?php //echo $this->Html->link(__('Send Reminder Emails'), array('controller' => 'emails','action' => 'sendreminder')); ?></li>
		<li><?php echo $this->Html->link(__('Print Helper Application Forms'), array('controller' => 'applications','action' => 'printhelperapplication')); ?></li>
		<li><?php echo $this->Html->link(__('Reference Requests (print)'), array('controller' => 'references','action' => 'referencerequest')); ?></li>
		<li><?php echo $this->Html->link(__('Reference Requests (email)'), array('controller' => 'emails','action' => 'referencerequest')); ?></li>
		<li>&nbsp;</li>
		<?php }?>
		<?php if (in_array($summarys['user_role'], array('admin'))) {?>
		<li><?php echo $this->Html->link(__('Manage Users'), array('controller' => 'users')); ?></li>
		<li>&nbsp;</li>
		<?php }?>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>


<?php //print_r($summarys['LHYears']); ?>
