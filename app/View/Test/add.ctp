<h1>Add Post</h1>
<?php if(isset($errors)) {
	foreach($errors as $value) {
		echo $value;
	}
} ?>
<?php
echo $this->Form->create('Student', array('url' => '/test/add'));
echo $this->Form->input('name', array('class' => 'abc'));
echo $this->Form->input('phone');
echo $this->Form->submit('Register');
echo $this->Form->end();
?>