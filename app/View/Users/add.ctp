<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
    <?php
        echo $this->Form->input('firstname');
        echo $this->Form->input('lastname');
		echo $this->Form->input('organization');
        echo $this->Form->input('email');
        echo $this->Form->input('password');
		echo $this->Form->input('agree', array('type'=>'checkbox',
												'label' => 'By checking this box, I agree to the Ideation Space ' . $this->Html->link('Terms of Use', array('controller' => 'pages', 'action' => 'display', 'terms_of_use')) . '.'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>