<?php 
	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	
	// Custom file for browsing artifacts by name
	echo $this->Html->script('browse_artifacts_by_function',FALSE);
?>

<?php $this->extend('navigation'); ?>
<h2>Browse Artifacts - by function</h2>
<?php echo $this->Html->link("Browse artifacts by name",
array('controller' => 'user_sessions', 'action' => 'browse_artifacts_by_name', $UserSession['UserSession']['id'])); ?>
<br/>
<br/>

<h3>Function Verb</h3>
<select id="functions"></select>

<h3>Artifacts</h3>
<select id="artifacts"></select>

<!--
<h4>Artifact Name</h4>
<div id="artifact_name"></div>
-->

<h4>Parent Artifact</h4>
<div id="parent_artifact"></div>

<h4>Description</h4>
<div id="description"></div>

<h4>Component</h4>
<div id="component"></div>

<h4>Artifact Image</h4>
<div id="artifact_image"></div>

<h4>Input Artifacts</h4>
<div id="input_artifacts"></div>

<h4>Input Flows</h4>
<div id="input_flows"></div>

<h4>Subfunctions</h4>
<div id="subfunctions"></div>

<h4>Output Flows</h4>
<div id="output_flows"></div>

<h4>Output Artifacts</h4>
<div id="output_artifacts"></div>

<h4>Manufacturing Information</h4>
<div id="manufacturing_information"></div>

<h4>Failure Information</h4>
<div id="failure_information"></div>