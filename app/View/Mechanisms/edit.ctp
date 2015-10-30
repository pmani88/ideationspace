<div class="mechanisms form">
<?php echo $this->Form->create('Mechanism');?>
	<fieldset>
		<legend><?php echo __('Edit Mechanism'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('GROUP');
		echo $this->Form->input('NAME');
		echo $this->Form->input('LINK');
		echo $this->Form->input('IP');
		echo $this->Form->input('IPTYPE');
		echo $this->Form->input('IPSPEED');
		echo $this->Form->input('IPVELOCITYDIRECTION');
		echo $this->Form->input('OPTYPE');
		echo $this->Form->input('OPSPEED');
		echo $this->Form->input('OPVELOCITYDIRECTION');
		echo $this->Form->input('OP');
		echo $this->Form->input('REVERSIBILITY');
		echo $this->Form->input('RELBETWNIP');
		echo $this->Form->input('RELBETWNIPAX');
		echo $this->Form->input('Dimension');
		echo $this->Form->input('MCI');
		echo $this->Form->input('DOF');
		echo $this->Form->input('Function');
		echo $this->Form->input('IPMOTION');
		echo $this->Form->input('MOTIINVOLVED');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Mechanism.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Mechanism.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Mechanisms'), array('action' => 'index'));?></li>
	</ul>
</div>
