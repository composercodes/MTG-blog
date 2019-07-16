<?php
App::uses('AppController', 'Controller');

class PostsController extends AppController {

	/**
	* Components
	*
	* @var array
	*/
	public $components = array('Paginator','RequestHandler');


	//call beforefilter	
    public function beforefilter(){
        parent::beforefilter();
    }
	
	//auth check
	public function isAuthorized($user) {
		
		// All registered users can add posts
		if (in_array($this->action , array( 'admin_index', 'admin_view'))) {
			return true;
		}
		if (in_array($this->action , array('admin_add'))) {
			if (isset($user['role']) && $user['role'] === 'admin') {
				$this->Flash->error(__('You are not allowed to acces this level'));
				return false;
			}
		}
		// The owner of a post can edit and delete it
		if (in_array($this->action, array('admin_edit', 'admin_delete'))) {
			
			$postId = (int) $this->request->params['pass'][0];
			if ($this->Post->isOwnedBy($postId, $user['id'])) {
				return true;
			}
			
		}

		return parent::isAuthorized($user);
	}
	
	/**
	* view method
	*
	* @throws NotFoundException
	* @param string $id
	* @return void
	*/
	public function view($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
	}
	
	/**
	* index method
	*
	* @return void
	*/
	public function admin_index() {
		$this->Post->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'order' => array(
                'Post.created' => 'asc'
            )
        );		
		$this->set('posts', $this->Paginator->paginate());		

	}  

	/**
	* view method
	*
	* @throws NotFoundException
	* @param string $id
	* @return void
	*/
	public function admin_view($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
	}

	/**
	* add method
	*
	* @return void
	*/
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->request->data['Post']['user_id'] = $this->Auth->user('id');
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('The Post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.'));
			}
		}
            $this->set('file_settings', $this->Post->getFileSettings());
	}

	/**
	* edit method
	*
	* @throws NotFoundException
	* @param string $id
	* @return void
	*/
	public function admin_edit($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid Post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Post']['user_id'] = $this->Auth->user('id');
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('The Post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
		}
        $this->set('file_settings', $this->Post->getFileSettings());
        $this->render('admin_add');
	}
    
    
    



	/**
	* delete method
	*
	* @throws NotFoundException
	* @param string $id
	* @return void
	*/
	public function admin_delete($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Post->delete()) {
			$this->Flash->success(__('The post has been deleted.'));
		} else {
			$this->Flash->error(__('The post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
    
    

    

}
