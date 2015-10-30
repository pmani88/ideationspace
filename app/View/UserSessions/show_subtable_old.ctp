<?php // $this->extend('navigation'); ?>

<?php 	  
	// echo "<pre>";	print_r($childproblems); echo "</pre>";
	
	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	// Jquery UI for the modal dialogs
	echo $this->Html->script('jquery-ui-1.8.20.custom.min',FALSE);
	// Load the Jquery UI theme file
	$this->Html->css('ui-lightness/jquery-ui-1.8.20.custom', null, array('inline' => false));
	// Custom file for saving manual solutions
	echo $this->Html->script('morph_chart_manual_solutions',array('inline' => false));
?> 

<table border='5px'>
	<tr>
		<th>Name</th>
		<th>Solutions</th>
	</tr>

<?php 
	$problems=$childproblems;
	foreach($problems as $problem) {  
?>
	<tr>
		<td> 
			<a href='../../../MorphChartProblems/edit/<?php echo $problem['MorphChartProblem']['id']; ?>'><?php echo $problem['MorphChartProblem']['name'];?></a>
			<a href='../../../morph_chart_problems/delete/<?php echo $problem['MorphChartProblem']['id']; ?>' onclick="return confirm(\'Are you sure?\');">(<font color="red">X</font>)</a> 

		<?php
			if(count($problem['ChildrenMorphChartProblems']) > 0) {
				$image = $this->Html->image('expand.png', array('alt'=>'advertisement', 'height'=>'30', 'width'=>'30'));
				echo $this->Html->link($image,
					array('controller' => 'user_sessions', 'action' => "show_subtable/".$uid."/".$problem['MorphChartProblem']['id']), 
					array('target'=>'_blank','escape'=>false)); 
			}
		?>
		</td>
		
		<?php  $solutions = $usersessions['MorphChartSolution'];
		//print_r(json_encode($usersessions));
		?>
		
		<td> 
			<table border='1px'>
				<tr>
					<?php foreach($solutions as $solution){ 
						if($solution['morph_chart_problem_id'] == $problem['MorphChartProblem']['id']) {
					?>
					<?php 
						$chunk=-1;
						foreach($datas as $data){
							//print_r(json_encode($solution));//////////////////////////
							if($data['MorphChartImage']['morph_chart_solution_id'] == $solution['id'])
								$chunk=$data['MorphChartImage']['file_name'];
						}
					?>
						<td> 
							<input type="radio" name="pid_<?php echo $problem['MorphChartProblem']['id']; ?>" value="<?php echo $solution['id']; ?>" <?php if($solution['isSelected']) echo "checked = 'checked'"?>>
							<?php if($chunk!=-1){ ?>
								<img width="100px" src="../../../<?php echo $chunk; ?>"></img> 
							<?php } ?>
							<a href='../../../MorphChartSolutions/edit/<?php echo $solution['id']; ?>'><?php  echo $solution['name']; ?></a>
							<a href='../../../morph_chart_solutions/delete/<?php echo $solution['id']; ?>' onclick="return confirm(\'Are you sure?\');">(<font color="red">X</font>)</a>
						</td>
					<?php }
					}					     
					?>
				</tr>
			</table>
		</td>
	</tr>
	<?php }  ?>
</table>
<div id="save_soln" style="float: right">Save Solutions</div>
