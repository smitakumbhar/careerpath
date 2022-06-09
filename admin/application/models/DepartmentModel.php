<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentModel extends CI_Model
{

    public function getDepartments() 
    {
    	
    	$this->db->select('id'); 
    	$this->db->select('department_name'); 
    	$this->db->order_by('department_name','asc'); 
		$query = $this->db->get(TABLE_DEPARTMENT);
		$data_departments=$query->result_array();
		return $data_departments;
    }

    function department_list()
	{
		$this->db->order_by('department_name','asc'); 
		$query = $this->db->get(TABLE_DEPARTMENT);
		$data_department=$query->result_array();
		return $data_department;
    }
    public function add_new_department($data)
	{	
		$this->db->insert(TABLE_DEPARTMENT,$data);
		return true;
		
	}

	public function edit_department($data, $id)
	{
		$this->db->where('id', $id);
		$query=$this->db->update(TABLE_DEPARTMENT, $data);
		return true;
	}
	public function get_department($id)
	{
		$this->db->where("id",$id);
		$query = $this->db->get(TABLE_DEPARTMENT);
		return $result = $query->row_array();
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_DEPARTMENT);
	   	return TRUE;
	}
}
?>