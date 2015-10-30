<?php 

	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	
	// Jquery context menu
	echo $this->Html->script('jquery.contextMenu',FALSE);

	// RaphaelJS
	echo $this->Html->script('raphael-min',FALSE);
	
	// Raphael Zoom and Pan
	echo $this->Html->script('raphael-zpd',FALSE);
	
	// Jquery UI for the modal dialogs
	echo $this->Html->script('jquery-ui-1.8.20.custom.min',FALSE);
	
	// Custom file for browsing artifacts by name
	echo $this->Html->script('function_cad',FALSE);
	
	// Load the Jquery UI theme file
	$this->Html->css('ui-lightness/jquery-ui-1.8.20.custom', null, array('inline' => false));
	
	// load the CSS for the context menu
	$this->Html->css('jquery.contextMenu', null, array('inline' => false));
?>


<?php $this->extend('navigation'); ?>
<h2>Function CAD</h2>
<div id="addEntity">Add Node</div>
<div id="addLink">Add Link</div>
<div id="modal"></div>
<div id="raphael_gui"></div>
