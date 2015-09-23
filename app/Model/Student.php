<?php
App::uses('AppModel', 'Model');
/**
 * Student Model
 *
 */
class Student extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'student';

	function validateForm($params) {
		$errors = array();
		if($params['Student']['name'] == '') {
			$errors['name'] = 'vui long nhap';
		}
		return $errors;
	}
}
