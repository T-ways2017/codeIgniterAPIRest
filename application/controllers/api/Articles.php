<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Articles extends REST_Controller {

	public function __construct() {
		parent::__construct();

		//load user model
		$this->load->model('article');
	}

	/**
	 * @param int $id
	 */
	public function article_get($id_cat = 0) {
		//returns all rows if the id parameter doesn't exist,
		//otherwise single row will be returned
		$articles = $this->article->getRows($id_cat);

		//check if the user data exists
		if(!empty($articles)){
			//set the response and exit
			//OK (200) being the HTTP response code
			$this->response($articles, REST_Controller::HTTP_OK);
		}else{
			//set the response and exit
			//NOT_FOUND (404) being the HTTP response code
			$this->response([
				'status' => FALSE,
				'message' => 'Pas d\'Article trouvé.'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function article_post() {
		$articleData = array();
		$articleData['titre'] = $this->post('titre');
		$articleData['date_creat'] = $this->post('date_creat');
		$articleData['date_modif'] = $this->post('date_modif');
		$articleData['content'] = $this->post('content');
		$articleData['slug'] = $this->post('slug');
		$articleData['id_cat'] = $this->post('id_cat');
		$articleData['id_author'] = $this->post('id_author');
		if(!empty($articleData['titre']) && !empty($articleData['date_creat']) && !empty($articleData['date_modif']) && !empty($articleData['content'])&& !empty($articleData['slug'])&& !empty($articleData['id_cat'])&& !empty($articleData['id_author'])){
			//insert user data
			$insert = $this->article->insert($articleData);

			//check if the user data inserted
			if($insert){
				//set the response and exit
				$this->response([
					'status' => TRUE,
					'message' => 'User has been added successfully.'
				], REST_Controller::HTTP_OK);
			}else{
				//set the response and exit
				$this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			//set the response and exit
			//BAD_REQUEST (400) being the HTTP response code
			$this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function user_put() {
		$articleData = array();
		$id = $this->put('id_art');
		$articleData['titre'] = $this->put('first_name');
		$articleData['date_creat'] = $this->put('last_name');
		$articleData['date_modif'] = $this->put('email');
		$articleData['content'] = $this->put('phone');
		$articleData['stat'] = $this->put('phone');
		$articleData['slug'] = $this->put('phone');
		$articleData['id_cat'] = $this->put('phone');
		$articleData['id_author'] = $this->put('phone');
		if(!empty($id) && !empty($articleData['first_name']) && !empty($articleData['last_name']) && !empty($articleData['email']) && !empty($articleData['phone'])){
			//update user data
			$update = $this->article->update($articleData, $id);

			//check if the user data updated
			if($update){
				//set the response and exit
				$this->response([
					'status' => TRUE,
					'message' => 'User has been updated successfully.'
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

	public function article_delete($id){
		//check whether post id is not empty
		if($id){
			//delete post
			$delete = $this->article->delete($id);

			if($delete){
				//set the response and exit
				$this->response([
					'status' => TRUE,
					'message' => 'User has been removed successfully.'
				], REST_Controller::HTTP_OK);
			}else{
				//set the response and exit
				$this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			//set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No user were found.'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}
}

?>
