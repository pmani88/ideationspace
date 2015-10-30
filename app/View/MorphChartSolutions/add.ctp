<!-- app/View/MorphChartSolution/add.ctp -->
<div id="success" style="display:none;"></div>
<div class="entity form">
<?php echo $this->Form->create();?>
    <fieldset>
        <legend><?php echo __('Add Solution'); ?></legend>
    <?php
        echo $this->Form->input('MorphChartSolution.name', array('type'=>'text'));
		echo $this->Form->input('MorphChartSolution.morph_chart_problem_id', array(
        	'options' => $problem_options,
			'label' => 'Problem'
//'type' => 'text'
        ));
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