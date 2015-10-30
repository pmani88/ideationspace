<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Welcome! Please log in.'); ?></legend>
    <?php
        echo $this->Form->input('email');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<p>Don't have an account? <?php echo $this->Html->link('Create one here.', array('action' => 'add'));?></p>
<?php echo $this->Form->end(__('Login'));?>
</div>