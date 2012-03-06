<?php
$cakeDescription = 'Lighthouse Great Missenden - Helper Registration System';
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('lh-helpers');
		echo $this->Html->css('ui-lightness/jquery-ui-1.8.16.custom');
		echo $this->Html->css('menu1');
		echo $this->Html->css('print', null,array('media' => 'print')); //css forprinted versions of pages
		
		echo $this->Html->script('jquery-1.7.min'); // Include jQuery library
		echo $this->Html->script('jquery-ui-1.8.16.custom.min'); // Include jQuery-UI library
//		echo $this->Html->script('ajaxscript'); // script for ajax call
		
		echo $scripts_for_layout;
	?>

</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://www.lighthousemissenden.org.uk'); ?></h1>
		</div>
		
		<div id="content">
		
			<?php //echo $this->element('menu1'); ?> 
		
			<?php echo $this->Session->flash(); ?>
						
			<?php echo $content_for_layout; ?>
			
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt'=> $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php 
		echo $this->Js->writeBuffer(); // Write cached scripts
		echo $this->element('sql_dump'); 
	?>
</body>
</html>
