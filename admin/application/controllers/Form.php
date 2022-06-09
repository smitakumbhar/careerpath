<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller
{
	public function __consrturt()
	{
		parent::__construct();
	}

	public function formdownloads()
	{
		$data['page_title'] = $this->lang->line("DOWNLOAD_FORMS");
		$data['view_file'] = 'formdownloads/formdownloads';
		$this->load->view('layout',$data);
		
	}
}