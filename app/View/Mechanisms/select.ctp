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

<?php echo $this->Filter->filterForm('Mechanism', array('legend' => 'Select Mechanisms')); 
?>
	<h2><?php echo __('Mechanisms');?></h2>
	<div style="display: -webkit-box;">
		<table cellpadding="0" cellspacing="0" style="width: 30%">
			<tr><th><?php echo $this->Paginator->sort('NAME');?></th></tr>
		<?php
			echo "<div id='search_result' style='display: none;' alt='Mechanism'>".json_encode($mechanisms)."</div>";
			foreach ($mechanisms as $key=>$mechanism){ ?>
			<tr>
				<td><a href="javascript:void(0)" onclick="mechanisms_results(<?php echo $key ?>, this)"><?php echo h($mechanism['Mechanism']['NAME']); ?></a></td>
			</tr>
		<?php } ?>
		</table>
		<div id="search_results" style="margin-left: 20px; width: 70%">
		</div>
	</div>
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
					<input type="text" id="MorphChartSolutionSOI" alt="Mechanism" disabled></div>
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

