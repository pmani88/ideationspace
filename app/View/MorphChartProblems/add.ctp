<!-- app/View/MorphChartProblem/add.ctp -->
<?php 	
	//custom JS for finding root id
	echo $this->Html->script('morph_chart_find_rootid',FALSE);
?>
<div id="success" style="display:none;"></div>
<div class="entity form">
<?php 
	// Create Add Problem Form
	echo $this->Form->create();?>
    <fieldset>
        <legend><?php echo __('Add Problem'); ?></legend>
    <?php
        echo $this->Form->input('name', array('type'=>'text'));
		echo $this->Form->input('morph_chart_problem_id', array(
        	'options' => $problem_options,
			'label' => 'Parent Problem',
			'onchange' => "javascript:findRootIdPrbAddForm();"
			//'type' => 'text'
        ));
		echo $this->Form->input('root_id', array('type' => 'hidden'));
		echo $this->Form->input('problems_array', array('type' => 'hidden', 'value' => json_encode($Problems)));
    ?>
    </fieldset>
<?php 
	//echo $this->Js->submit('Submit', array('url' => array('action' => 'add', 'ext' => 'json', $id), 'before' => '$("#modal_dialog").dialog("close")', 'error' => 'alert("error adding problem")', 'success' => 'load_morph_chart();'));
	echo $this->Js->submit('Submit', array('url' => array('action' => 'add', 'ext' => 'json', $id), 'before' => '$("#modal_dialog").dialog("close")', 'error' => 'alert("error adding problem")', 'success' => 'location.reload();'));
	//echo $this->Form->submit('Submit', array('url' => array('action' => 'add', 'ext' => 'json', $id));
	echo $this->Form->end();
?>
</div>
<?php echo $this->Js->writeBuffer(); ?>
