<?php
App::uses('AppController', 'Controller');

class RestPostsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $uses = array('Post');
	public $components = array('Paginator','RequestHandler');
       
    /** ----------------------------- REST -------------------------------------------- **/
    public function __commonHeader() {
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Methods','*');
        $this->response->header('Access-Control-Allow-Credentials', 'true');
        $this->response->header('Access-Control-Allow-Request-Method', '*');
        $this->response->header('Access-Control-Allow-Headers','Origin, X-Requested-With, Content-Type, Accept, Authorization');
    }   
    
    public function index() {
        $this->__commonHeader();
        $this->paginate = array(
            'order' => array(
                'Post.id' => 'desc'
            ),'limit'=>50 //,'recursive'=>-1
        );
        $posts = $this->Paginator->paginate(); 
		//var_dump($posts);
        $posts = Hash::extract($posts, '{n}.Post');
        $postss['posts']=$posts;
        $postss['pages'] = $this->params['paging']['Post']['pageCount'];
		if ($posts){
			$postss['status'] = 200;
		}
        $this->set(array(
            'posts' => $postss, 
            '_serialize' => 'posts'
        ));
    }
    
    public function view($post_id = null) {
        $this->__commonHeader(); 
        $post = $this->Post->find('first',array('conditions'=>array('Post.id'=>$post_id),'fields'=>array('id','title','content','created','img')));
        //$post = Hash::extract($post, '{n}.Post');
        $this->set(array(
            'post' => $post, 
            '_serialize' => 'post'
        ));
    }
    
    public function edit($id) {
        $this->Post->id = $id;
        if ($this->Post->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
     
    public function delete($id) {
        if ($this->Post->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
   
}
