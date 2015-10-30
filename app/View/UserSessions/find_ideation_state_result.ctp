<?php $this->extend('navigation'); ?>
<h2>Find ideation state</h2>
<h3>Blocks</h3>
<?php 
if(count($Blocks) > 0){
	foreach ($Blocks as $block):
		echo "<p>" . $block['IdeationBlock']['name'] . "</p>";
		echo "<h4>Methods to resolve block</h4>";
		echo "<ul>";
		foreach ($block['MiniStrategy'] as $strategy):
			foreach ($strategy['IdeationMethod'] as $method):
				echo "<li>" . $method['name'] . "</li>";
			endforeach;
		endforeach;
		echo "</ul>";
	endforeach; 
} 
else{
	echo "<p>Unable to determine ideation block.</p>";
}
?>
