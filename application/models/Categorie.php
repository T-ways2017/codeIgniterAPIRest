<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categorie extends CI_Model
{
 public function __construct() {
  parent::__construct();

  //load database
	  $this->load->database();
 }

 /*
  * Fetch all data
  */

	function getRows($id = "")
	{
		if(!empty($id)){
			$query = $this->db->get_where('categories', array('id_cat' => $id));
			return $query->row_array();
		}else{
			$query = $this->db->get('categories');
			return $query->result_array();
		}
	}

	/*
     * Insert user data
     */
	public function insert($data = array())
	{
		if(!array_key_exists('created', $data)){
			$data['created'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists('modified', $data)){
			$data['modified'] = date("Y-m-d H:i:s");
		}
		$insert = $this->db->insert('categories', $data);
		if($insert){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	/*
     * Update user data
     */
	public function update($data, $id) {
		if(!empty($data) && !empty($id)){
			if(!array_key_exists('modified', $data)){
				$data['modified'] = date("Y-m-d H:i:s");
			}
			$update = $this->db->update('categories', $data, array('id_cat'=>$id));
			return $update?true:false;
		}else{
			return false;
		}
	}

	/*
	* Delete user data
	*/
	public function delete($id){
		$delete = $this->db->delete('users',array('id_cat'=>$id));
		return $delete?true:false;
	}

}
