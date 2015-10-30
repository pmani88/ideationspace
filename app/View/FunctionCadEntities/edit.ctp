<!-- app/View/FunctionCadEntities/add.ctp -->
<div id="success" style="display:none;"></div>
<div class="entity form">
<?php echo $this->Form->create();?>
    <fieldset>
        <legend><?php echo __('Edit Entity'); ?></legend>
    <?php
	        echo $this->Form->input('name', array(
				'options' => $func_options
	        	//'type' => 'text'
	        ));
			echo $this->Form->input('flow', array(
	        	'options' => $flow_options
	//'type' => 'text'
	        ));
	echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->input('x', array('type' => 'hidden'));
	echo $this->Form->input('y', array('type' => 'hidden'));
    ?>
    </fieldset>
<?php 
	echo $this->Js->submit('Submit', array('url' => array('action' => 'edit', 'ext' => 'json', $id), 'before' => '$("#modal").dialog("close")', 'error' => 'alert("error adding entity")', 'success' => 'update_entity(data["message"]["FunctionCadEntity"]);'));
	echo $this->Form->end();
?>
</div>
<?php echo $this->Js->writeBuffer(); ?>