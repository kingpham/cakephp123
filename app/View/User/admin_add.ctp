<h1>Add User</h1>
<?php echo $this->Session->flash() ?>
<?php
echo $this->Form->create('User', array('url' => '/admin/user/add'));
echo $this->Form->input('username');
echo $this->Form->input('password', array('type' => 'password'));
echo $this->Form->input('re_password', array('type' => 'password'));
echo $this->Form->input('level', array('type' => 'select', 'options' => $options));
echo $this->Form->submit('Add');
echo $this->Form->end();
?>