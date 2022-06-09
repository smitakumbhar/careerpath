<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __consrturt()
	{
		parent::__construct();
		$this->form_validation->set_error_delimiters('<div id="valid_error">', '</div>');
		if(session_id() == "") session_start();
	}

	
	public function index($err=NULL)
	{
		$data["user_email"]="";
		$data["user_password"]="";
		$data["err"]="";
		$login_failed="";
		
		if($err==1)
		{
		  $login_failed = $this->lang->line("LOGIN_FAILED");
		}
		
		if($this->input->post("flag")=="login")
		{
			$user_email = $this->input->post("user_email");
			$user_password = $this->input->post("user_password");

			$user_password = hash("sha256", $user_password);

			$data = array(
					'user_email' => $user_email,
					'user_password' => $user_password,
					);
		$this->form_validation->set_rules('user_email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('user_password','Password','trim|required');
		$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

			if ($this->form_validation->run() == TRUE)
			{
					$register_user = new LoginModel();

					if( $register_user->signin($data))
					{
						redirect(base_url('home/index')); 
					}
					else
					$login_failed=$this->lang->line("LOGIN_FAILED");
			}
		}

		$data["login_failed"]=$login_failed;
		$data['page_title'] = $this->lang->line("CP_LOGIN");
		$data['view_file'] = 'login/loginpage';
		$this->load->view('login_layout',$data);
	}

	public function getSingleUser()
	 {
	 	//echo "hiii".$_POST["user_id"];die();
	    $this->db->select('*');
		$this->db->where('user_id',$_POST["user_id"]);
		$this->db->from('backend_users_master');
		//$this->db->limit(1);
		$query = $this->db->get();

        if($query->num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}//get user
	public function logout()
	{
		$this->session->set_userdata('sess_admin_login',"");
		$this->session->set_userdata('user_id',"");
		$this->session->set_userdata('user_name',"");
		$this->session->set_userdata('user_type',"");
		$this->session->set_userdata('admin_approval',"");
		$this->session->sess_destroy();
		redirect(base_url('login/index'));

	}// end of logout

}