<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Categories extends REST_Controller {

	public function __construct() {
		parent::__construct();

		//load categorie model
		$this->load->model('categorie');
	}

	public function categorie_get($id = 0) {
		//returns all rows if the id parameter doesn't exist,
		//otherwise single row will be returned
		$categories = $this->categorie->getRows($id);

		//check if the categorie data exists
		if(!empty($categories)){
			//set the response and exit
			//OK (200) being the HTTP response code
			$this->response($categories, REST_Controller::HTTP_OK);
		}else{
			//set the response and exit
			//NOT_FOUND (404) being the HTTP response code
			$this->response([
				'status' => FALSE,
				'message' => 'No categorie were found.'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function categorie_post() {
		$categorieData = array();
		$categorieData['libelle'] = $this->post('libelle');
		$categorieData['slug'] = $this->post('slug');

		if(!empty($categorieData['libelle']) && !empty($categorieData['slug'])){
			//insert user data
			$insert = $this->categorie->insert($categorieData);

			//check if the categorie data inserted
			if($insert){
				//set the response and exit
				$this->response([
					'status' => TRUE,
					'message' => 'categorie has been added successfully.'
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
		$categorieData = array();
		$id = $this->put('id_cat');
		$categorieData['libelle'] = $this->put('libelle');
		$categorieData['slug'] = $this->put('slug');

		if(!empty($id) && !empty($userData['libelle']) && !empty($userData['slug']) ){
			//update categorie data
			$update = $this->categorie->update($categorieData, $id);

			//check if the categorie data updated
			if($update){
				//set the response and exit
				$this->response([
					'status' => TRUE,
					'message' => 'categorie has been updated successfully.'
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

	public function categorie_delete($id){
		//check whether post id is not empty
		if($id){
			//delete post
			$delete = $this->categorie->delete($id);

			if($delete){
				//set the response and exit
				$this->response([
					'status' => TRUE,
					'message' => 'categorie has been removed successfully.'
				], REST_Controller::HTTP_OK);
			}else{
				//set the response and exit
				$this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			//set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No categorie were found.'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}
}

?>
