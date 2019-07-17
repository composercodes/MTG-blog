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
	* Components
	*
	* @var array
	*/
	public $components = array('Paginator');
    /**
     * call beforeFilter
    **/
    public function beforefilter(){
        parent::beforefilter();
		
		// Allow only the view and index actions.
		$this->Auth->allow('add','signout','signup');		
    }
	//auth check
    public function isAuthorized($user) {
        
        return True;
    }		
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

	
    /**
    * add method
    */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('تم حفظ المستخدم بنجاح'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('حدث خطأ ما !!!'));
            }
        }
		$roles = $this->User->getroles();
		$this->set('roles', $roles);
    }
	
    /**
    * add method
    */
    public function admin_edit($id) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}

		$roles = $this->User->getroles();
		$this->set('roles', $roles);
		$this->render('admin_add');
    }
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
    /**
    * User signup method
    */
    public function admin_reset() {
        $id = $this->getUser();
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['User']['id']=$id;
            if ($this->request->data['User']['new_password'] == $this->request->data['User']['retype_password'] ) {
                $this->request->data['User']['password'] = $this->request->data['User']['new_password'] ;
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('  تم تغير كلمة المرور بنجاح'));
                    return $this->redirect(array('controller'=>'users','action' => 'view',$id));
                } else {
                    $this->Session->setFlash(__('حدث خطأ ما !!!'));
                    return $this->redirect(array('controller'=>'users','action' => 'reset',$id));
                }
            } else {
                $this->Session->setFlash(__('الباسورد غير متشابهة , من فضلك تأكد من الباسورد الجديدة'));
                return $this->redirect(array('controller'=>'users','action' => 'reset',$id));

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
		$roles = $this->User->getroles();
		$this->set('roles', $roles);		
    }

    /**
     * admin User Login method
     */
    public function admin_login() {
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
		$this->render('login');
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
