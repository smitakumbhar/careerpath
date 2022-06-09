<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller
{
	public function __consrturt()
	{
		parent::__construct();
	}
	
	public function index($msg=NULL)
	{

		$msg_display="";
		$msg_display1="";
		$msg_err_display="";
		if($this->uri->segment(4)!="")
		{
			@$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			if($this->uri->segment(4)=="d")
				$msg_display=$this->lang->line("CANDIDATE_DELETE_MSG");
			if($this->uri->segment(4)=="add")
				$msg_display=$this->lang->line("CANDIDATE_ADD_MSG");
			if($this->uri->segment(4)=="edit")
				$msg_display=$this->lang->line("CANDIDATE_EDIT_MSG");
		}
		
		if($msg == "nosearch"){
			$this->session->set_userdata('sess_keyword','');
			$this->session->set_userdata('sess_search_wh','');
			$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
		}
		
		$where="";
		if( $this->input->post("flag")=="search")
		{
			if($this->input->post("txtkeyword")!="")
			{
				$where='email LIKE "%'.trim(addslashes($this->input->post("txtkeyword"))).'%"';
				$this->session->set_userdata('sess_keyword',$this->input->post("txtkeyword"));
			}
			else
				$this->session->set_userdata('sess_keyword','');
				
			$this->session->set_userdata('sess_search_wh',$where);
			
		}
		
		if($this->session->userdata('sess_search_wh')!="")
			$where=" WHERE ".$this->session->userdata('sess_search_wh');
		
		$sql="SELECT * FROM ".TABLE_CANDIDATE."  ".$where	;
		$query = $this->db->query($sql);
		$total_count = $query->num_rows();
		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");
		

		$segments = array('candidate', 'index');
		$url_name=site_url($segments);
		$per_page_records=((@$_SESSION["sess_paging"]=="All")?$total_count:@$_SESSION["sess_paging"]);
		$comm_model = new Commfuncmodel();
		$pagination=$comm_model->pagination($total_count,$this->uri->segment(3),$per_page_records,$url_name);
		/*******************End Pagination*******************/
		$page_no=(int)$this->uri->segment(3);
		if( empty($page_no) || ( $page_no<1 ) )
			$nextrecord = 0 ;
		else
			$nextrecord = ($page_no-1) * @$_SESSION["sess_paging"] ;
			if(@$_SESSION["sess_paging"]!="All")
			{
				$limit_start=$nextrecord;
				$limit_end=$_SESSION["sess_paging"];
			}
		((@$_SESSION["sess_paging"]==PER_PAGE_RECORDS)?PER_PAGE_RECORDS:@$_SESSION["sess_paging"]);	



		if($this->session->userdata('sess_search_wh')!="")
			$this->db->where($this->session->userdata('sess_search_wh'),'');
		
		$this->db->limit(@$limit_end,@$limit_start);
		$this->db->order_by('first_name','asc'); 
		$query = $this->db->get(TABLE_CANDIDATE);
		
		$data_candidate=$query->result_array();
		$data['candidate_data'] = $data_candidate;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");
		$data['msg_display'] = $msg_display;
		$data['msg_display1'] = $msg_display1;
		$data['msg_err_display'] =$msg_err_display;
		$data['keyword'] = $this->session->userdata('sess_keyword');
		$data['page_title'] = $this->lang->line("CANDIDATE_LIST");
		$data['view_file'] = 'candidate/index';
		$this->load->view('layout',$data);
	
	}

	public function add()
	{
		
		if( $this->input->post("flag")=="as")
		{
			$data = array(
					'first_name' => $this->input->post("first_name"),
					'last_name' => $this->input->post("last_name"),
					'email' => $this->input->post("email"),
					'mobile' => $this->input->post("mobile"),
					
					);
			
			$this->form_validation->set_rules('first_name',$this->lang->line("FIRST_NAME"),'required');
			$this->form_validation->set_rules('last_name',$this->lang->line("LAST_NAME"),'required');
			$this->form_validation->set_rules('email',$this->lang->line("EMAIL_ID"),'required|valid_email');
			$this->form_validation->set_rules('mobile',$this->lang->line("MOBILE_NO"),'required');
			$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

			if ($this->form_validation->run() == TRUE)
			{
				
				$candidate_model = new CandidateModel();
				$result =  $candidate_model->add_candidate($data);
				redirect('candidate/index/0/add');
			}	
			$data["id"]=0;
			$data["action_page"]="add";
			$data["flag"]="as";
			
		}
		else
		{
			$data = array(
					'first_name' => "",
					'last_name' => "",
					'email' => "",
					'mobile' => "",
					'flag' => "as",
					'id' => 0,
					'action_page' => "add",
					);
		}
		
		$data['page_no'] = 0;
		$data['page_title'] = $this->lang->line("ADD_CANDIDATE");
		$data['view_file'] = 'candidate/add';
		$this->load->view('layout',$data);

	
	}

	function delete($id=NULL,$page_no=NULL)
	{
		if($id)
		{
				if( empty($page_no) || ( $page_no<1 ) )
					$nextrecord = 0 ;
				else
					$nextrecord = ($page_no-1) * @$_SESSION["sess_paging"] ;
				$candidate = new CandidateModel();
				$candidate->delete($id);

				//when we deleting records on second page, once we delete last entry on second page it should shift to 1st after deleting.
				if(@$_SESSION["sess_search_wh"]!="")
					$this->db->where(@$_SESSION["sess_search_wh"],'');
				$this->db->order_by('email','asc'); 
				$this->db->limit(PER_PAGE_RECORDS,$nextrecord);
				$query = $this->db->get(TABLE_CANDIDATE);
				$data_cat=$query->result_array();
				if(empty($data_cat))
				{
					$page_no--;
				}
				if($page_no<0)
					$page_no=0;
				redirect('candidate/index/'.(int)$page_no."/d");
		}		
	}

	public function edit($id=NULL,$page_no=NULL)
	{
		$candidate_model = new CandidateModel();
		if( $this->input->post("flag")=="es")
		{
			$data = array(
					'first_name' => $this->input->post("first_name"),
					'last_name' => $this->input->post("last_name"),
					'email' => $this->input->post("email"),
					'mobile' => $this->input->post("mobile"),
					
					);
			
		$this->form_validation->set_rules('first_name',$this->lang->line("FIRST_NAME"),'required');
		$this->form_validation->set_rules('last_name',$this->lang->line("LAST_NAME"),'required');
		$this->form_validation->set_rules('email',$this->lang->line("EMAIL"),'required|valid_email');
		$this->form_validation->set_rules('mobile',$this->lang->line("MOBILE_NO"),'required');
		$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

		if ($this->form_validation->run() == TRUE)
		{
			$candidate_model->edit_candidate($data, $id);
			redirect('candidate/index/0/edit');
		}
			$data["action_page"]="edit";
			$data["flag"]="es";
			$data["id"]=$this->input->post("id");
		}
		else
		{
			$data=$candidate_model->get_candidate($id);
			
			if($data)
			{	
				$data["id"]=$id;
				$data["flag"] = "es";
				$data["action_page"] = "edit";
			}
			else
			{
				redirect('candidate/index/');
			}
		}
		$data["id"]=$id;
		$data['page_no'] = $page_no;
		$data['page_title'] = $this->lang->line("EDIT_CANDIDATE");
		$data['view_file'] = 'candidate/add';
		$this->load->view('layout',$data);

	}

	public function sendmail()
	{
		//echo $email =$this->input->post("email");die();
		$template_list = new EmailModel();

		if( $this->input->post("flag")=="as")
		{
			$data = array(
					'template_name' => $this->input->post("template_name"),
					'candidate' => $this->input->post("candidate"),
					'template_detail' => $this->input->post("template_detail"),
					'subject' => $this->input->post("subject"),
					);
			
			$this->form_validation->set_rules('template_name',$this->lang->line("TEMPLATE_NAME"),'required');
			$this->form_validation->set_rules('subject',$this->lang->line("SUBJECT"),'required');
			$this->form_validation->set_rules('template_detail',$this->lang->line("TEMPLATE_DETAIL"),'required');
			$this->form_validation->set_rules('candidate',$this->lang->line("CANDIADTE_NAME"),'required');

			$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

			if ($this->form_validation->run() == TRUE)
			{

				$mail_subject=$this->input->post("subject");
				$mail_body=$this->input->post("template_detail");
				
				$candidate_model = new CandidateModel();
				$id =$this->input->post("candidate");//die();	
				$candidate_data = $candidate_model->get_candidate($id);
				$email = $candidate_data["email"];
				$this->send_pulse->sendEmail_candidate($email,$mail_body,$mail_subject);
				redirect('candidate/index/nosearch');
			
			}	// validation
			$data["action_page"]="sendmail";
			$data["flag"]="as";
			
		}
		else
		{
			$data = array(
					'template_name' => "",
					'template_detail' => "",
					'subject' => "",
					'email' => "",
					'flag' => "as",
					'action_page' => "sendmail",					
					);
		}
		$candidate_model = new CandidateModel();
		$data["candidate_list"] = $candidate_model->getCandidate();
		$data["template_list"] = $template_list->getTemplates();
		$data['page_title'] = $this->lang->line("SEND_EMAIL");
		$data['view_file'] = 'candidate/send_mail';
		//echo "<pre>";print_r($data);
		$this->load->view('layout',$data);

	}

	public function get_candidate()
	{
		$id = $this->input->post("id");
		if($id)
		{ 
			$candidate_model = new CandidateModel();
			$candidate_data = $candidate_model->get_candidate($id);
			 echo json_encode($candidate_data);
		
		}	
	}

	function change_paging($paging=NULL)
	{

		$_SESSION["sess_paging"]=$paging;
	    redirect("candidate/index");
	}

	// option number 7 from CRM
	public function view_candidates($msg=NULL)
	{

		$msg_display="";
		$msg_display1="";
		$msg_err_display="";
		
		if($msg == "nosearch"){
			$this->session->set_userdata('sess_keyword','');
			$this->session->set_userdata('sess_search_wh','');
			$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
		}
		
		$where="";
		if( $this->input->post("flag")=="search")
		{
			if($this->input->post("txtkeyword")!="")
			{
				$where='email LIKE "%'.trim(addslashes($this->input->post("txtkeyword"))).'%"';
				$this->session->set_userdata('sess_keyword',$this->input->post("txtkeyword"));
			}
			else
				$this->session->set_userdata('sess_keyword','');
				
			$this->session->set_userdata('sess_search_wh',$where);
			
		}
		
		if($this->session->userdata('sess_search_wh')!="")
			$where=" WHERE ".$this->session->userdata('sess_search_wh');
		
		$sql="SELECT * FROM ".TABLE_CANDIDATE."  ".$where	;
		$query = $this->db->query($sql);
		$total_count = $query->num_rows();
		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");
		

		$segments = array('candidate', 'view_candidates');
		$url_name=site_url($segments);
		$per_page_records=((@$_SESSION["sess_paging"]=="All")?$total_count:@$_SESSION["sess_paging"]);
		$comm_model = new Commfuncmodel();
		$pagination=$comm_model->pagination($total_count,$this->uri->segment(3),$per_page_records,$url_name);
		/*******************End Pagination*******************/
		$page_no=(int)$this->uri->segment(3);
		if( empty($page_no) || ( $page_no<1 ) )
			$nextrecord = 0 ;
		else
			$nextrecord = ($page_no-1) * @$_SESSION["sess_paging"] ;
			if(@$_SESSION["sess_paging"]!="All")
			{
				$limit_start=$nextrecord;
				$limit_end=$_SESSION["sess_paging"];
			}
		((@$_SESSION["sess_paging"]==PER_PAGE_RECORDS)?PER_PAGE_RECORDS:@$_SESSION["sess_paging"]);	



		if($this->session->userdata('sess_search_wh')!="")
			$this->db->where($this->session->userdata('sess_search_wh'),'');
		
		$this->db->limit(@$limit_end,@$limit_start);
		$this->db->order_by('first_name','asc'); 
		$query = $this->db->get(TABLE_CANDIDATE);
		
		$data_candidate=$query->result_array();
		$data['candidate_data'] = $data_candidate;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");
		$data['msg_display'] = $msg_display;
		$data['msg_display1'] = $msg_display1;
		$data['msg_err_display'] =$msg_err_display;
		$data['keyword'] = $this->session->userdata('sess_keyword');
		$data['page_title'] = $this->lang->line("CANDIDATE_LIST");
		$data['view_file'] = 'candidate/candidate_list';
		$this->load->view('layout',$data);

	}


	// send bulk mail to candidates
	public function send_bulkmail()
	{
		$template_list = new EmailModel();

		if( $this->input->post("flag")=="as")
		{
			$data = array(
					'template_name' => $this->input->post("template_name"),
					'template_detail' => $this->input->post("template_detail"),
					'subject' => $this->input->post("subject"),
					);
			
			$this->form_validation->set_rules('template_name',$this->lang->line("TEMPLATE_NAME"),'required');
			$this->form_validation->set_rules('subject',$this->lang->line("SUBJECT"),'required');
			$this->form_validation->set_rules('template_detail',$this->lang->line("TEMPLATE_DETAIL"),'required');

			$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

			if ($this->form_validation->run() == TRUE)
			{
				if(is_array($_SESSION['sess_candidate_array']))
				 {

				 	$mail_subject=$this->input->post("subject");
					$mail_body=$this->input->post("template_detail");

					foreach($_SESSION['sess_candidate_array'] as $email_id)
					{
						$email= $email_id;
						$this->send_pulse->sendEmail_candidate($email_id,$mail_body,$mail_subject);			

					}// end of foreach
					redirect('candidate/view_candidates/nosearch');
				}//end of if	
			
			}	// validation
			$data["action_page"]="send_bulkmail";
			$data["flag"]="as";
			
		}
		else
		{
			$data = array(
					'template_name' => "",
					'template_detail' => "",
					'subject' => "",
					'flag' => "as",
					'action_page' => "send_bulkmail",					
					);
		}
		

		$candidate_array = Array();
	//echo "<pre>";print_r($_POST);die();
		if(isset($_POST['resumes_select'])) 
		{
			if(!empty($_POST['selectedCandidate']))
			{
				// Loop to store and display values of individual checked checkbox.
				foreach($_POST['selectedCandidate'] as $candidateEmail)
				{

				    array_push($candidate_array, "$candidateEmail");
				}
			}
			$this->session->set_userdata('sess_candidate_array',$candidate_array);
 		}
 		
		$data["template_list"] = $template_list->getTemplates();
		$data['page_title'] = $this->lang->line("SEND_EMAIL");
		$data['view_file'] = 'candidate/send_bulkmail';
		//echo "<pre>";print_r($data);
		$this->load->view('layout',$data);
 		
	}
// paging for mail
	function change_paging_mail($paging=NULL)
	{

		$_SESSION["sess_paging"]=$paging;
	    redirect("candidate/view_candidates");
	}
}