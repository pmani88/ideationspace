<!-- app/View/MorphChartProblem/add.ctp -->
<?php 	
	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	// Jquery UI for the modal dialogs
	echo $this->Html->script('jquery-ui-1.8.20.custom.min',FALSE);
	//custom JS for finding root id
	echo $this->Html->script('morph_chart_find_rootid',FALSE);
?>

<div id="success" style="display:none;"></div>
<div class="actions">
	<h3>Explore Reformulation</h3>
	<ul> 
		<li><?php echo $this->Html->link("Word Diamond", array('controller' => 'user_sessions', 'action' => 'word_diamond', $UserSession), array('target'=>'_blank')); ?></li>
		<li><?php echo $this->Html->link("Wordnet","http://wordnetweb.princeton.edu/perl/webwn", array('target'=>'_blank')) ?></li>
		<li><?php echo $this->Html->link("Relational Algorithm", array('controller' => 'user_sessions', 'action' => 'relational_algorithm', $UserSession), array('target'=>'_blank')); ?></li>
	</ul>
</div>
<div class="entity form">
<?php 
	// Create Edit Problem Form
	echo $this->Form->create();?>
    <fieldset>
        <legend><?php echo __('Edit Problem'); ?></legend>
    <?php
        echo $this->Form->input('name', array('type'=>'text'));
		echo $this->Form->input('morph_chart_problem_id', array(
        	'options' => $problem_options,
			'label' => 'Parent Problem',
			'onchange' => "javascript:findRootIdPrbEditForm();"
//'type' => 'text'
        ));
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('root_id', array('type' => 'hidden'));
		echo $this->Form->input('problems_array', array('type' => 'hidden', 'value' => json_encode($Problems)));
    ?>
    </fieldset>
<?php 
	//echo $this->Js->submit('Submit', array('url' => array('action' => 'edit', 'ext' => 'json', $id), 'before' => '$("#modal").dialog("close")', 'error' => 'alert("error adding problem")', 'success' => 'console.log("test");load_morph_chart();'));
	echo $this->Js->submit('Submit', array('url' => array('action' => 'edit', 'ext' => 'json', $id), 'before' => '$("#modal_dialog").dialog("close")', 'error' => 'alert("error adding problem")', 'success' => 'location.reload();'));
	//echo $this->Form->submit('Submit', array('url' => array('action' => 'add', 'ext' => 'json', $id));
	echo $this->Form->end();
?>
</div>
<?php echo $this->Js->writeBuffer(); 
//print_r($Problems);
?>