<?php echo $javascript->link('jquery-1.6.1.js'); ?>
<?php echo $javascript->link('assets.js'); ?>
<div class="items form">
<?php echo $this->Form->create('Item');?>
		<h2>Edit Asset</h2>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('Item.name');
		echo '<div class="input text">';
		echo $this->Form->label('Item.note', 'Note');
		echo $this->Form->textarea('Item.note', array('label' => 'Notes'));
		echo '</div>';
		echo '<h4>Additional Information</h4>';
		echo '<div id="fields">';
		if (isset($this->data['Field'])) {
		    $i = 0;
		    foreach ($this->data['Field'] as $field) {
		        echo $form->hidden("Field.$i.id", array('div' => false));
		        echo '<div class="input text"><span>';
		        echo $form->input("Field.$i.name", array('label' => '', 'div' => false));
		        echo '</span><span>';
		        echo $form->input("Field.$i.value", array('label' => '', 'div' => false));
		        echo '</span></div>';
		        $i++;
		    }
		}
		echo '</div>';
		echo $this->Form->button('Add Field', array('OnClick' => 'addField()'));
	?>
<?php echo $this->Form->end(__('Save Asset', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete Asset', true), array('action' => 'delete', $this->Form->value('Item.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Item.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Asset', true), array('action' => 'index'));?></li>

	</ul>
</div>