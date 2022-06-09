<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CandidateModel extends CI_Model
{

    public function getCandidate() 
    {
    	
    	$this->db->select('id'); 
    	$this->db->select('first_name');
    	$this->db->select('last_name');  
    	$this->db->order_by('first_name','asc'); 
		$query = $this->db->get(TABLE_CANDIDATE);
		$data_candidate=$query->result_array();
		return $data_candidate;
    }

    // adding industry data 
	public function add_candidate($data)
	{	
		$this->db->insert(TABLE_CANDIDATE,$data);
		return true;
		
	}

	public function edit_candidate($data, $id)
	{
		$this->db->where('id', $id);
		$query=$this->db->update(TABLE_CANDIDATE, $data);
		return true;
	}

	public function get_candidate($id)
	{
		$this->db->where("id",$id);
		$query = $this->db->get(TABLE_CANDIDATE);
		return $result = $query->row_array();
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_CANDIDATE);
	   	return TRUE;
	}


}
?>