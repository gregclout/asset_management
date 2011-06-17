<div class="Relatedfiles form">
<?php echo $this->Form->create('Relatedfile');?>
	<fieldset>
		<legend><?php __('Add Relatedfile'); ?></legend>
	<?php
		echo $this->Form->input('item_id');
		echo $this->Form->input('file_url');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Related files', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>