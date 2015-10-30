<?php 
	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	// Jquery UI for the modal dialogs
	echo $this->Html->script('jquery-ui-1.8.20.custom.min',FALSE);
	// Load the Jquery UI theme file
	$this->Html->css('ui-lightness/jquery-ui-1.8.20.custom', null, array('inline' => false));
	
	// Custom file for browsing artifacts by name
	echo $this->Html->script('browse_physical_effects_by_function',FALSE);
	
	echo $this->Html->script('auto_add_solutions',array('inline' => false));
?>

<?php $this->extend('navigation'); ?>
<h2>Browse physical effects - by function</h2>
<?php echo $this->Html->link("Browse physical effects by name",
array('controller' => 'user_sessions', 'action' => 'browse_physical_effects_by_name', $UserSession['UserSession']['id'], $pid)); ?>
<br/>
<?php echo $this->Html->link("Browse physical effects by tracking",
array('controller' => 'user_sessions', 'action' => 'browse_physical_effects_by_tracking', $UserSession['UserSession']['id'], $pid)); ?>

<br/>
<br/>

<h3>Flow Variable Type</h3>
<div>
<input type="radio" name="flow_variable_type" value="normal"> Normal Flow Variables<br>
<input type="radio" name="flow_variable_type" value="fe"> Flow and Effort Analogies<br>
</div>

<h3>Function Verb</h3>
<select id="function_verb">
</select>

<h3>Flow Variable</h3>
<select id="flow_variable">
</select>

<h3>Physical Effects</h3>
<select id="physical_effects">
</select>

<!--
<h4>Name</h4>
<div id="pe_name"></div>
-->

<h4>Description</h4>
<div id="pe_description"></div>

<h4>Equations</h4>
<div id="pe_equations"></div>

<h4>Physical Parameters</h4>
<div id="pe_parameters"></div>

<h4>Medium</h4>
<div id="pe_medium"></div>

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
				<input type="text" id="MorphChartSolutionSOI" alt="PhysicalEffect" disabled>
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