<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	
	public function __consrturt()
	{
		parent::__construct();
		if(session_id() == "") session_start();
	}

	public function index()
	{
		//echo "<pre>";print_r($_SESSION);die();
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

			//count for all
		$user = new UserModel;
	    $users = $user->getUsers();
		$user_count = count($users);

	    $joblist = new JobModel;
	    $jobs = $joblist->get_jobID_list();
	 	$job_count = count($jobs);

	    $companylist = new CompanyModel;
	    $companies = $companylist->getCompanies();
		$company_count = count($companies);

	    $list = new ResumeModel;
	    $resumes = $list->resume_list();
		$resume_count = count($resumes);

	    $data["users_count"]= $user_count;
	    $data["job_count"]= $job_count;
	    $data["company_count"]= $company_count;
	    $data["resumes_count"]= $resume_count;

	    $data["resumes_data"]= $resumes;
	    $data["companies_data"]= $companies;
	    $data["job_data"]= $jobs;

	    $data['page_title'] = $this->lang->line("HOME");
		$data['view_file'] = 'login/home';
		$this->load->view('layout',$data);
	
	}

	public function homepage()
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();
		$data['page_title'] = $this->lang->line("HOME_PAGE");
		$data['view_file'] = 'login/homepage';
		$this->load->view('layout',$data);
	}

	public function change_password()
	{
		$data["user_password"]="";
		$data["user_rpassword"]="";
		
		
		if($this->input->post("flag")=="changepass")
		{
			$user_password = $this->input->post("user_password");
			$user_rpassword = $this->input->post("user_rpassword");
			$user_password = hash("sha256", $user_password);

			$this->form_validation->set_rules('user_password','Password','trim|required');
			$this->form_validation->set_rules('user_rpassword','Reenter Password','trim|required|matches[user_password]');

			$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

			if ($this->form_validation->run() == TRUE)
			{
				$loginModel = new LoginModel();
				// fetch data using user email
				$admin_data = $loginModel->get_admin($_SESSION['user_id']);
				//update database
				$data_change = array(
									'admin_paasword_status' => 'Y',
									'user_password' => $user_password,
									);
				$loginModel->update($data_change,$admin_data["user_id"]);

				// send mail to user after password change
			$template_list = new EmailModel();

			// send mail only for authorised users
			if($admin_data["user_status"] == 1)
			{
				$mail_subject="Admin : Password Changed";

				$mail_body="<p> Hello  " .$admin_data["user_name"]. ",</p><p>Your Password has been changed.</p><br>"."<p>CareerPath Backend - Login ".base_url()."</p>".
					"<p>User Email : ".$admin_data["user_email"]. "<br> User Password : ".$this->input->post("user_password")."</p><br><p> From Career Path. </p>";

				$email = $admin_data["user_email"];
				$this->send_pulse->sendEmail_candidate($email,$mail_body,$mail_subject);
			}

			$_SESSION['admin_paasword_status']='';
			redirect(base_url('home/index'));
			}
		}

		$data['page_title'] = $this->lang->line("CP_LOGIN_PASS");
		$data['view_file'] = 'login/changePassoword';
		$this->load->view('login_layout',$data);
	}
}
