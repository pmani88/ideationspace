<?php 
	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	// Jquery UI for the modal dialogs
	echo $this->Html->script('jquery-ui-1.8.20.custom.min',FALSE);
	// Load the Jquery UI theme file
	$this->Html->css('ui-lightness/jquery-ui-1.8.20.custom', null, array('inline' => false));
	
	// Load the Jquery UI theme file
	$this->Html->css('ui-lightness/jquery-ui-1.8.20.custom', null, array('inline' => false));
	
	// Custom file for browsing artifacts by name
	echo $this->Html->script('browse_working_principles_by_tracking',FALSE);
	echo $this->Html->script('auto_add_solutions',array('inline' => false));
?>

<?php $this->extend('navigation'); ?>
<h2>Browse working principles - by tracking</h2>
<?php echo $this->Html->link("Browse working principles by function",
array('controller' => 'user_sessions', 'action' => 'browse_working_principles_by_function', $UserSession['UserSession']['id'], $pid)); ?>
<br/>
<?php echo $this->Html->link("Browse working principles by name",
array('controller' => 'user_sessions', 'action' => 'browse_working_principles_by_name', $UserSession['UserSession']['id'], $pid)); ?>

<br/>
<br/>

<h3>Tracking method</h3>
<input type="radio" name="method" value="name"> Name<br/>
<input type="radio" name="method" value="keyword"> Keyword<br/>

<h3>Tracking Distance</h3>
<select id="distance">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>		
</select>

<h3 id="name_title_heading"></h3>
<div id="name_title"></div>

<h4>Name</h4>
<div id="name"></div>

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