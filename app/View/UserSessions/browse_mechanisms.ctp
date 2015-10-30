<?php $this->extend('navigation'); ?>
<h2>Browse Mechanisms by following params</h2>
<?php echo $this->Filter->filterForm('Mechanism', array('legend' => 'Search')); 
?>

<div class="mechanisms index">
	<h2><?php echo __('Mechanisms');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('GROUP');?></th>
			<th><?php echo $this->Paginator->sort('NAME');?></th>
			<th><?php echo $this->Paginator->sort('LINK');?></th>
			<th><?php echo $this->Paginator->sort('IP');?></th>
			<th><?php echo $this->Paginator->sort('IPTYPE');?></th>
			<th><?php echo $this->Paginator->sort('IPSPEED');?></th>
			<th><?php echo $this->Paginator->sort('IPVELOCITYDIRECTION');?></th>
			<th><?php echo $this->Paginator->sort('OPTYPE');?></th>
			<th><?php echo $this->Paginator->sort('OPSPEED');?></th>
			<th><?php echo $this->Paginator->sort('OPVELOCITYDIRECTION');?></th>
			<th><?php echo $this->Paginator->sort('OP');?></th>
			<th><?php echo $this->Paginator->sort('REVERSIBILITY');?></th>
			<th><?php echo $this->Paginator->sort('RELBETWNIP');?></th>
			<th><?php echo $this->Paginator->sort('RELBETWNIPAX');?></th>
			<th><?php echo $this->Paginator->sort('Dimension');?></th>
			<th><?php echo $this->Paginator->sort('MCI');?></th>
			<th><?php echo $this->Paginator->sort('DOF');?></th>
			<th><?php echo $this->Paginator->sort('Function');?></th>
			<th><?php echo $this->Paginator->sort('IPMOTION');?></th>
			<th><?php echo $this->Paginator->sort('MOTIINVOLVED');?></th>
			
	</tr>
	<?php
	foreach ($mechanisms as $mechanism): ?>
	<tr>
		<td><?php echo h($mechanism['Mechanism']['GROUP']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['NAME']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['LINK']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['IP']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['IPTYPE']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['IPSPEED']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['IPVELOCITYDIRECTION']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['OPTYPE']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['OPSPEED']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['OPVELOCITYDIRECTION']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['OP']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['REVERSIBILITY']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['RELBETWNIP']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['RELBETWNIPAX']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['Dimension']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['MCI']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['DOF']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['Function']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['IPMOTION']); ?>&nbsp;</td>
		<td><?php echo h($mechanism['Mechanism']['MOTIINVOLVED']); ?>&nbsp;</td>
		
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

