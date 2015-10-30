<?php 
	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	// Jquery UI for the modal dialogs
	echo $this->Html->script('jquery-ui-1.8.20.custom.min',FALSE);
	// Load the Jquery UI theme file
	$this->Html->css('ui-lightness/jquery-ui-1.8.20.custom', null, array('inline' => false));
	
	// Custom file for browsing artifacts by name
	echo $this->Html->script('browse_working_principles_by_name',FALSE);
	echo $this->Html->script('auto_add_solutions',array('inline' => false));
?>

<?php $this->extend('navigation'); ?>
<h2>Browse working principles - by name</h2>
<?php echo $this->Html->link("Browse working principles by function",
array('controller' => 'user_sessions', 'action' => 'browse_working_principles_by_function', $UserSession['UserSession']['id'], $pid)); ?>
<br/>
<?php echo $this->Html->link("Browse working principles by tracking",
array('controller' => 'user_sessions', 'action' => 'browse_working_principles_by_tracking', $UserSession['UserSession']['id'], $pid)); ?>

<br/>
<br/>

<h3>Name</h3>
<select id="working_principle"></select>

<h4>Description</h4>
<div id="description"></div>

<h4>Material</h4>
<div id="material"></div>

<h4>Picture</h4>
<div id="picture"></div>

<h4>Related Physical Effects</h4>
<div id="related_physical_effects"></div>

<h4>Key Physical Variables</h4>
<div id="key_physical_variables"></div>

<h4>Example components</h4>
<div id="example_components"></div>

<h4>Functions</h4>
<div id="functions"></div>

<h4>Bio-example</h4>
<div id="bio_example"></div>

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
				<input type="text" id="MorphChartSolutionSOI" alt="WorkingPrinciple" disabled>
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