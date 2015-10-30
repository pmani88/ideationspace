<?php 
	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	
	// Custom file for function analysis
	echo $this->Html->script('functional_analysis',FALSE);
?>

<?php $this->extend('navigation'); ?>
<h2>Functional Analysis</h2>

<h3>Pre-defined functions</h3>
<select id="predefined_functions">
</select>

<h3>Function to analyze</h3>
<input type="text" id="function" />

<h3>User specified values</h3>
<div id="user_specified_values"></div>

<h3>Analysis</h3>
<a href="#" id="button">Run analysis</div>
<div id="analysis"></div>