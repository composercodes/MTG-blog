
<h1>Client Actions</h1>
<p>
Choose your action
<ul>
<li><?php echo $this->Html->link('Request Posts List', array('controller' => 'client', 'action' => 'request_index')); ?></li>
<li><?php echo $this->Html->link('Request To Add a Post', array('controller' => 'client', 'action' => 'request_add')); ?></li>
<li><?php echo $this->Html->link('View Post with ID 1', array('controller' => 'client', 'action' => 'request_view', 9)); ?></li>
<li><?php echo $this->Html->link('Update Post with ID 2', array('controller' => 'client', 'action' => 'request_edit', 2)); ?></li>
<li><?php echo $this->Html->link('Delete Post with ID 3', array('controller' => 'client', 'action' => 'request_delete'), 3); ?></li>
</ul>

</p>

