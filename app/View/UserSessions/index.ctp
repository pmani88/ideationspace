<!-- File: /app/View/Sessions/index.ctp -->
<?php

// load the CSS for the context menu
$this->Html->css('index-session', null, array('inline' => false));

  
?>

<div id="top">
<h1>Available Sessions</h1>
<p><?php echo $this->Html->link('Add New Session', array('action' => 'add')); ?></p>
</div>
<table>
    <tr>
        <th>Id</th>
		<th>Owner</th>
        <th>Name</th>
        <th>Description</th>
		<th>Actions</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $Sessions array, printing out session info -->

    <?php foreach ($UserSessions as $user_session): ?>
    <tr>
        <td><?php echo $user_session['UserSession']['id']; ?></td>
		<td><?php echo $user_session['User']['firstname'] . ' ' . $user_session['User']['lastname']; ?>
        <td>
            <?php echo $this->Html->link($user_session['UserSession']['name'],
array('controller' => 'user_sessions', 'action' => 'disclaimer', $user_session['UserSession']['id'])); ?>
        </td>
        <td><?php echo $user_session['UserSession']['description']; ?></td>
		<td>
		<?php echo $this->Html->link('Edit', array('action' => 'edit', $user_session['UserSession']['id']));?>
		<?php echo $this->Form->postLink(
		                'Delete',
		                array('action' => 'delete', $user_session['UserSession']['id']),
		                array('confirm' => 'Are you sure?'));
		            ?>
		</td>
        <td><?php echo $user_session['UserSession']['created']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>