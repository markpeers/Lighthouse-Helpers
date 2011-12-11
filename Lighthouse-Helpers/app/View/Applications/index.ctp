<!-- File: /app/View/Applications/index.ctp -->
<!-- <?php //debug($lighthouseyears); ?> -->
<h2>Helper Summary <?php echo $this->Session->read('Filter.Year')?></h2>
<table>
	<tr>
		<td>Total helpers: <?php echo $summarys['TotalHelpers']; ?></td>
	</tr>
</table>
<div class="index">
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
//					    'options' => $summarys['LHYears'],
						'options' => $this->Session->read('Filter.Years'),
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
		<li><?php echo $this->Html->link(__('List Helpers'), array('action' => 'helperlist')); ?></li>
	</ul>
</div>


<?php //print_r($summarys['LHYears']); ?>
