<?php
App::uses('HttpSocket', 'Network/Http');
class ClientController extends AppController {
	public $components = array('Security', 'RequestHandler');


	//call beforefilter	
    public function beforefilter(){
        parent::beforefilter();
		
    }
	//auth check
	public function isAuthorized($user) {
		return True;
	}		
	public function index(){
		
	}

	public function request_index(){
	
		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_posts.json';
		
		$data = null;
		$httpSocket = new HttpSocket();
		$response = $httpSocket->get($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
	
	public function request_view($id){
	
		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_posts/'.$id.'.json';

		$data = null;
		$httpSocket = new HttpSocket();
		$response = $httpSocket->get($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
	
	public function request_edit($id){
	
		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_posts/'.$id.'.json';

		$data = null;
		$httpSocket = new HttpSocket();
		$data['Post']['title'] = 'Updated title ';
		$response = $httpSocket->put($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
	
	public function request_add(){
	
		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_posts.json';

		$data = null;
		$httpSocket = new HttpSocket();
		$data['Post']['title'] = 'New title';
		$response = $httpSocket->post($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
	
	public function request_delete($id){
	
		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_posts/'.$id.'.json';

		$data = null;
		$httpSocket = new HttpSocket();
		$response = $httpSocket->delete($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
}