<!-- app/View/ProblemMaps/add.ctp -->
<div class="session edit form">
<?php echo $this->Form->create();?>
    <fieldset>
        <legend><?php echo __('Edit Session'); ?></legend>
    <?php
    	echo $this->Form->input('name', array(
	    	'type' => "text"
	    ));
        echo $this->Form->input('description');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>