	<?php 

	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	
	// Custom file for browsing artifacts by name
	echo $this->Html->script('mechanisms.js',FALSE);
	
?>
<pre>
<?php print_r($Mechanisms);  ?> </pre>
<?php $this->extend('navigation'); ?>
<h2>Browse Mechanisms</h2>

<h3>GROUP</h3>
<select id="group">
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
<!--
		<td><?php echo h($mechanism['Mechanism']['GROUP']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['NAME']); ?>&nbsp;</td>		
		<td><?php echo h($mechanism['Mechanism']['IP']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['IPTYPE']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['IPSPEED']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['IPVELOCITYDIRECTION']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['OPTYPE']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['OPSPEED']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['OPVELOCITYDIRECTION']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['OP']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['REVERSIBILITY']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['RELBETWNIP']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['RELBETWNIPAX']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['Dimension']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['MCI']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['DOF']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['Function']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['IPMOTION']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['MOTIINVOLVED']); ?>&nbsp;</td>

-->
