<div class="morphChartManualSolutions form">
<?php echo $this->Form->create('MorphChartManualSolution');?>
	<fieldset>
		<legend><?php echo __('Edit Morph Chart Manual Solution'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('session_id');
		echo $this->Form->input('morph_chart_prob_id');
		echo $this->Form->input('morph_chart_solution_id');
		echo $this->Form->input('manualSolutionSet');
		echo $this->Form->input('SolutionSet');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MorphChartManualSolution.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MorphChartManualSolution.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Morph Chart Manual Solutions'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Morph Chart Problems'), array('controller' => 'morph_chart_problems', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Morph Chart Problem'), array('controller' => 'morph_chart_problems', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Morph Chart Solutions'), array('controller' => 'morph_chart_solutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Morph Chart Solution'), array('controller' => 'morph_chart_solutions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sessions'), array('controller' => 'sessions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Session'), array('controller' => 'sessions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Morph Chart Images'), array('controller' => 'morph_chart_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Morph Chart Image'), array('controller' => 'morph_chart_images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Solution Sets'), array('controller' => 'solution_sets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Solution Set'), array('controller' => 'solution_sets', 'action' => 'add')); ?> </li>
	</ul>
</div>
