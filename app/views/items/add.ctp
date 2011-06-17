<?php echo $javascript->link('jquery-1.6.1.js'); ?>
<?php echo $javascript->link('assets.js'); ?>
<script>
	function addFields() {
		var selectedTemplate = $('#ItemTemplate').val();
		var functionname = 'addFields' + selectedTemplate +'()';
		
		$('#fields > div.templated').remove();
		
		eval(functionname);
		event.preventDefault();
	}
	
	<?php 
		$i = 0;
		foreach ($templates as $template_key => $template) { 
		echo "function addFields".$i." () { ";
			foreach($template['fields'] as $field_key => $field) {
				echo "addField('".trim($field[0])."',".(!empty($field[1]) ? "'".trim($field[1])."'" : "''").", true);event.preventDefault();";
			}
		echo '}';
		$i++;
		}
	?>
</script>

<div class="items form">
<?php echo $this->Form->create('Item');?>
		<h2>Add New Asset</h2>
	<?php
		echo $this->Form->input('Item.name');
		echo '<div class="input text">';
		echo $this->Form->label('Item.note', 'Note');
		echo $this->Form->textarea('Item.note', array('label' => 'Notes'));
		echo '</div>';
		echo $this->Form->select('template', $templateselect, null, array('empty' => false));
		echo $this->Form->button('Import fields from template', array('OnClick' => 'addFields()'));
		echo '<h4>Additional Information</h4>';
		echo '<div id="fields"></div>';
		echo $this->Form->button('Add Field', array('OnClick' => 'addField(\'\',\'\', false)'));
	?>
<?php echo $this->Form->end(__('Add Asset', true));?>
</div>
<div class="actions">
	<h3></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Assets', true), array('action' => 'index'));?></li>
	</ul>
</div>