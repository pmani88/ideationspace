<?php
	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);

	// Jquery UI for the modal dialogs
	echo $this->Html->script('jquery-ui-1.8.20.custom.min',FALSE);

	// Raphael JS
	echo $this->Html->script('raphael-min',FALSE);

	// JSON2
	echo $this->Html->script('json2',FALSE);

	// Raphael Sketchpad
	echo $this->Html->script('raphael.sketchpad',FALSE);

	// Custom JS file to do drawing
	echo $this->Html->script('morph_chart_solutions_edit',FALSE);

	// Load the Jquery UI theme file
	$this->Html->css('ui-lightness/jquery-ui-1.8.20.custom', null, array('inline' => false));
	
?>

<!-- app/View/MorphChartSolution/edit.ctp -->
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
<?php echo $this->Form->create('MorphChartSolution', array('type' => 'file'));?>
    <fieldset>
        <legend><?php echo __('Edit Solution'); ?></legend>
        <?php $soi=array('ABC'=>'ABC','ABD'=>'ABD') ?>
    
    <?php
        echo $this->Form->input('MorphChartSolution.name', array('type'=>'text'));
		echo $this->Form->input('MorphChartSolution.morph_chart_problem_id', array(
			'options' => $problem_options,
			'label' => 'Problem'
//'type' => 'text'
        ));
       
        echo $this->Form->input('MorphChartSolution.soi', array(
        	'options' => $cot_options,
			'empty'=> array('" selected="selected' => '-- Select --'),
			'label' => 'Source of Inspiration'
//'type' => 'text'
        ));
		echo $this->Form->input('MorphChartSolution.text_document', array('label' => 'Description'));
		
	?>
	<label>Drawing</label>
<!-- TODO not sure why the erased paths do not get erased...
	<div id="eraser">Eraser</div>
	<div id="pen">Pen</div>
-->
	<div id="undo">Undo</div>
	<div id="redo">Redo</div>
	<div id="clear">Clear</div>
	<div id="editor"></div>
	
	<?php	
		echo $this->Form->input('MorphChartImages.file_name', array('type' => 'file', 'label' => 'Upload Image'));
		echo $this->Form->input('MorphChartSolution.id', array('type' => 'hidden'));
		echo $this->Form->input('MorphChartSolution.graphic_document', array('style' => 'display: none', 'label' => ''));
    ?>
	<label>Images</label>
	<div id="images">
		<?php
			foreach($Solution['MorphChartImage'] as &$img){
				echo "<div class='box'>";
				echo "<img width='400px' src='../../" . $img['file_name'] . "'></img>";
				echo $this->Html->link(
				                'Delete',
				                array('controller' => 'MorphChartImages', 'action' => 'delete', $img['id']),
				                array('confirm' => 'Are you sure?'));
				echo "</div>";
			}
		?>
	</div>
    </fieldset>
<?php 
	//echo $this->Js->submit('Submit', array('url' => array('action' => 'edit', 'ext' => 'json', $id), 'before' => '$("#modal").dialog("close")', 'error' => 'alert("error adding problem")', 'success' => 'load_morph_chart();'));
	echo $this->Form->end('Submit');
	//echo $this->Form->submit('Submit', array('url' => array('action' => 'add', 'ext' => 'json', $id));
	echo $this->Form->end();
?>
</div>
<?php //echo $this->Js->writeBuffer(); ?>