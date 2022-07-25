<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Rights extends CI_Controller
{
	public function __consrturt()
	{
		parent::__construct();
		if (session_id() == "") session_start();
	}

	public function add()
	{
		//echo "<pre>";print_r($_POST);die();
		//check admin is login
		$menu_rights = array();
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		if( $this->input->post("flag")=="as")
		{
			$this->form_validation->set_rules('user_name','Name','trim|required');
			$this->form_validation->set_rules('user_email','Email','trim|required|valid_email|is_unique[backend_users_master.user_email]'); 
			$this->form_validation->set_rules('user_type','User Type','trim|required');
			$this->form_validation->set_rules('user_phone_number','Phone Number','trim|required|numeric');
			$this->form_validation->set_rules('user_password','Password','trim|required|min_length[6]');
			$this->form_validation->set_rules('user_status','User Status','trim|required');
			$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

		
		$password = hash("sha256", $this->input->post("user_password"));

		$data = array(
				'user_name' => $this->input->post("user_name"),
				'user_email' => $this->input->post("user_email"),
				'user_type' => $this->input->post("user_type"),
				'user_phone_number' => $this->input->post("user_phone_number"),
				'user_password' => $password,
				'user_status' => $this->input->post("user_status"),
				'admin_approval' => 0,
				'user_addition_timestamp' => date("Y-m-d h:i:s"),
				);

		if ($this->form_validation->run() == TRUE)
		{
			// add data in user master table.
			$add_user = new UserModel();
			$result = $add_user->add_new_user($data);
			$adminId= $this->db->insert_id();
			// add data in rights table.
			$menu_rights=$this->input->post("menu_id");

			if(is_array($menu_rights))
			{
				foreach($menu_rights as $rights)
				{
					$add_rights = new RightsModel();
					$insert_data=array(
										"adminid"=>$adminId,
										"menu_id"=>$rights,
										"flag_show"=>1
										);
					$result = $add_rights->add($insert_data);
				}
			
			}
			// send mail to user after adding
			$template_list = new EmailModel();

			// send mail only for authorised users
			if($data["user_status"] == 1)
			{
				$mail_subject="Admin : Registration";

				$mail_body="<p> Hello  " .$data["user_name"]. ",</p><p>Below are your login details </p><br>". "<p>CareerPath Backend - Login ".base_url()."</p>".
					"<p>User Email : ".$data["user_email"]. "<br> User Password : ".$this->input->post("user_password")."</p><br><p> From Career Path. </p>";

				$email = $data["user_email"];
				$this->send_pulse->sendEmail_candidate($email,$mail_body,$mail_subject);

				// save status for first time login
				$data_status["admin_paasword_status"] = "N";
				$add_user->edit_user($data_status, $adminId);

			}

			redirect('user/index/0/add');
		}
		$menu_rights=$this->input->post("menu_id");
		$data["indexall"] =$this->input->post("indexall");	
		$data["addall"] =$this->input->post("addall");
		$data["editall"] =$this->input->post("editall");
		$data["deleteall"] =$this->input->post("deleteall");
		$data["menu_rights"] = $menu_rights;	
		$data["user_id"]=0;
		$data["action_page"]="add";
		$data["flag"]="as";
		$data["reset_pass"]="no";
			
		}
		else
		{
			$data = array(
					'user_name' => "",
					'user_email' => "",
					'user_type' => "",
					'user_phone_number' => "",
					'user_password' => "",
					'user_status' => "",
					'flag' => "as",
					'user_id' => 0,
					'action_page' => "add",
					'reset_pass' => "no",
					'indexall' => '',
					'addall' => '',
					'editall' => '',
					'deleteall' => '',

					);
		}
		$data["menu_rights"] = $menu_rights;
		$data['page_no'] = 0;
		$data['page_title'] = $this->lang->line("NEW_USER");
		$data['view_file'] = 'rights/add';
		$this->load->view('layout',$data);		
	}

	public function edit($id=NULL,$page_no=NULL)
	{
		//	echo $this->input->post("changepass");die();
				//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();
		$rightModel = new RightsModel();
		//echo "<pre>";print_r($_POST);die();
		$view_user= new UserModel();
		$data_user =  $view_user->get_user_by_id($id);
		if($this->input->post("flag")=="es")
		{
			
		$this->form_validation->set_rules('user_name','Name','trim|required');
		$this->form_validation->set_rules('user_email','Email','trim|required|valid_email'); 
		$this->form_validation->set_rules('user_type','User Type','trim|required');
		$this->form_validation->set_rules('user_phone_number','Phone Number','trim|required|numeric');
		$this->form_validation->set_rules('user_status','User Status','trim|required');

		if($this->input->post("user_email") != $data_user["user_email"])
		{
			$this->form_validation->set_rules('user_email','Email','is_unique[backend_users_master.user_email]'); 

		}
		if($this->input->post("changepass")== 1)
		{
			$this->form_validation->set_rules('user_password','Password','trim|required|min_length[6]');
		}
		$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

		if($this->input->post('user_password')!= "" && $this->input->post("changepass")== 1)
		{
			$password = hash("sha256", $this->input->post('user_password'));
		}
		else
		{
			$password = $data_user["user_password"];
		}
		$data = array(
				'user_name' => $this->input->post("user_name"),
				'user_email' => $this->input->post("user_email"),
				'user_type' => $this->input->post("user_type"),
				'user_phone_number' => $this->input->post("user_phone_number"),
				'user_password' => $password,
				'user_status' => $this->input->post("user_status"),
				'admin_approval' => 0,
				'user_addition_timestamp' => date("Y-m-d h:i:s"),
				);
			

			if ($this->form_validation->run() == TRUE)
			{
				$result = $view_user->edit_user($data, $id);
				$menu_rights=$this->input->post("menu_id");
				//delete previous rights
				 $rightModel->deleteRights($id);

				if(is_array($menu_rights))
				{
					foreach($menu_rights as $rights)
					{
						
						$insert_data=array(
											"adminid"=>$id,
											"menu_id"=>$rights,
											"flag_show"=>1
											);
						$result = $rightModel->add($insert_data);
					}
				
				}
				// send mail to user after adding
				$template_list = new EmailModel();

				// send mail only for authorised users
				if($data["user_status"] == 1 && $this->input->post("changepass")== 1)
				{
					$mail_subject="Admin : Password Reset";
					$mail_body="<p> Hello  " .$data["user_name"]. ",</p><p>Below are your login details </p><br>"."<p>CareerPath Backend - Login ".base_url()."</p>".
					"<p>User Email : ".$data["user_email"]. "<br> User Password : ".$this->input->post("user_password")."</p><br><p> From Career Path. </p>";

					$email = $data["user_email"];
					$this->send_pulse->sendEmail_candidate($email,$mail_body,$mail_subject);
				}
				redirect('user/index/0/edit');
			}
		//	echo "<pre>";print_r($_POST);die();
			$data =  $view_user->get_user_by_id($id);
			$data["action_page"]="edit";
			$data["flag"]="es";
			$data["user_id"]=$id;
			$data["changepass"]=$this->input->post("changepass");
			$data["indexall"] =$this->input->post("indexall");	
			$data["addall"] =$this->input->post("addall");
			$data["editall"] =$this->input->post("editall");
			$data["deleteall"] =$this->input->post("deleteall");


		}
		else
		{
			//echo "<pre>";print_r($_POST);die();
			$data =  $view_user->get_user_by_id($id);
			
			if($data)
			{	
				$data["user_id"]=$id;
				$data["changepass"]=$this->input->post("changepass");
				$data["flag"] = "es";
				$data["action_page"] = "edit";
				$data["indexall"] =$this->input->post("indexall");	
				$data["addall"] =$this->input->post("addall");
				$data["editall"] =$this->input->post("editall");
				$data["deleteall"] =$this->input->post("deleteall");

			}
			else
			{
				redirect('user/index/');
			}
		}

		$menu_rights=$rightModel->getRights($id);
		$data["menu_rights"] = $menu_rights;
		$data["user_id"]=$id;
		$data['page_no'] = $page_no;
		$data['page_title'] = $this->lang->line("EDIT_USER");
		$data['view_file'] = 'rights/add';
		$this->load->view('layout',$data);

	}

}



?>
