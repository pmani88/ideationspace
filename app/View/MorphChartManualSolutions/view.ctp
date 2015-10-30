<div class="morphChartManualSolutions view">
<h2><?php  echo __('Morph Chart Manual Solution');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($morphChartManualSolution['MorphChartManualSolution']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Session'); ?></dt>
		<dd>
			<?php echo $this->Html->link($morphChartManualSolution['Session']['name'], array('controller' => 'sessions', 'action' => 'view', $morphChartManualSolution['Session']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Morph Chart Prob Id'); ?></dt>
		<dd>
			<?php echo h($morphChartManualSolution['MorphChartManualSolution']['morph_chart_prob_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Morph Chart Solution'); ?></dt>
		<dd>
			<?php echo $this->Html->link($morphChartManualSolution['MorphChartSolution']['name'], array('controller' => 'morph_chart_solutions', 'action' => 'view', $morphChartManualSolution['MorphChartSolution']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ManualSolutionSet'); ?></dt>
		<dd>
			<?php echo h($morphChartManualSolution['MorphChartManualSolution']['manualSolutionSet']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Morph Chart Manual Solution'), array('action' => 'edit', $morphChartManualSolution['MorphChartManualSolution']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Morph Chart Manual Solution'), array('action' => 'delete', $morphChartManualSolution['MorphChartManualSolution']['id']), null, __('Are you sure you want to delete # %s?', $morphChartManualSolution['MorphChartManualSolution']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Morph Chart Manual Solutions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Morph Chart Manual Solution'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Morph Chart Problems');?></h3>
	<?php if (!empty($morphChartManualSolution['ChildrenMorphChartProblems'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Session Id'); ?></th>
		<th><?php echo __('Morph Chart Problem Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Root Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($morphChartManualSolution['ChildrenMorphChartProblems'] as $childrenMorphChartProblems): ?>
		<tr>
			<td><?php echo $childrenMorphChartProblems['id'];?></td>
			<td><?php echo $childrenMorphChartProblems['session_id'];?></td>
			<td><?php echo $childrenMorphChartProblems['morph_chart_problem_id'];?></td>
			<td><?php echo $childrenMorphChartProblems['name'];?></td>
			<td><?php echo $childrenMorphChartProblems['root_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'morph_chart_problems', 'action' => 'view', $childrenMorphChartProblems['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'morph_chart_problems', 'action' => 'edit', $childrenMorphChartProblems['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'morph_chart_problems', 'action' => 'delete', $childrenMorphChartProblems['id']), null, __('Are you sure you want to delete # %s?', $childrenMorphChartProblems['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Children Morph Chart Problems'), array('controller' => 'morph_chart_problems', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Morph Chart Solutions');?></h3>
	<?php if (!empty($morphChartManualSolution['MorphChartSolution'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Session Id'); ?></th>
		<th><?php echo __('Morph Chart Problem Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Text Document'); ?></th>
		<th><?php echo __('Graphic Document'); ?></th>
		<th><?php echo __('Soi'); ?></th>
		<th><?php echo __('IsSelected'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($morphChartManualSolution['MorphChartSolution'] as $morphChartSolution): ?>
		<tr>
			<td><?php echo $morphChartSolution['id'];?></td>
			<td><?php echo $morphChartSolution['session_id'];?></td>
			<td><?php echo $morphChartSolution['morph_chart_problem_id'];?></td>
			<td><?php echo $morphChartSolution['name'];?></td>
			<td><?php echo $morphChartSolution['text_document'];?></td>
			<td><?php echo $morphChartSolution['graphic_document'];?></td>
			<td><?php echo $morphChartSolution['soi'];?></td>
			<td><?php echo $morphChartSolution['isSelected'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'morph_chart_solutions', 'action' => 'view', $morphChartSolution['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'morph_chart_solutions', 'action' => 'edit', $morphChartSolution['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'morph_chart_solutions', 'action' => 'delete', $morphChartSolution['id']), null, __('Are you sure you want to delete # %s?', $morphChartSolution['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Morph Chart Solution'), array('controller' => 'morph_chart_solutions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Morph Chart Images');?></h3>
	<?php if (!empty($morphChartManualSolution['MorphChartImage'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Morph Chart Solution Id'); ?></th>
		<th><?php echo __('File Name'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($morphChartManualSolution['MorphChartImage'] as $morphChartImage): ?>
		<tr>
			<td><?php echo $morphChartImage['id'];?></td>
			<td><?php echo $morphChartImage['morph_chart_solution_id'];?></td>
			<td><?php echo $morphChartImage['file_name'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'morph_chart_images', 'action' => 'view', $morphChartImage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'morph_chart_images', 'action' => 'edit', $morphChartImage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'morph_chart_images', 'action' => 'delete', $morphChartImage['id']), null, __('Are you sure you want to delete # %s?', $morphChartImage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Morph Chart Image'), array('controller' => 'morph_chart_images', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Solution Sets');?></h3>
	<?php if (!empty($morphChartManualSolution['SolutionSet'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Session Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($morphChartManualSolution['SolutionSet'] as $solutionSet): ?>
		<tr>
			<td><?php echo $solutionSet['id'];?></td>
			<td><?php echo $solutionSet['name'];?></td>
			<td><?php echo $solutionSet['session_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'solution_sets', 'action' => 'view', $solutionSet['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'solution_sets', 'action' => 'edit', $solutionSet['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'solution_sets', 'action' => 'delete', $solutionSet['id']), null, __('Are you sure you want to delete # %s?', $solutionSet['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Solution Set'), array('controller' => 'solution_sets', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
