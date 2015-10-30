<?php 

	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);

	// Custom file for browsing artifacts by name
	echo $this->Html->script('relational_algorithm',FALSE);
?>

<?php $this->extend('navigation'); ?>
<h2>Relational Algorithm</h2>

<h3>Conjunction word</h3>
<select id="conjunctions"></select>

<h4>Stimulus Image</h4>
<div id="stimulus_image"></div>

<h4>Stimulus Word</h4>
<div id="stimulus_word"></div>
