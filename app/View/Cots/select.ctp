<?php 	  
	// Jquery
	echo $this->Html->script('jquery-1.7.2.min',FALSE);
	// Jquery UI for the modal dialogs
	echo $this->Html->script('jquery-ui-1.8.20.custom.min',FALSE);
	// Load the Jquery UI theme file
	$this->Html->css('ui-lightness/jquery-ui-1.8.20.custom', null, array('inline' => false));
	// Custom file for displaying results
	echo $this->Html->script('search_results',array('inline' => false));
	echo $this->Html->script('auto_add_solutions',array('inline' => false));
?> 
<?php echo $this->Filter->filterForm('Cot', array('legend' => 'Select Machine Elements')); 
?>

	<h2><?php echo __('Machine Elements');?></h2>
	<div style="display: -webkit-box;">
		<table cellpadding="0" cellspacing="0" style="width: 30%">
			<tr><th><?php echo $this->Paginator->sort('NAME');?></th></tr>
		<?php
			echo "<div id='search_result' style='display: none;' alt='Cots'>".json_encode($cots)."</div>";
			foreach ($cots as $key=>$cot){ ?>
			<tr>
				<td><a href="javascript:void(0)" onclick="cots_results(<?php echo $key ?>,this)"><?php echo h($cot['Cot']['NAME']); ?></a></td>
			</tr>
		<?php } ?>
		</table>
		<div id="search_results" style="margin-left: 20px; width: 70%">
		</div>
	</div>
	<!--
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('ID');?></th>
			<th><?php echo $this->Paginator->sort('NAME');?></th>
			<th><?php echo $this->Paginator->sort('CATEGORY');?></th>
			<th><?php echo $this->Paginator->sort('MACHINEELEMENTCATEGORY');?></th>
			<th><?php echo $this->Paginator->sort('FUNCTION');?></th>
			<th><?php echo $this->Paginator->sort('IPTYPE');?></th>
			<th><?php echo $this->Paginator->sort('IPSPEED');?></th>
			<th><?php echo $this->Paginator->sort('IPVELOCITYDIRECTION');?></th>
			<th><?php echo $this->Paginator->sort('OPTYPE');?></th>
			<th><?php echo $this->Paginator->sort('OPSPEED');?></th>
			<th><?php echo $this->Paginator->sort('OPVELOCITYDIRECTION');?></th>
			<th><?php echo $this->Paginator->sort('RELATION');?></th>
			<th><?php echo $this->Paginator->sort('IMAGE');?></th>
	</tr>
	<?php
	foreach ($cots as $cot): ?>
	<tr>
		<td><?php echo h($cot['Cot']['ID']); ?>&nbsp;</td>
		<td><?php echo h($cot['Cot']['NAME']); ?>&nbsp;</td>
		<td><?php echo h($cot['Cot']['CATEGORY']); ?>&nbsp;</td>
		<td><?php echo h($cot['Cot']['MACHINEELEMENTCATEGORY']); ?>&nbsp;</td>
		<td><?php echo h($cot['Cot']['FUNCTION']); ?>&nbsp;</td>
		<td><?php echo h($cot['Cot']['IPTYPE']); ?>&nbsp;</td>
		<td><?php echo h($cot['Cot']['IPSPEED']); ?>&nbsp;</td>
		<td><?php echo h($cot['Cot']['IPVELOCITYDIRECTION']); ?>&nbsp;</td>
		<td><?php echo h($cot['Cot']['OPTYPE']); ?>&nbsp;</td>
		<td><?php echo h($cot['Cot']['OPSPEED']); ?>&nbsp;</td>
		<td><?php echo h($cot['Cot']['OPVELOCITYDIRECTION']); ?>&nbsp;</td>
		<td><?php echo h($cot['Cot']['RELATION']); ?>&nbsp;</td>
		<td>  <img width="100px" height="100px" src="./img/cots/<?php echo h($cot['Cot']['IMAGE']); ?>"></img>
		&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table> -->
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	<?php
		if(!is_null($pid)){
	?>
		<div class="add_solution_form" session_id="<?php echo $session;?>" style="margin: 25px 0; width: 50%;">
			<fieldset>
				<legend>Add Solution</legend>
				<div class="input text" style="padding: 10px 0;">
					<label for="MorphChartSolutionName">Name</label>
					<input type="text" id="MorphChartSolutionName"></div>
				<div class="input text" style="padding: 10px 0;">
					<label for="MorphChartSolutionSOI">Source of Inspiration</label>
					<input type="text" id="MorphChartSolutionSOI" alt="Cots" disabled></div>
				<div class="input text" style="padding: 10px 0;">
					<!--<label for="MorphChartSolutionMorphChartProblemId">Problem Id</label>-->
					<input type="hidden" id="MorphChartSolutionProblemId" value=<?php echo $pid; ?> disabled>
				</div> 
			</fieldset>
			<div id="MorphChartSolutionSubmit" style="margin: 0 10px;">Submit</div>
		</div>
	<?php
		}
	?>
