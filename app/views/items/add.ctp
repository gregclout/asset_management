<?php
	$jsBlock = 'var templateFields = [];';

	$i = 0;
	foreach ($templates as $template) {
		$jsBlock .= "\n".'templateFields['.$i.'] = [];';
		$j = 0;
		foreach($template['fields'] as $field) {
			$jsBlock .= "\n".'templateFields['.$i.']['.$j.'] = [\''.trim($field[0]).'\', \''.(!empty($field[1]) ? trim($field[1]) : '').'\'];';
			$j++;
		}
		$i++;
	}
	
	$javascript->codeBlock($jsBlock, array('inline' => false));
	$javascript->link('jquery-1.6.1.js', false);
	$javascript->link('assets.js', false);
?>

<div class="items form">
<?php echo $this->Form->create('Item', array('type' => 'file'));?>
		<h2>Add New Asset</h2>
	<?php
		echo $this->Form->input('Item.name');
		echo '<div class="input text">';
		echo $this->Form->label('Item.note', 'Note');
		echo $this->Form->textarea('Item.note', array('label' => 'Notes'));
		echo '</div>';
		echo $this->Form->select('template', $templateselect, null, array('empty' => false));
		echo $this->Form->button('Import fields from template', array('id' => 'importfields'));
		echo '<h4>Additional Information</h4>';
		echo '<div id="fields"></div>';
		echo $this->Form->button('Add Field', array('id' => 'addfield'));
		echo '<h4>Related Files</h4>';
		echo '<div id="files"></div>';
		echo $this->Form->button('Add File', array('id' => 'addfile'));
	?>
<?php echo $this->Form->end(__('Add Asset', true));?>
</div>
<div class="actions">
	<h3></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Assets', true), array('action' => 'index'));?></li>
	</ul>
</div>