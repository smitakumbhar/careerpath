<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyModel extends CI_Model
{

    public function getCompanies() 
    {
    	
    	$this->db->select('id'); 
    	$this->db->select('company_name'); 
    	$this->db->order_by('company_name','asc'); 
		$query = $this->db->get(TABLE_COMPANY_DETAILS);
		$data_companies=$query->result_array();
		return $data_companies;
    }
    function company_list()
	{

		$this->db->order_by('company_name','asc'); 
		$query = $this->db->get(TABLE_COMPANY_DETAILS);
		$data_company=$query->result_array();
		return $data_company;
    }
    public function add_new_company($data)
	{	
		$this->db->insert(TABLE_COMPANY_DETAILS,$data);
		return true;
		
	}

	public function editCompany($data, $id)
	{
		$this->db->where('id', $id);
		$query=$this->db->update(TABLE_COMPANY_DETAILS, $data);
		return true;
	}

	public function get_company($id)
	{
		$this->db->where("id",$id);
		$query = $this->db->get(TABLE_COMPANY_DETAILS);
		return $result = $query->row_array();
	}

	public function getCompanyName($id)
	{
		$this->db->select("company_name");
		$this->db->where("id",$id);
		$query = $this->db->get(TABLE_COMPANY_DETAILS);
		return $result = $query->row_array();
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_COMPANY_DETAILS);
	   	return TRUE;
	}
}
?>