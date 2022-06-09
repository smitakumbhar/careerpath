<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
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
}
