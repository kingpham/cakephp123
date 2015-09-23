<?php
class UserController extends AppController {
	var $name = 'User';
	public function index() {
	}

	function admin_index() {
		$data = $this->User->find("all");
		$this->set("users", $data);
	}

	/**
	 * Them moi User
	 */
	public function admin_add() {
		$st = $this->oneByteToTwoBytes('123');
		echo $st;
		if ($this->request->is('post')) {
			if (! empty($this->request->data)) {
				$this->User->set($this->request->data);
				if ($this->User->validateUser()) {
					$this->User->create();
					if ($this->User->save($this->request->data)) {
						$this->Session->setFlash("Thêm mới user thành công !");
						die('them moi thanh cong');
					} else {
						die('khong thanh cong');
					}
					// $this->redirect("/admin/users");
				}
			} else {
				$this->render();
			}
		}
		$options = array (
				"" => "Select Level",
				"1" => "Administrator",
				"2" => "Assistant" 
		);
		$this->set('options', $options);
	}

	function oneByteToTwoBytes($string) {
		if ($string == '') {
			return NULL;
		}
		if (! is_scalar($string)) {
			return NULL;
		}
	
		if (! is_string($string)) {
			return NULL;
		}
		//mb_internal_encoding('EUC-JP');
		return mb_convert_kana($string, 'RNASKHC');
	}
	
	public function login() {
		// if already logged-in, redirect
		if ($this->Session->check('Auth.User')) {
			$this->redirect(array (
					'action' => 'index' 
			));
		}
		// if we get the post information, try to authenticate
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->setFlash(__('Welcome, ' . $this->Auth->user('username')));
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('Invalid username or password'));
			}
		}
	}
	
	/*
	 * Public function view(){ if(!$this->Session->read($this->_sessionUsername)) { // đọc Session xem có tồn tại không $this->redirect("login"); } else { $this->render("/users/index"); // load 1 file view index.ctp trong thư mục “views/demos/users”/ } } Public function login(){ if($this->Session->read($this->_sessionUsername)) $this->redirect("view"); if ($this->request->is('post')) { $this->User->set($this->request->data); if ($this->User->validateLogin() == FALSE) { $this->Session->setFlash("Data is not avaliable !"); return false; } $params = $this->request->data; if($this->User->checkLogin($params['User']['username'],$params['User']['password'])){ $this->Session->write($this->_sessionUsername,$params['User']['username']); $this->redirect("view"); }else{ $this->Session->setFlash(__('Invalid username or password, try again')); } } }
	 */
	public function logout() {
		$this->Session->delete($this->_sessionUsername);
		$this->redirect("login");
	}
}
?>