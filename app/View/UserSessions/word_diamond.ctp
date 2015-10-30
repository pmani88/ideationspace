<?php 

	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	
	// Jquery context menu
	echo $this->Html->script('jquery.contextMenu',FALSE);
	
	// Jquery UI for the modal dialogs
	echo $this->Html->script('jquery-ui-1.8.20.custom.min',FALSE);
	
	// Custom file for browsing artifacts by name
	echo $this->Html->script('word_diamond',FALSE);
	
	// Load the Jquery UI theme file
	$this->Html->css('ui-lightness/jquery-ui-1.8.20.custom', null, array('inline' => false));
	
?>

<?php $this->extend('navigation'); ?>
<h2>Word Diamond</h2>

<h3>How many words would you like to input?</h3>
<select id="num_words_input">
	<option value="0"></option>
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

<h3>Words</h3>
<div id="word_input"></div>

<h3>How many words would you like to randomly select and reorder?</h3>
<select id="num_words_to_select"></select>

<br/><br/>
<div id="generate_button">Generate random word selection</div>
<br/><br/>

<h4>Result</h4>
<div id="result"></div>