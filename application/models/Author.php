<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Author extends CI_Model {

	public function __construct() {
		parent::__construct();

		//load database library
		$this->load->database();
	}

	/*
	 * Fetch authors data
	 */
	function getRows($id = ""){
		if(!empty($id)){
			$query = $this->db->get_where('authors', array('id_authors' => $id));
			return $query->row_array();
		}else{
			$query = $this->db->get('users');
			return $query->result_array();
		}
	}

	/*
	 * Insert authors data
	 */
	public function insert($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['created'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists('modified', $data)){
			$data['modified'] = date("Y-m-d H:i:s");
		}
		$insert = $this->db->insert('users', $data);
		if($insert){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	/*
	 * Update authors data
	 */
	public function update($data, $id) {
		if(!empty($data) && !empty($id)){
			if(!array_key_exists('modified', $data)){
				$data['modified'] = date("Y-m-d H:i:s");
			}
			$update = $this->db->update('users', $data, array('id_authors'=>$id));
			return $update?true:false;
		}else{
			return false;
		}
	}

	/*
	 * Delete authors data
	 */
	public function delete($id){
		$delete = $this->db->delete('authors',array('id_author'=>$id));
		return $delete?true:false;
	}

}
?>