<?php 
defined('BASEPATH') or exit('No direct script access allowed');


class RightsModel extends CI_Model
{
	// adding user data 
	public function add($data)
	{	
		$this->db->insert(TABLE_RIGHTS,$data);
		return true;
		
	}

	function checkAdminRights($rightsid=NULL)
	{
		//echo "<pre>";print_r($_SESSION);
		if(@$_SESSION["user_type"]=="Super Admin")
		{
			$admin_rights=array_keys($this->lang->line("ADMIN_MENU"));
		}
		else
		{
			$admin_rights=$this->getRights(@$_SESSION["user_id"]);;
		}
		if(!is_null($rightsid))
		{	
			if(in_array($rightsid,$admin_rights)===FALSE)
			{
				redirect("home/index");
				exit;
			}
		}
		return $admin_rights;
	}


	function getRights($adminid)
	{
		$this->db->where("flag_show",1);
		$this->db->where("adminid",$adminid);
		$query = $this->db->get(TABLE_RIGHTS);
		$rec_adm=$query->result_array();
		$rights_arr=array();
		foreach($rec_adm as $rec)
		{
			$rights_arr[]=$rec["menu_id"];
		}
		return $rights_arr;
	}

	function deleteRights($adminid)
	{
		$this->db->where('adminid', $adminid);
		$this->db->delete(TABLE_RIGHTS);
		return true;
	}
}

?>