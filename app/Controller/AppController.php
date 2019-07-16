<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $components = array('Cookie','Session','Flash','RequestHandler','Auth' => array(
        'loginRedirect' => array('controller' => 'pages', 'action' => 'home'),
        'logoutRedirect' => array(
            'controller' => 'pages',
            'action' => 'home',
        ),
        'authorize' => array('Controller') 
    )
	);
    public $helpers = array('Form','Session','Html','Text','Time','Number','Js');

    /**
     * call beforeFilter
    **/
    public function beforeFilter() {

        $this->Auth->authenticate = array('Form'=> array('userModel' => 'User','fields'=>array('username'=>'username')));
        
        if (isset($this->request->params['admin'])){
            $this->layout = 'admin';
        } 
    }
	
	//auth check
	public function isAuthorized($user) {
		// Admin can access every action
		
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true;
		}

		// Default deny
		$this->Flash->error(__('You are not allowed to acces this level'));
		return false;
	}
}
