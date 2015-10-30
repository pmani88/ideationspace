<?php 
	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	
	// Jquery
	echo $this->Html->script('log_outbound',FALSE);

?>

<h2><?php echo $UserSession['UserSession']['name']; ?></h2>
<div class="actions">
	<h3>Problem Formulation</h3>
	<ul> 
		<li><?php echo $this->Html->link("Function CAD",
			array('controller' => 'user_sessions', 'action' => 'function_cad', $UserSession['UserSession']['id'])); ?></li>
		<li><?php echo $this->Html->link("Morph Chart",
			array('controller' => 'user_sessions', 'action' => 'morph_chart', $UserSession['UserSession']['id'])); ?></li>
	</ul>
	<h3>Reformulation</h3>
	<ul> 
		<li><?php echo $this->Html->link("Word Diamond",
			array('controller' => 'user_sessions', 'action' => 'word_diamond', $UserSession['UserSession']['id'])); ?></li>
		<li><?php echo $this->Html->link("Wordnet","http://wordnetweb.princeton.edu/perl/webwn", array('target'=>'_blank')) ?></li>
		<li><?php echo $this->Html->link("Relational Algorithm",
			array('controller' => 'user_sessions', 'action' => 'relational_algorithm', $UserSession['UserSession']['id'])); ?></li>
	</ul>
	<h3>Standard Solution</h3>
	<ul>
		<li><?php echo $this->Html->link("Find Mechanisms",
			array('controller' => 'mechanisms', 'action' => 'find', $UserSession['UserSession']['id'])); ?></li>
		<li><?php echo $this->Html->link("Select Mechanisms",
			array('controller' => 'mechanisms', 'action' => 'select', $UserSession['UserSession']['id'])); ?></li>
		<li><?php echo $this->Html->link("Find Machine Elements",
			array('controller' => 'cots', 'action' => 'find', $UserSession['UserSession']['id'])); ?></li>
		<li><?php echo $this->Html->link("Select Machine Elements",
			array('controller' => 'cots', 'action' => 'select', $UserSession['UserSession']['id'])); ?></li>
		<li><?php echo $this->Html->link("Artifacts",
			array('controller' => 'user_sessions', 'action' => 'browse_artifacts_by_function', $UserSession['UserSession']['id'])); ?></li>
	</ul>
	<h3>Generative Methods</h3>
	<ul>
		<li><?php echo $this->Html->link("Physical Effects",
			array('controller' => 'user_sessions', 'action' => 'browse_physical_effects_by_function', $UserSession['UserSession']['id'])); ?></li>
		<li><?php echo $this->Html->link("Working Principles",
			array('controller' => 'user_sessions', 'action' => 'browse_working_principles_by_function', $UserSession['UserSession']['id'])); ?></li>
		<li><?php echo $this->Html->link("Bio-Triz",
			array('controller' => 'user_sessions', 'action' => 'bio_triz', $UserSession['UserSession']['id'])); ?></li>
		<li><?php echo $this->Html->link("Triz",
			array('controller' => 'user_sessions', 'action' => 'search_triz_by_feature', $UserSession['UserSession']['id'])); ?></li>
	</ul>
	<h3>External Resources</h3>
	<ul>
		<li><?php echo $this->Html->link("ImageNet","http://www.image-net.org/", array('target'=>'_blank')) ?></li>
		<li><?php echo $this->Html->link("Ask Nature","http://www.asknature.org/", array('target'=>'_blank')) ?></li>
		<li><?php echo $this->Html->link("Wikipedia","http://www.wikipedia.org/", array('target'=>'_blank')) ?></li>
		<li><?php echo $this->Html->link("Google","http://www.google.com/", array('target'=>'_blank')) ?></li>
	</ul>
	<h3>Process Monitoring</h3>
	<ul>
		<!--
		<li><?php echo $this->Html->link("Textual Documentation",
			array('controller' => 'user_sessions', 'action' => 'textual', $UserSession['UserSession']['id'])); ?></li>
		<li><?php echo $this->Html->link("Graphical Documentation",
			array('controller' => 'user_sessions', 'action' => 'graphical', $UserSession['UserSession']['id'])); ?></li>
		-->
		<!--
		<li><?php echo $this->Html->link("Functional Analysis",
			array('controller' => 'user_sessions', 'action' => 'functional_analysis', $UserSession['UserSession']['id'])); ?></li>
		-->
		<li><?php echo $this->Html->link("Find ideation state",
			array('controller' => 'user_sessions', 'action' => 'find_ideation_state', $UserSession['UserSession']['id'])); ?></li>
		<li><?php echo $this->Html->link("Was the strategy useful?",
			array('controller' => 'user_sessions', 'action' => 'survey', $UserSession['UserSession']['id'])); ?></li>
	</ul>
</div>
<div class="view">
	<?php echo $this->fetch('content'); ?>
</div>