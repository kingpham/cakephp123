<?php
class User extends AppModel {
	var $name = 'User';
	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'user';
	
	var $validate = array ();

	/*public function validateLogin() {
		$this->validate = array (
				'username' => array (
						'rule' => 'notEmpty',
						'message' => 'Vui lòng nhập tên đăng nhập'
				),
				'password' => array (
						'rule' => 'notEmpty',
						'message' => 'Vui lòng nhập mật khẩu'
				)
		);
		if ($this->validates($this->validate)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}*/

	function validateUser() {
		$this->validate = array (
				"username" => array (
						"rule1" => array (
								"rule" => "notEmpty",
								"message" => "Username can not empty"
						),
						"rule2" => array (
								"rule" => "/^[a-z0-9_.]{4,}$/i",
								"message" => "Username must be alpha & integer"
						)
					/*	"rule3" => array (
								"rule" => "checkUsername", // call function check Username
								"message" => "Username has been registered"
						)*/
			),
			"password" => array (
					"rule" => "notEmpty",
					"message" => "Password can not empty",
					"on" => "create"
			),
			"re_password" => array (
					"rule1" => array (
							"rule" => "notEmpty",
							"message" => "Password comfirm can not empty",
							"on" => "create"
					),
					"match" => array (
							"rule" => "ComparePass", // call function compare password
							"message" => "Password comfirm are not match"
					)
			),
			"level" => array (
					"rule" => "notEmpty",
					"message" => "Please select level"
			)
				
		);
		if ($this->validates($this->validate)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	// --------- Compare Pass
	function ComparePass() {
		if ($this->data['User']['password'] != $this->data['User']['re_password']) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	// -------- Check Useranme
	function checkUsername() {
		if (isset($this->data[$this->name]['id'])) {
			$where = array (
					"id !=" => $this->data[$this->name]['id'],
					"username" => $this->data[$this->name]['username']
			);
		} else {
			$where = array (
					"username" => $this->data[$this->name]['username']
			);
		}

		$this->find($where);
		$count = $this->getNumRows();
		if ($count != 0) {
			return false;
		} else {
			return true;
		}
	}

	// --- HashPassword
	function hashPassword($data) {
		if (isset($this->data['User']['password'])) {
			$this->data['User']['password'] = Security::hash($this->data['User']['password'], NULL, TRUE);
			return $data;
		}
		return $data;
	}
	 //----- beforeSave
    function beforeSave($options = array()){
        $this->hashPassword(NULL,TRUE);
        return TRUE;
    }

    //--- beforeValidate
    function beforeValidate($options = array()){
    }

	public function checkLogin($username, $password) {
		$sql = "SELECT username,password FROM users Where username = :username AND password = :password";
		$this->query($sql, array (
				'username' => $username,
				'password' => $password
		));
		if ($this->getNumRows() == 0) {
			return false;
		} else {
			return true;
		}
	}
}
