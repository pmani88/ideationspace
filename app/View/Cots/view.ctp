<div class="cots view">
<h2><?php  echo __('Cot');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NAME'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['NAME']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CATEGORY'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['CATEGORY']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MACHINEELEMENTCATEGORY'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['MACHINEELEMENTCATEGORY']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FUNCTION'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['FUNCTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IPTYPE'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['IPTYPE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IPSPEED'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['IPSPEED']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IPVELOCITYDIRECTION'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['IPVELOCITYDIRECTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OPTYPE'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['OPTYPE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OPSPEED'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['OPSPEED']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OPVELOCITYDIRECTION'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['OPVELOCITYDIRECTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('RELATION'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['RELATION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IMAGE'); ?></dt>
		<dd>
			<?php echo h($cot['Cot']['IMAGE']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cot'), array('action' => 'edit', $cot['Cot']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cot'), array('action' => 'delete', $cot['Cot']['id']), null, __('Are you sure you want to delete # %s?', $cot['Cot']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cots'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cot'), array('action' => 'add')); ?> </li>
	</ul>
</div>
