<?php

class TestController extends AppController {

var $name = 'Test';

	function index(){
		$zip = new ZipArchive();
		var_dump($zip);die;
			$this->debugLog('loi roi');
			$t = 1;
			try {
				if($t == 2) {
					echo 'tes';
				}	
			} catch (Exception $e) {
				Throw $e;
			}
			$this->loadModel('Student');
			$data = $this->Student->find('all');
			 $enjson = json_encode($data);
			 print_r(json_decode($enjson));die;
			$this->set("data",$data);
	}
	
	function add() {
		if($this->request->is('post')) {
			$params = $this->request->data;
			$this->loadModel('Student');
			$errors = $this->Student->validateForm($params);
			if(count($errors) > 0) {
				$this->set('errors', $errors);
			} else {
				$data = array ('Student' => array ('name' => $params['Student']['name']));
				$this->Student->save($data);
				die('save success');
			}	
		}
	}
	
	function edit($id) {
		$this->loadModel('Student');
		if($this->request->is('post')) {
			$params = $this->request->data;
			$errors = $this->Student->validateForm($params);
			if(count($errors) > 0) {
				$this->set('errors', $errors);
			} else {
				$this->Student->id = $id;
				$this->Student->save($params);
				die('save success');
			}
		}
		$data = $this->Student->find('first', array(
			'fields' => array ('id', 'name', 'phone'),
			'conditions' => array('id' => $id)
		));
		$this->set('data', $data);
	}
}
