<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailModel extends CI_Model
{

    public function getTemplates() 
    {
    	
    	$this->db->select('id'); 
    	$this->db->select('template_name'); 
    	$this->db->order_by('template_name','asc'); 
		$query = $this->db->get(TABLE_EMAIL_TEMPLATE);
		$data_template=$query->result_array();
		return $data_template;
    }

    function template_list()
	{
		$this->db->order_by('template_name','asc'); 
		$query = $this->db->get(TABLE_EMAIL_TEMPLATE);
		$data_template=$query->result_array();
		return $data_template;
    }

    // adding industry data 
	public function add_new_template($data)
	{	
		$this->db->insert(TABLE_EMAIL_TEMPLATE,$data);
		return true;
		
	}

	public function edit_template($data, $id)
	{
		$this->db->where('id', $id);
		$query=$this->db->update(TABLE_EMAIL_TEMPLATE, $data);
		return true;
	}

	public function get_template($id)
	{
		
		$this->db->where("id",$id);
		$query = $this->db->get(TABLE_EMAIL_TEMPLATE);
		return $result = $query->row_array();
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_EMAIL_TEMPLATE);
	   	return TRUE;
	}

	public function downloadZipServer($array=NULL,$filepath=NULL)
	{
		foreach($array as $key => $value)
		{
			$this->zip->read_file($value);

		}
	   // Save the zip file to archivefiles directory
        $this->zip->archive($filepath);
		$_SESSION['sess_resume_array'] ="";

	}
}
?>