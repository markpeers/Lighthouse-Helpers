<!-- File: /app/View/Church/index.ctp -->

<h1>Helpers</h1>
<table>
    <tr>
        <th>Id</th>
		<th>Church</th>
    </tr>

    <!-- Here is where we loop through our $churches array, printing out church info -->

    <?php foreach ($churches as $church): ?>
    <tr>
        <td><?php echo $church['Church']['Church_ID']; ?></td>
        <td>
			<?php
				echo $this->Html->link(
						$church['Church']['Name'],
						array(
							'controller' => 'churches',
							'action' => 'view',
							$church['Church']['Church_ID'])); 
			?>
		</td>
    </tr>
    <?php endforeach; ?>

</table>
