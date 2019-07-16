<?php
App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class User extends AppModel {

	/**
	* Validation rules
	*
	* @var array
	*/
	public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter User Name'
            ),
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'User Name already used before'
			)
		),
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please insert Name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'minLength' => array(
				'rule'    => array('minLength', '6'),
				'message' => 'Password should be more than 6 numbers or char',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'matchpwd' => array(
				'rule' => array('matchpwd'),
				'message' => 'password not match ',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'retype_password' => array(
			'matchpwd' => array(
				'rule' => array('matchpwd'),
				'message' => 'password not match',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
    public static function getroles() {
        return array('admin'=>'admin','writer'=>'writer');
    }


	function matchpwd($data){
		if ($this->data[$this->alias]['password']!=$this->data[$this->alias]['retype_password'] ) {
			return false;
		}
		return true;
	}


	function changeStatus($ids, $status) {
		$ids = array_map('intval', $ids);
		$this->query('UPDATE users SET active = ' . $status . ' WHERE id IN ('. implode(',', $ids) . ')');
		return $this->getAffectedRows();
	}

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password']) && !empty($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}

		if (isset($this->data[$this->alias]['username']) && !empty($this->data[$this->alias]['username'])) {
			$this->data[$this->alias]['username'] = strtolower($this->data[$this->alias]['username']);
		}

		if (isset($this->data[$this->alias]['email']) && !empty($this->data[$this->alias]['email'])) {
			$this->data[$this->alias]['email'] = strtolower($this->data[$this->alias]['email']);
		}

		return true;
	}
}