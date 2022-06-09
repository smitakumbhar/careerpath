<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model
{
	public function signin($data)
	{

		$this->db->where("user_email",$data["user_email"]);
		$this->db->where("user_password",$data["user_password"]);
		$query = $this->db->get(TABLE_BACKEND_USER_MASTER);
		foreach ($query->result_array() as $row)
		{
			$this->session->set_userdata('sess_admin_login',"y");
			$this->session->set_userdata('user_id',$row["user_id"]);
			$this->session->set_userdata('user_name',$row["user_name"]);
			$this->session->set_userdata('user_type',$row["user_type"]);
			$this->session->set_userdata('admin_approval',$row["admin_approval"]);
			return TRUE;
		}
		return FALSE;
	}

	//check client signup
	public function checkAdminLogin()
	{
		if($this->session->userdata('sess_admin_login')!="y")
		{
			redirect("login/loginpage");
			exit;
		}
	}

}


?>