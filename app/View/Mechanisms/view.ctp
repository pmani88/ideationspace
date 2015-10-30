<div class="mechanisms view">
<h2><?php  echo __('Mechanism');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('GROUP'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['GROUP']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NAME'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['NAME']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LINK'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['LINK']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IP'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['IP']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IPTYPE'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['IPTYPE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IPSPEED'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['IPSPEED']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IPVELOCITYDIRECTION'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['IPVELOCITYDIRECTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OPTYPE'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['OPTYPE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OPSPEED'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['OPSPEED']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OPVELOCITYDIRECTION'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['OPVELOCITYDIRECTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OP'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['OP']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('REVERSIBILITY'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['REVERSIBILITY']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('RELBETWNIP'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['RELBETWNIP']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('RELBETWNIPAX'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['RELBETWNIPAX']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimension'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['Dimension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MCI'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['MCI']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DOF'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['DOF']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Function'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['Function']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IPMOTION'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['IPMOTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MOTIINVOLVED'); ?></dt>
		<dd>
			<?php echo h($mechanism['Mechanism']['MOTIINVOLVED']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mechanism'), array('action' => 'edit', $mechanism['Mechanism']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mechanism'), array('action' => 'delete', $mechanism['Mechanism']['id']), null, __('Are you sure you want to delete # %s?', $mechanism['Mechanism']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mechanisms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mechanism'), array('action' => 'add')); ?> </li>
	</ul>
</div>
