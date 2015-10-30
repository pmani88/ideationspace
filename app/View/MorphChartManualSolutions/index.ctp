<div class="morphChartManualSolutions index">
	<h2><?php echo __('Morph Chart Manual Solutions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('session_id');?></th>
			<th><?php echo $this->Paginator->sort('morph_chart_prob_id');?></th>
			<th><?php echo $this->Paginator->sort('morph_chart_solution_id');?></th>
			<th><?php echo $this->Paginator->sort('manualSolutionSet');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($morphChartManualSolutions as $morphChartManualSolution): ?>
	<tr>
		<td><?php echo h($morphChartManualSolution['MorphChartManualSolution']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($morphChartManualSolution['Session']['name'], array('controller' => 'sessions', 'action' => 'view', $morphChartManualSolution['Session']['id'])); ?>
		</td>
		<td><?php echo h($morphChartManualSolution['MorphChartManualSolution']['morph_chart_prob_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($morphChartManualSolution['MorphChartSolution']['name'], array('controller' => 'morph_chart_solutions', 'action' => 'view', $morphChartManualSolution['MorphChartSolution']['id'])); ?>
		</td>
		<td><?php echo h($morphChartManualSolution['MorphChartManualSolution']['manualSolutionSet']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $morphChartManualSolution['MorphChartManualSolution']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $morphChartManualSolution['MorphChartManualSolution']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $morphChartManualSolution['MorphChartManualSolution']['id']), null, __('Are you sure you want to delete # %s?', $morphChartManualSolution['MorphChartManualSolution']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
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
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Morph Chart Manual Solution'), array('action' => 'add')); ?></li>
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
