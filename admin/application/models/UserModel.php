<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model
{

	// adding user data 
	public function add_new_user($data)
	{	
		$this->db->insert(TABLE_BACKEND_USER_MASTER,$data);
		return true;
		
	}

	function delete($id)
	{
		$this->db->where('user_id', $id);
		$this->db->delete(TABLE_BACKEND_USER_MASTER);
	   	return TRUE;
	}

	//User List 
	function users_list()
	{

		$this->db->order_by('user_name','asc'); 
		$query = $this->db->get(TABLE_BACKEND_USER_MASTER);
		$data_users=$query->result_array();
		return $data_users;
    }

    //-----------------------------------------------------
	function change_status($data)
	{	
		$this->db->set('admin_approval', $data['admin_approval']);
		$this->db->where('user_id', $data['user_id']);
		$query=$this->db->update(TABLE_BACKEND_USER_MASTER);
		return $result = $query->row_array();
	} 

	public function edit_user($data, $id)
	{
		$this->db->where('user_id', $id);
		$query=$this->db->update(TABLE_BACKEND_USER_MASTER, $data);
		return true;
	}

	// Get user detial by ID
	public function get_user_by_id($id)
	{
		$this->db->where("user_id",$id);
		$query = $this->db->get(TABLE_BACKEND_USER_MASTER);
		return $result = $query->row_array();
	}
	public function get_user_name($id)
	{
		$this->db->select("user_name");
		$this->db->where("user_id",$id);
		$query = $this->db->get(TABLE_BACKEND_USER_MASTER);
		return $result = $query->row_array();
	}

	public function getUsers() 
    {
    	
    	$this->db->select('user_id'); 
    	$this->db->select('user_name'); 
    	$this->db->order_by('user_name','asc'); 
		$query = $this->db->get(TABLE_BACKEND_USER_MASTER);
		$data_users=$query->result_array();
		return $data_users;
    }
}
?>