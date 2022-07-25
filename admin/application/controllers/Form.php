<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller
{
	public function __consrturt()
	{
		parent::__construct();
		if(session_id() == "") session_start();
	}

	public function formdownloads()
	{
			//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$data['page_title'] = $this->lang->line("DOWNLOAD_FORMS");
		$data['view_file'] = 'formdownloads/formdownloads';
		$this->load->view('layout',$data);
		
	}
}