<!-- app/View/FunctionCadEntities/add.ctp -->
<div id="success" style="display:none;"></div>
<div class="entity form">
<?php echo $this->Form->create();?>
    <fieldset>
        <legend><?php echo __('Add Entity'); ?></legend>
    <?php
        echo $this->Form->input('name', array(
			'options' => $func_options
        	//'type' => 'text'
        ));
		echo $this->Form->input('flow', array(
        	'options' => $flow_options
//'type' => 'text'
        ));
    ?>
    </fieldset>
<?php 
	echo $this->Js->submit('Submit', array('url' => array('action' => 'add', 'ext' => 'json', $id), 'before' => '$("#modal").dialog("close")', 'error' => 'alert("error adding entity")', 'success' => 'create_entity(data["message"]["FunctionCadEntity"]);'));
	echo $this->Form->end();
?>
</div>
<?php echo $this->Js->writeBuffer(); ?>