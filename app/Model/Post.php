<?php
App::uses('AppModel', 'Model');

class Post extends AppModel {

    public $actsAs = array(
        'ImageFile' => array(
            'img' => array('width' => ''  , 'height' => ""
               ,'thumbs' => array(
                    array('prefix' => 'thumb1_', 'width' => 280, 'height' => 204),
                    //array('prefix' => 'thumb2_', 'width' => 130, 'height' => 110)

               )
                )
        )
    );


	// The Associations below have been created with all possible keys, those that are not needed can be removed
	public function isOwnedBy($post, $user) {
		return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
	}
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'post_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
