<h1>Login</h1>
<?php if(isset($errors)) {
	foreach($errors as $value) {
		echo $value;
	}
} ?>
<?php
echo $this->Form->create('User', array('url' => '/user/login'));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->submit('login');
echo $this->Form->end();
?>