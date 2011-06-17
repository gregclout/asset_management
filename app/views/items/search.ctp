<div class="items index">
	<h2>Asset List</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th class="listname">Name</th>
			<th class="actions"></th>
	</tr>
	<?php
	$i = 0;
	foreach ($items as $item):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $item['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $item['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<div class="actions">
	<h3></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Assets', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('New Asset', true), array('action' => 'add')); ?></li>
	</ul>
</div>