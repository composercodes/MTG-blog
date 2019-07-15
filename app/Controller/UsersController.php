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
		$this->Auth->allow('add','signout');		
    }	
	
    /**
    * add method
    */
    public function add() {
        if ($this->request->is('post')) {
            $this->request->data['User']['group_id'] = 3 ;
            $this->request->data['User']['type'] = 2 ;
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
     * User Login method
     */
    public function login() {

        if ($this->Auth->loggedIn()) {
            $this->Session->setFlash('You are already Login','default',array('class'=>'flash-success'));
            if($this->Auth->user('group_id')== 1) {
                return  $this->redirect(array('controller'=>'home','action' => 'admin'));
            }else if($this->Auth->user('group_id')== 2) {
                return  $this->redirect('/doctor');
            }else if($this->Auth->user('group_id')== 3) {
                return  $this->redirect('/recep');
            }
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if($this->Auth->user('group_id')== 1) {
                    return  $this->redirect(array('controller'=>'home','action' => 'admin'));
                }else if($this->Auth->user('group_id')== 2) {
                    return  $this->redirect('/doctor');
                }else if($this->Auth->user('group_id')== 3) {
                    return  $this->redirect('/recep');
                }
            }else{
                $this->Session->setFlash(__('خطأ ما فى الاسم أو الباسورد ... أعد المحاولة'),'default',array('class'=>'flash-error'));
                return $this->redirect('/login');
            }
        }
    }
    public function logout() {
        $this->Session->delete("USER");
        if ($this->Auth->logout()) {
            //$this->Cookie->destroy();
            $this->Session->setFlash("تم تسجيل الخروج بنجاح !",'default',array('class'=>'flash-success', 'logout'));
        }
        return $this->redirect($this->Auth->logout());
    }
	
    /**
     * User Login method
     */
    public function signinn() {
        if ($this->Auth->loggedIn()) {
            $this->Session->setFlash('You are already Login','default',array('class'=>'flash-success'));
            return  $this->redirect(array('controller'=>'Home','action' => 'index'));
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return  $this->redirect(array('controller'=>'Home','action' => 'index'));
            }else{
                $this->Session->setFlash(__('خطأ ما فى الاسم أو الباسورد ... أعد المحاولة'),'default',array('class'=>'flash-error'));
                return $this->redirect('/signin');
            }
        }
    }	
	
    public function signout() {
        $this->Session->delete("USER");
        if ($this->Auth->logout()) {
            //$this->Cookie->destroy();
            $this->Session->setFlash("Log out",'default',array('class'=>'flash-success', 'logout'));
        }
        return  $this->redirect('/');
    }	
}
