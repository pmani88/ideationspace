<?php 

	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	
	// Jquery UI for the modal dialogs
	echo $this->Html->script('jquery-ui-1.8.20.custom.min',FALSE);
	
	// Raphael JS
	echo $this->Html->script('raphael-min',FALSE);
	
	// JSON2
	echo $this->Html->script('json2',FALSE);
	
	// Raphael Sketchpad
	echo $this->Html->script('raphael.sketchpad',FALSE);
	
	// Custom file for browsing artifacts by name
	echo $this->Html->script('morph_chart',FALSE);
	
	// Load the Jquery UI theme file
	$this->Html->css('ui-lightness/jquery-ui-1.8.20.custom', null, array('inline' => false));
	
	//custom JS for finding root id
	echo $this->Html->script('morph_chart_find_rootid',FALSE);
	
	//custom css for morph_chart
	$this->Html->css('morph_chart', null, array('inline' => false));
	
?>

<?php $this->extend('navigation'); ?>
<h2>Problem Statement</h2>
<?php 
	$prob_desc = $usersessions['UserSession']['description'];
	if(!($prob_desc =="" || is_null($prob_desc))){
		echo "<p>".$usersessions['UserSession']['description']."</p>";
	} else {
		echo "<p><i>&lt;No Problem Statement available&gt;</i></p>";
	}
?>
<h2>Morph Chart</h2>
<div id="add_problem">Add Problem</div>
<div id="add_solution">Add Solution</div>
<div id="save_complete_soln">Save Complete Solution Set</div>
<div id="select_random_solution_set">Select Random Solution Set</div>

<div id="modal_dialog"></div>
<div id="modal">
	<table border='5px'>
		<tr>
			<th>Name</th>
			<th>Solutions</th>
		</tr>

	<?php $problems = $rootproblems;
		foreach($problems as $problem) { 
	?>
		<tr>
			<td> 
				<a href='../../MorphChartProblems/edit/<?php echo $problem['MorphChartProblem']['id']; ?>'><?php echo $problem['MorphChartProblem']['name'];?></a>
				<a href='../../morph_chart_problems/delete/<?php echo $problem['MorphChartProblem']['id']; ?>' onclick="return confirm('Are you sure?');">(<font color="red">X</font>)</a> 
			<?php
				$haschild = 0; // check flag
				if(count($problem['ChildrenMorphChartProblems']) > 0) {
					$haschild = 1;
					$childprobid = $problem['MorphChartProblem']['id'];
					$image = $this->Html->image('expand.png', array('alt'=>'advertisement', 'height'=>'30', 'width'=>'30'));
					echo $this->Html->link($image,
						array('controller' => 'user_sessions', 'action' => "show_subtable/".$uid."/".$childprobid), 
						array('target'=>'_blank','escape'=>false));
				}
			?>
			<div id="auto_pop_soln">
				<ul>
					<li>
						<a href="javascript:void(0)">Add Solution from</a>
						<ul>
							<li><a href='../../cots/find/<?php echo $problem['MorphChartProblem']['session_id']; ?>/<?php echo $problem['MorphChartProblem']['id']; ?>' target="_blank">Find Machine Elements</a></li>
							<li><a href='../../cots/select/<?php echo $problem['MorphChartProblem']['session_id']; ?>/<?php echo $problem['MorphChartProblem']['id']; ?>' target="_blank">Select Machine Elements</a></li>
							<li><a href='../../mechanisms/find/<?php echo $problem['MorphChartProblem']['session_id']; ?>/<?php echo $problem['MorphChartProblem']['id']; ?>' target="_blank">Find Mechanisms</a></li>
							<li><a href='../../mechanisms/select/<?php echo $problem['MorphChartProblem']['session_id']; ?>/<?php echo $problem['MorphChartProblem']['id']; ?>' target="_blank">Select Mechanisms</a></li>
							<li><a href='../../user_sessions/browse_working_principles_by_function/<?php echo $problem['MorphChartProblem']['session_id']; ?>/<?php echo $problem['MorphChartProblem']['id']; ?>' target="_blank">Working Principle</a></li>
							<li><a href='../../user_sessions/browse_physical_effects_by_function/<?php echo $problem['MorphChartProblem']['session_id']; ?>/<?php echo $problem['MorphChartProblem']['id']; ?>' target="_blank">Physical Effect</a></li>
							<li><a href='../../user_sessions/search_triz_by_feature/<?php echo $problem['MorphChartProblem']['session_id']; ?>/<?php echo $problem['MorphChartProblem']['id']; ?>' target="_blank">TRIZ</a></li>
						</ul>
					</li>
				</ul>
			</div>
			</td>
			<?php  $solutions = $usersessions['MorphChartSolution']; ?>
			<td> 
				<table class="tbl_solutions" border='1px'>
					<tr>
					<?php foreach($solutions as $solution){
						if($solution['morph_chart_problem_id'] == $problem['MorphChartProblem']['id']){
							$sketch = 0;
							if($solution['graphic_document']!=null) {
								$sketch = 1;
								
							} else {
								$chunk = -1;
								foreach($datas as $data){
									if($data['MorphChartImage']['morph_chart_solution_id'] == $solution['id'])
										$chunk = $data['MorphChartImage']['file_name'];
								}
							}
						?>
						<td>
						<input id="prob_solns" type="radio" name="pid_<?php echo $problem['MorphChartProblem']['id']; ?>" value="<?php echo $solution['id']; ?>">
						<?php 
							if($sketch) {
								$elm_id = "tbleditor_".$solution['id'];
								$stroke = json_encode($solution['graphic_document']);
								
								echo '<span id="'.$elm_id.'" style="display: inline-block; height: 100px; width: 100px;"></span>';
						?>
								<script type="text/javascript">
									var svg = Raphael(<?php echo $elm_id ?>);
									var path_str = <?php echo $stroke ?>;
									var path = svg.path(path_str);
									var box = path.getBBox();    
									var margin = Math.max( box.width, box.height ) * 0.1;
									svg.setViewBox(box.x - margin, box.y - margin, box.width + margin * 2, box.height + margin * 2);
								</script>
						<?php					
							} elseif($chunk!=-1) {
						?>
								<img width="100px" src="../../<?php echo $chunk ?>"></img>
						<?php
							} 
						?>
							<a href='../../MorphChartSolutions/edit/<?php echo $solution['id']; ?>'><?php  echo $solution['name']; ?></a>						
							<a href='../../morph_chart_solutions/delete/<?php echo $solution['id']; ?>' onclick="return confirm('Are you sure?');">(<font color="red">X</font>)</a>
							<br/><b>Description:</b> <?php  echo $solution['text_document']; ?>
							<br/><b>Source of Inspiration:</b> 
								<?php  	if($solution['soi'] != "") 
											echo $solution['soi'];
										else
											echo "null";
								?>
						</td>
					<?php }
					}
					
					if($haschild){
						$childproblemsolutionsets = $manualsolutionset[$childprobid];
						
						//print_r(($childproblemsolutionsets));
						
						foreach($childproblemsolutionsets as $key => $solutionsets){
						$setid = $key;
					?>
							<td> 
							<?php
								$solutionids = '';
								foreach($solutionsets as $solutionset){
									if($solutionids !='')
										$solutionids .= ',';
									$solutionids .= $solutionset['morph_chart_solution_id'];
								}
								//print_r($solutionsets[0]['manualSolutionSet']);
							?>
							<input id="prob_solns" type="radio" id="<?php echo $solutionsets[0]['manualSolutionSet'];?>" name="pid_<?php echo $problem['MorphChartProblem']['id']; ?>" value="<?php echo $solutionids; ?>">
							
							<?php
							
							foreach($solutionsets as $solutionset){
								$solutionsarray = explode(',', $solutionset['morph_chart_solution_id']);
								foreach($solutionsarray as $childsolution){
									foreach($solutions as $solution){
										if($solution['id'] == $childsolution){
											$sketch = 0;
											if($solution['graphic_document']!=null) {
												$sketch = 1;
											} else {
												$chunk = -1;
												foreach($datas as $data){
													if($data['MorphChartImage']['morph_chart_solution_id'] == $solution['id'])
														$chunk = $data['MorphChartImage']['file_name'];
												}
											}
										?>
										
										<?php 
											if($sketch) {
												$elm_id = "tbleditor_".$solution['id']."_".$setid;
												$stroke = json_encode($solution['graphic_document']);
												
												echo '<span id="'.$elm_id.'" style="display: inline-block; height: 100px; width: 100px;"></span>';
										?>
												<script type="text/javascript">
													var svg = Raphael(<?php echo $elm_id ?>);
													var path_str = <?php echo $stroke ?>;
													var path = svg.path(path_str);
													var box = path.getBBox();    
													var margin = Math.max( box.width, box.height ) * 0.1;
													svg.setViewBox(box.x - margin, box.y - margin, box.width + margin * 2, box.height + margin * 2);
												</script>
										<?php					
											} else if($chunk!=-1) {
										?>
												<img width="100px" src="../../<?php echo $chunk ?>"></img>
										<?php
											} 
										?>
											<a href='../../MorphChartSolutions/edit/<?php echo $solution['id']; ?>'><?php  echo $solution['name']; ?></a>						
											<a href='../../morph_chart_solutions/delete/<?php echo $solution['id']; ?>' onclick="return confirm('Are you sure?');">(<font color="red">X</font>)</a>
											<br/><b>Description:</b> <?php  echo $solution['text_document']; ?>
											<br/><b>Source of Inspiration:</b> 
												<?php  	if($solution['soi'] != "") 
															echo $solution['soi'];
														else
															echo "null";
												?>
											<br/><br/>
								<?php }
									}
								}
							}
							?>
							<button onclick="delete_soln_set('<?php echo $solutionsets[0]['manualSolutionSet']; ?>')"> Delete Solution Set </button>
							</td>
						<?php 
						}
					}
					?>
					</tr>
				</table>
			</td>
		</tr>
	<?php }  ?>
	</table>
</div>
<!--<ul id="morph_chart"></ul>-->
<div id="complete_soln_sets">
	<h2>Complete Solution Sets</h2>
		<?php 
			foreach($solnsets as $solnset){?>
			<div style="margin-top: 20px; margin-bottom: 20px;">
				<?php echo '<h3 style="display: inline;">'.$solnset['SolutionSet']['name'].'</h3>';?> 
				<a href="../../solution_sets/delete/<?php echo $solnset['SolutionSet']['id'];?>" onclick="return confirm('Are you sure?');">(delete)
				</a>
				<table style="border:1px solid #000;">
					<tr><th>Problem</th><th>Solutions</th></tr>
					<?php foreach($problems as $problem) {?>
					<tr >
						<td style="border:1px solid #000;"><?php echo $problem['MorphChartProblem']['name']; ?></td>
						<td style="border:1px solid #000;">
							<table>
								<tr><th>Name</th><th>Description</th><th>Image</th><th>Source of Inspiration</th></tr>
								<?php 
									foreach($solnset['MorphChartSolution'] as $soln) {
										$flag = 0;
										if($problem['MorphChartProblem']['id'] == $soln['morph_chart_problem_id']) {
											$flag = 1;
										} else {
											foreach($problem['ChildrenMorphChartProblems'] as $child){
												if($child['id'] == $soln['morph_chart_problem_id']){
													$flag = 1;
													break;
												}
											}
										}
										if($flag){
								?>
											<tr>
											<td><?php echo $soln['name'];?></td>
											<td><?php echo $soln['text_document'];?></td>
											<td>
											<?php
												//print_r($datas);
												$sketch = 0;
												if($soln['graphic_document']!=null) {
													$sketch = 1;
												} else {
													$chunk = -1;
													foreach($datas as $data){
														if($data['MorphChartImage']['morph_chart_solution_id'] == $soln['id'])
															$chunk = $data['MorphChartImage']['file_name'];
													}
												}
												
												if($sketch) {
													$elm_id = "solnset_".$soln['id']."_".$solnset['SolutionSet']['id'];
													$stroke = json_encode($soln['graphic_document']);
													echo '<span id="'.$elm_id.'" style="display: inline-block; height: 100px; width: 100px;"></span>';
											?>
													<script type="text/javascript">
														var svg = Raphael(<?php echo $elm_id ?>);
														var path_str = <?php echo $stroke ?>;
														var path = svg.path(path_str);
														var box = path.getBBox();
														//console.log(box);
														var margin = Math.max( box.width, box.height ) * 0.1;
														svg.setViewBox(box.x - margin, box.y - margin, box.width + margin * 2, box.height + margin * 2);
													</script>
											<?php					
												} else if($chunk!=-1) {
											?>
													<img width="100px" src="../../<?php echo $chunk ?>"></img>
											<?php
												} 
											?>
											</td>
											<td><?php echo $soln['soi'];?></td>
											</tr>
								<?php 
										}
									}
								?>
							</table>
						</td>
					</tr>
					<?php }?>
				</table>
			</div>
		<?php }?>
</div>
<!--
<div id="solutions">
	<h5>Current Solution Set</h5>
	<div id="current_solution"></div>
	<h6>Name (for saving)</h6>
	<input id="solution_name" /><div id="save_solution">Save Solution</div>
	<br/><br/>
	<h5>Saved Solution Sets</h5>
	<div id="saved_solutions"></div>
</div>
-->
<!--NEW CODE STARTS-->
<?php 	//  echo "<pre>";	print_r($rootproblems); echo "</pre>";
?> 
<!--NEW CODE ENDS-->
