<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndustryModel extends CI_Model
{

    public function getIndustries() 
    {
    	
    	$this->db->select('id'); 
    	$this->db->select('industry_name'); 
    	$this->db->order_by('industry_name','asc'); 
		$query = $this->db->get(TABLE_INDUSTRIES);
		$data_industries=$query->result_array();
		return $data_industries;
    }

 
    function industry_list()
	{
		$this->db->order_by('industry_name','asc'); 
		$query = $this->db->get(TABLE_INDUSTRIES);
		$data_industry=$query->result_array();
		return $data_industry;
    }

    // adding industry data 
	public function add_new_industry($data)
	{	
		$this->db->insert(TABLE_INDUSTRIES,$data);
		return true;
		
	}

	public function edit_industry($data, $id)
	{
		$this->db->where('id', $id);
		$query=$this->db->update(TABLE_INDUSTRIES, $data);
		return true;
	}

	public function get_industry($id)
	{
		$this->db->where("id",$id);
		$query = $this->db->get(TABLE_INDUSTRIES);
		return $result = $query->row_array();
	}
	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_INDUSTRIES);
	   	return TRUE;
	}

}
?>