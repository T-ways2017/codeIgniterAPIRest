<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Authors extends REST_Controller {

	public function __construct() {
		parent::__construct();

		//load user model
		$this->load->model('authors');
	}

	public function author_get($id = 0) {
		//returns all rows if the id parameter doesn't exist,
		//otherwise single row will be returned
		$authors = $this->author->getRows($id);

		//check if the authors data exists
		if(!empty($authors)){
			//set the response and exit
			//OK (200) being the HTTP response code
			$this->response($authors, REST_Controller::HTTP_OK);
		}else{
			//set the response and exit
			//NOT_FOUND (404) being the HTTP response code
			$this->response([
				'status' => FALSE,
				'message' => 'No author were found.'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function author_post() {
		$authorData = array();
		$authorData['first_name'] = $this->post('first_name');
		$authorData['last_name'] = $this->post('last_name');
		$authorData['email'] = $this->post('email');
		$authorData['phone'] = $this->post('phone');
		if(!empty($authorData['first_name']) && !empty($authorData['last_name']) && !empty($authorData['email']) && !empty($authorData['phone'])){
			//insert user data
			$insert = $this->author->insert($authorData);

			//check if the authors data inserted
			if($insert){
				//set the response and exit
				$this->response([
					'status' => TRUE,
					'message' => 'author has been added successfully.'
				], REST_Controller::HTTP_OK);
			}else{
				//set the response and exit
				$this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			//set the response and exit
			//BAD_REQUEST (400) being the HTTP response code
			$this->response("Provide complete author information to create.", REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function user_put() {
		$authorData = array();
		$id = $this->put('id');
		$authorData['first_name'] = $this->put('first_name');
		$authorData['last_name'] = $this->put('last_name');
		$authorData['email'] = $this->put('email');
		$authorData['phone'] = $this->put('phone');
		if(!empty($id) && !empty($authorData['first_name']) && !empty($authorData['last_name']) && !empty($authorData['email']) && !empty($authorData['phone'])){
			//update authors data
			$update = $this->author->update($authorData, $id);

			//check if the authors data updated
			if($update){
				//set the response and exit
				$this->response([
					'status' => TRUE,
					'message' => 'authors has been updated successfully.'
				], REST_Controller::HTTP_OK);
			}else{
				//set the response and exit
				$this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			//set the response and exit
			$this->response("Provide complete user information to update.", REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function author_delete($id){
		//check whether post id is not empty
		if($id){
			//delete post
			$delete = $this->author->delete($id);

			if($delete){
				//set the response and exit
				$this->response([
					'status' => TRUE,
					'message' => 'authors has been removed successfully.'
				], REST_Controller::HTTP_OK);
			}else{
				//set the response and exit
				$this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			//set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No authors were found.'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}
}

?>
