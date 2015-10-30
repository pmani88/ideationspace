<div class="cots form">
<?php echo $this->Form->create('Cot');?>
	<fieldset>
		<legend><?php echo __('Add Cot'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('NAME');
		echo $this->Form->input('CATEGORY');
		echo $this->Form->input('MACHINEELEMENTCATEGORY');
		echo $this->Form->input('FUNCTION');
		echo $this->Form->input('IPTYPE');
		echo $this->Form->input('IPSPEED');
		echo $this->Form->input('IPVELOCITYDIRECTION');
		echo $this->Form->input('OPTYPE');
		echo $this->Form->input('OPSPEED');
		echo $this->Form->input('OPVELOCITYDIRECTION');
		echo $this->Form->input('RELATION');
		echo $this->Form->input('IMAGE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Cots'), array('action' => 'index'));?></li>
	</ul>
</div>
