<?php 

	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	
	// Custom file for browsing artifacts by name
	echo $this->Html->script('bio_triz',FALSE);
	
?>

<?php $this->extend('navigation'); ?>
<h2>Bio-triz</h2>

<h3>Improving Feature</h3>
<select id="improving_feature">
</select>

<h3>Worsening Feature</h3>
<select id="worsening_feature">
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