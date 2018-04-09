<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Model {

	public function __construct() {
		parent::__construct();

		//load database library
		$this->load->database();
	}

	/*
	 * Fetch articles data
	 */
	function getRows($id_cat = ""){
		if(!empty($id_cat)){
			$query = $this->db->get_where('articles', array('id_art' => $id_cat));
			return $query->row_array();
		}else{
			$query = $this->db->get('articles');
			return $query->result_array();
		}
	}

	/*
	 * Insert articles data
	 */
	public function insert($data = array()) {
		if(!array_key_exists('created', $data)){
			$data['created'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists('modified', $data)){
			$data['modified'] = date("Y-m-d H:i:s");
		}
		$insert = $this->db->insert('articles', $data);
		if($insert){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	/*
	 * Update articles data
	 */
	public function update($data, $id_cat) {
		if(!empty($data) && !empty($id_cat)){
			if(!array_key_exists('modified', $data)){
				$data['modified'] = date("Y-m-d H:i:s");
			}
			$update = $this->db->update('articles', $data, array('id_cat'=>$id_cat));
			return $update?true:false;
		}else{
			return false;
		}
	}

	/*
	 * Delete articles data
	 */
	public function delete($id_cat){
		$delete = $this->db->delete('articles',array('id_cat'=>$id_cat));
		return $delete?true:false;
	}

}
?>