<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {
	

    /**
     * call beforeFilter
    **/
    public function beforefilter(){
        parent::beforefilter();
		
		// Allow only the view and index actions.
		$this->Auth->allow('add','signout','signup');		
    }	
	
    /**
    * add method
    */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('تم حفظ المستخدم بنجاح'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('حدث خطأ ما !!!'));
            }
        }
    }

    /**
    * User signup method
    */
    public function signup() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('You are signup Successfully'));
                return $this->redirect('/');
            } else {
                $this->Session->setFlash(__('Something Wrong Please try again'));
            }
        }
    }

	
    /**
     * User Login method
     */
    public function login() {

        if ($this->Auth->loggedIn()) {
            $this->Session->setFlash('You are already Login','default',array('class'=>'flash-success'));
                return  $this->redirect('/');

        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                    return  $this->redirect('/');
            }else{
                $this->Session->setFlash(__('invalid username or password, please try again'),'default',array('class'=>'flash-error'));
                return $this->redirect('/signin');
            }
        }
    }


    /**
     * User signout method
     */
    public function signout() {
        $this->Session->delete("USER");
        if ($this->Auth->logout()) {
            //$this->Cookie->destroy();
            $this->Session->setFlash("Log out",'default',array('class'=>'flash-success', 'logout'));
        }
        return  $this->redirect('/');
    }	
}
