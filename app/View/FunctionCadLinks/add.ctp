<!-- app/View/FunctionCadEntities/add.ctp -->
<div id="success" style="display:none;"></div>
<div class="link form">
<?php echo $this->Form->create();?>
    <fieldset>
        <legend><?php echo __('Add Link'); ?></legend>
    <?php
        echo $this->Form->input('FunctionCadLink.from_function_cad_entity_id', array(
        	'options' => $options,
			'label' => 'From entity'
        ));
		echo $this->Form->input('FunctionCadLink.to_function_cad_entity_id', array(
        	'options' => $options,
			'label' => 'To entity'
        ));
		$types = array('0' => 'Material', '1' => 'Signal', '2' => 'Energy');
		echo $this->Form->input('FunctionCadLink.type', array(
			'options' => $types,
			'default' => '0'
			)
		);
    ?>
    </fieldset>
<?php 
	echo $this->Js->submit('Submit', array('url' => array('action' => 'add', 'ext' => 'json', $id), 'before' => '$("#modal").dialog("close")', 'error' => 'alert("Error adding link!")', 'success' => 'create_link(data["message"]["FunctionCadLink"]);'));
	echo $this->Form->end();
?>
</div>
<?php echo $this->Js->writeBuffer(); ?>