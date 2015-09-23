<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $components = array('Auth', 'RequestHandler', 'Session', 'Security');
	var $helpers = array('Html','Form', 'Session');  
	/* check login */
	function beforeFilter()
	{
		Security::setHash("md5");
		$this->Auth->userModel = 'User';
		$this->Auth->fields = array (
				'username' => 'username',
				'password' => 'password' 
		);
		$this->Auth->loginAction = array (
				'admin' => false,
				'controller' => 'user',
				'action' => 'login' 
		);
		$this->Auth->loginRedirect = array (
				'admin' => true,
				'controller' => 'user',
				'action' => 'index' 
		);
		$this->Auth->loginError = 'Username / password combination.  Please try again';
		$this->Auth->authorize = 'controller';
		//action allow not login
		$this->Auth->allow('login', 'admin_add');
		$this->set("admin",$this->_isAdmin());
		$this->set("logged_in",$this->_isLogin());
		$this->set("users_userid",$this->_usersUserID());
		$this->set("users_username",$this->_usersUsername());
	}
	
	/**
	 * Xac nhan co phai la admin hay khong
	 * TRUE : phai
	 * FASLE : khong
	 */
	function _isAdmin(){
		$admin = FALSE;
		if($this->Auth->user("level")==1)
			$admin = TRUE;
		return $admin;
	}
	
	/**
	 * Kiem tra da login chua
	 */
	function _isLogin(){
		$login = FALSE;
		if($this->Auth->user()){
			$login = TRUE;
		}
		return $login;
	}
	
	/**
	 * Xac nhan userID
	 */
	function _usersUserID(){
		$users_userid = NULL;
		if($this->Auth->user())
			$users_userid = $this->Auth->user("id");
		return $users_userid;
	}
	
	/**
	 * Xac nhan username
	 */
	function _usersUsername(){
		$users_username = NULL;
		if($this->Auth->user())
			$users_username = $this->Auth->user("username");
		return $users_username;
	}
	
	/**
	 * Xac nhan co phai truy cap vao trang admin hay khong
	 */
	function isAuthorized() {
		if (isset($this->params['admin'])) {
	
			if ($this->Auth->user('level') != 1) {
				$this->Auth->allow("index");
				$this->redirect("/user");
			}
		}
		return true;
	}
	/**
	 * パラメータログを出力します。
	 *
	 * @access	public
	 * @param	$value : 値
	 * @param	$name  : パラメータ名
	 * @return	なし
	 */
	protected function paramLog($value, $name)
	{
		$msg = sprintf('$%s : %s', $name, $value);
	
		$this->debugLog($msg);
	}
	
	/**
	 * Debugログを出力します。
	 *
	 * @access	public
	 * @param	メッセージ
	 * @return	なし
	 */
	protected function debugLog($msg)
	{
		if (!is_string($msg)) {
			$msg = print_r($msg, true);
		}
	
		// [画面ID][IPアドレス]メッセージ
		$bt = debug_backtrace();
		$i = ($bt[1]['function'] == '_debugLog') ? 1 : 0;
		$msg = sprintf('[%7s][%s] %s(%s): %s.%s() %s', $this->function, $_SERVER['REMOTE_ADDR'], basename($bt[$i]['file']), $bt[$i]['line'], $this->name, $this->action, $msg);
	
		$this->log($msg, LOG_DEBUG);
	}
	public function _debugLog($msg) {
		$this->debugLog($msg);
	}
	
	/**
	 * Infoログを出力します。
	 *
	 * @access	public
	 * @param	メッセージ
	 * @return	なし
	 */
	protected function infoLog($msg)
	{
		if (!is_string($msg)) {
			$msg = print_r($msg, true);
		}
	
		// [画面ID][IPアドレス]メッセージ
		$bt = debug_backtrace();
		$msg = sprintf('[%7s][%s] %s(%s): %s.%s() %s', $this->function, $_SERVER['REMOTE_ADDR'], basename($bt[0]['file']), $bt[0]['line'], $this->name, $this->action, $msg);
	
		$this->log($msg, LOG_INFO);
	}
	
	
	/**
	 * Errorログを出力します。
	 *
	 * @access	public
	 * @param	メッセージ
	 * @return	なし
	 */
	protected function errorLog($msg)
	{
		if (!is_string($msg)) {
			$msg = print_r($msg, true);
		}
	
		// [画面ID][IPアドレス]メッセージ
		$bt = debug_backtrace();
		$msg = sprintf('[%7s][%s] %s(%s): %s.%s() %s', $this->function, $_SERVER['REMOTE_ADDR'], basename($bt[0]['file']), $bt[0]['line'], $this->name, $this->action, $msg);
	
		$this->log($msg, LOG_ERR);
	}
	
	/**
	 * Warnログを出力します。
	 *
	 * @access	public
	 * @param	メッセージ
	 * @return	なし
	 */
	protected function warnLog($msg)
	{
		if (!is_string($msg)) {
			$msg = print_r($msg, true);
		}
	
		// [画面ID][IPアドレス]メッセージ
		$bt = debug_backtrace();
		$msg = sprintf('[%7s][%s] %s(%s): %s.%s() %s', $this->function, $_SERVER['REMOTE_ADDR'], basename($bt[0]['file']), $bt[0]['line'], $this->name, $this->action, $msg);
	
		$this->log($msg, LOG_WARNING);
	}
}
