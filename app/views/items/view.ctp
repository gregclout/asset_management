<div class="actions">
	<h3></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Assets', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Edit Assets', true), array('action' => 'edit', $item['Item']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Asset', true), array('action' => 'delete', $item['Item']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $item['Item']['id'])); ?> </li>
	</ul>
</div>
<div class="items view">
<h2><?php echo $item['Item']['name']; ?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['note']; ?>
			&nbsp;
		</dd>
	</dl>
	<div class="related">
		<h4>Additional Information</h4>
		<?php if (!empty($item['Field'])):?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th class="col1"><?php __('Name'); ?></th>
			<th><?php __('Value'); ?></th>
		</tr>
		<?php
			$i = 0;
			foreach ($item['Field'] as $field):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
			<tr<?php echo $class;?>>
				<td><?php echo $field['name'];?></td>
				<td><?php echo $field['value'];?></td>
			</tr>
		<?php endforeach; ?>
		</table>
		<?php endif; ?>
		<h4>Related Files</h4>
		<?php if (!empty($item['Relatedfile'])):?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th class="col1">File</th>
			<th>Description</th>
		</tr>
		<?php
			$i = 0;
			foreach ($item['Relatedfile'] as $file):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
			<tr<?php echo $class;?>>
				<td><?php echo $this->html->link(str_replace('img/files/', '', $file['file_url']), '/'.$file['file_url']);?></td>
				<td><?php echo $file['description'];?></td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
	</div>
</div>
