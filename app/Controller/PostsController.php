<?php
App::uses('AppController', 'Controller');

class PostsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','RequestHandler');

    public function beforefilter(){
        parent::beforefilter();
    }
    public function isAuthorized($user) {
        //auth check
        return True;
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
	* add method
	*
	* @return void
	*/
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The Post has been saved.'));
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
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The Post has been saved.'));
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
			throw new NotFoundException(__('Invalid Post'));
		}
		if ($this->Post->delete()) {
			$this->Session->setFlash(__('The Post has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
    
    

    
    /** ----------------------------- REST ACtions -------------------------------------------- *
    
    
        /**
    * top method
    */
	public function top() {
		$this->set('courses', $this->Course->find('all',
        array('order' => array( 'Course.id' => 'desc' ))));
	}  
    
    
     /**
     * mark method
    */
	public function mark($id = null) {
	   $this->loadModel('Schedule');
		$options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id));
		$this->set('course', $this->Course->find('first', $options));
        $this->set('students', $this->Course->Student->find('all', array('conditions' => array('Student.course_id' => $id))));
		$options = array('conditions' => array('Schedule.course_id' => $id));
		$this->set('schedules', $this->Schedule->find('all', $options));
        $this->set('couerse_id', $id);
    }
    
    
     /**
     * checkTop method
    */
    public function checkTop() {
        if ($this->request->is('ajax')) {
            $this->loadModel('Student');
            $this->autoRender = false;
            $id = $this->request->data['id'];
            $top = $this->request->data['top'];
            if($this->Student->updateAll(array("Student.top"=>$top ),array("Student.id"=>$id))) {
                return json_encode('success');
            }else{
                return json_encode('fail');
            }
        }
        
    }
       
    /** ----------------------------- REST -------------------------------------------- **/
    public function __commonHeader() {
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Methods','*');
        $this->response->header('Access-Control-Allow-Credentials', 'true');
        $this->response->header('Access-Control-Allow-Request-Method', '*');
        $this->response->header('Access-Control-Allow-Headers','Origin, X-Requested-With, Content-Type, Accept, Authorization');
    }   
    
    public function restindex() {
        $this->__commonHeader();
        $courses = $this->Course->find('all',array('recursive'=>-1,'fields'=>array('title','id')));
        $this->set(array(
            'courses' => $courses,
            '_serialize' => array('courses')
        ));
    }
    
    public function restCourseTop($course_id = null) {
        $this->__commonHeader();
        $students = $this->Course->Student->find('all',array('conditions'=>array('Student.top'=>1,'Student.course_id'=>$course_id),'recursive'=>-1,'fields'=>array('en_name','img')));
        $this->set(array(
            'students' => $students,
            '_serialize' => array('students')
        ));
    }
}
