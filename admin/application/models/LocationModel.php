<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LocationModel extends CI_Model
{

    public function getLocations() 
    {
    	
    	$this->db->select('id'); 
    	$this->db->select('location_name'); 
    	$this->db->order_by('location_name','asc'); 
		$query = $this->db->get(TABLE_LOCATION);
		$data_locations=$query->result_array();
		return $data_locations;
    }
    function location_list()
	{
		$this->db->order_by('location_name','asc'); 
		$query = $this->db->get(TABLE_LOCATION);
		$data_location=$query->result_array();
		return $data_location;
    }

    public function add_location($data)
	{	
		$this->db->insert(TABLE_LOCATION,$data);
		return true;
		
	}

	public function edit_location($data, $id)
	{ 
		$this->db->where('id', $id);
		$query=$this->db->update(TABLE_LOCATION, $data);
		return true;
	}

	public function get_location($id)
	{
		$this->db->where("id",$id);
		$query = $this->db->get(TABLE_LOCATION);
		return $result = $query->row_array();
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_LOCATION);
	   	return TRUE;
	}

}
?>