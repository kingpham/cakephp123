<h1>Edit Post</h1>
<?php if(isset($errors)) {
	foreach($errors as $value) {
		echo $value;
	}
} ?>
<?php
echo $this->Form->create('Student');
echo $this->Form->input('name', array('value' => $data['Student']['name']));
echo $this->Form->input('phone', array('value' => $data['Student']['phone']));
echo $this->Form->submit('Edit');
echo $this->Form->end();
?>