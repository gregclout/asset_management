<div class="Relatedfiles view">
<h2><?php  __('Relatedfile');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Relatedfile['Relatedfile']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($Relatedfile['Item']['name'], array('controller' => 'items', 'action' => 'view', $Relatedfile['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('File_url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Relatedfile['Relatedfile']['file_url']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Related file', true), array('action' => 'edit', $Relatedfile['Relatedfile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Related file', true), array('action' => 'delete', $Relatedfile['Relatedfile']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $Relatedfile['Relatedfile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Related files', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related file', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
