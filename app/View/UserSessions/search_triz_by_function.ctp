<?php 
	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	// Jquery UI for the modal dialogs
	echo $this->Html->script('jquery-ui-1.8.20.custom.min',FALSE);
	// Load the Jquery UI theme file
	$this->Html->css('ui-lightness/jquery-ui-1.8.20.custom', null, array('inline' => false));
	
	// Custom file for browsing artifacts by name
	echo $this->Html->script('search_triz_by_function',FALSE);
	
	echo $this->Html->script('auto_add_solutions',array('inline' => false));
?>

<?php $this->extend('navigation'); ?>
<h2>Triz - by function</h2>
<?php echo $this->Html->link("Search by feature",
array('controller' => 'user_sessions', 'action' => 'search_triz_by_feature', $UserSession['UserSession']['id'], $pid)); ?>
<br/>
<br/>

<h3>Function Verb</h3>
<select id="function_verb">
</select>

<h3>Triz Recommendations</h3>
<select id="triz_recommendations">
</select>

<h4>Description</h4>
<div id="description">
</div>

<h4>Biological Solution</h4>
<div id="biological_solution">
</div>

<h4>Pictures</h4>
<div id="pictures">
</div>

<?php
	if(!is_null($pid)){
?>
	<div class="add_solution_form" session_id="<?php echo $session;?>" style="margin: 25px 0; width: 50%;">
		<fieldset>
			<legend>Add Solution</legend>
			<div class="input text" style="padding: 10px 0;">
				<label for="MorphChartSolutionName">Name</label>
				<input type="text" id="MorphChartSolutionName">
			</div>
			<div class="input text" style="padding: 10px 0;">
				<label for="MorphChartSolutionSOI">Source of Inspiration</label>
				<input type="text" id="MorphChartSolutionSOI" alt="TRIZ" disabled>
			</div>
			<div class="input text" style="padding: 10px 0;">
				<!--<label for="MorphChartSolutionMorphChartProblemId">Problem Id</label>-->
				<input type="hidden" id="MorphChartSolutionProblemId" value=<?php echo $pid; ?> disabled>
			</div> 
		</fieldset>
		<div id="MorphChartSolutionSubmit" style="margin: 0 10px;">Submit</div>
	</div>
<?php
	}
?>