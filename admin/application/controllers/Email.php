<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller
{
	public function __consrturt()
	{
		parent::__construct();
		if (session_id() == "") session_start();
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
				$msg_display=$this->lang->line("TEMPLATE_DELETE_MSG");
			if($this->uri->segment(4)=="add")
				$msg_display=$this->lang->line("TEMPLATE_ADD_MSG");
			if($this->uri->segment(4)=="edit")
				$msg_display=$this->lang->line("TEMPLATE_EDIT_MSG");
		}
		
		if($msg == "nosearch"){
			$this->session->set_userdata('sess_search_wh','');
			$this->session->set_userdata('sess_keyword','');
			$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
		}
		
		$where="";
		if( $this->input->post("flag")=="search")
		{
			if($this->input->post("txtkeyword")!="")
			{
				$where='template_name LIKE "%'.trim(addslashes($this->input->post("txtkeyword"))).'%"';
				$this->session->set_userdata('sess_keyword',$this->input->post("txtkeyword"));
			}
			else
				$this->session->set_userdata('sess_keyword','');
				
			$this->session->set_userdata('sess_search_wh',$where);
			
		}
		
		if($this->session->userdata('sess_search_wh')!="")
			$where=" WHERE ".$this->session->userdata('sess_search_wh');
		
		$sql="SELECT * FROM ".TABLE_EMAIL_TEMPLATE."  ".$where	;
		$query = $this->db->query($sql);
		$total_count=$query->num_rows();
		
		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");
		$segments = array('email', 'index');
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
		$this->db->order_by('template_name','asc'); 
		
		$query = $this->db->get(TABLE_EMAIL_TEMPLATE);
		
		$data_template=$query->result_array();
		$data['template_data'] = $data_template;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");

		$data['msg_display'] = $msg_display;
		$data['msg_display1'] = $msg_display1;
		$data['msg_err_display'] =$msg_err_display;
		$data['keyword'] = $this->session->userdata('sess_keyword');
		$data['page_title'] = $this->lang->line("EMAIL_TEMPLATE_LIST");
		$data['view_file'] = 'email/index';
		$this->load->view('layout',$data);
	
	}


	public function add()
	{
		
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
				$email_model = new EmailModel();
				$result = $email_model->add_new_template($data);
				redirect('email/index/0/add');
			}	
			$data["template_id"]=0;
			$data["action_page"]="add";
			$data["flag"]="as";
			
		}
		else
		{
			$data = array(
					'template_name' => "",
					'template_detail' => "",
					'subject' => "",
					'flag' => "as",
					'template_id' => 0,
					'action_page' => "add",
					);
		}
		
		$data['page_no'] = 0;
		$data['page_title'] = $this->lang->line("NEW_TEMPLATE");
		$data['view_file'] = 'email/add';
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
				$email = new EmailModel();
				$email->delete($id);

				//when we deleting records on second page, once we delete last entry on second page it should shift to 1st after deleting.
				if(@$_SESSION["sess_search_wh"]!="")
					$this->db->where(@$_SESSION["sess_search_wh"],'');
				$this->db->order_by('template_name','asc'); 
				$this->db->limit(PER_PAGE_RECORDS,$nextrecord);
				$query = $this->db->get(TABLE_EMAIL_TEMPLATE);
				$data_cat=$query->result_array();
				if(empty($data_cat))
				{
					$page_no--;
				}
				if($page_no<0)
					$page_no=0;
				redirect('email/index/'.(int)$page_no."/d");
		}		
	}

	
	public function edit($id=NULL,$page_no=NULL)
	{
		$email_model = new EmailModel();
		if( $this->input->post("flag")=="es")
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
				$email_model->edit_template($data,$id);
				redirect('email/index/0/edit');
			}
			$data["action_page"]="edit";
			$data["flag"]="es";
			$data["template_id"]=$this->input->post("template_id");
		}
		else
		{
			$data=$email_model->get_template($id);
			
			if($data)
			{	

				$data["flag"] = "es";
				$data["action_page"] = "edit";
			}
			else
			{
				redirect('email/index/');
			}
		}
		$data["template_id"]=$id;
		$data['page_no'] = $page_no;
		$data['page_title'] = $this->lang->line("EDIT_EMAIL_TEMPLATE");
		$data['view_file'] = 'email/add';
		$this->load->view('layout',$data);

	}

	// function for send mail
	public function resume_list($msg=NULL)
	{

		$msg_display="";
		$msg_display1="";
		$msg_err_display="";
		
		if($this->uri->segment(4)!="")
		{
			if($this->uri->segment(4)=="mailsent")
				$msg_display=$this->lang->line("MAIL_SENT_SUCCESS");
		}
		
		if($msg=="nosearch")
		{

			$this->session->set_userdata('sess_search_wh4','');
			$this->session->set_userdata('sess_search_wh3','');
			$this->session->set_userdata('sess_search_wh2','');
			$this->session->set_userdata('sess_search_wh1','');
			$this->session->set_userdata('sess_search_wh','');
			$this->session->set_userdata('sess_keyword','');
			$this->session->set_userdata('sess_name','');
			$this->session->set_userdata('sess_fromdate','');
			$this->session->set_userdata('sess_todate','');
			$this->session->set_userdata('sess_date','');
			@$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			
		}
		
		$where="";
		$where1="";
		$where2="";
		$where3="";
		$where4="";
		if( $this->input->post("flag")=="search")
		{
			if($this->input->post("txtkeyword")!="")
			{
				$where='keywords LIKE "%'.trim(addslashes($this->input->post("txtkeyword"))).'%"';
				$this->session->set_userdata('sess_keyword',$this->input->post("txtkeyword"));
			}
			else
				$this->session->set_userdata('sess_keyword','');

			if($this->input->post("firstname")!="")
			{
				$where1='firstname LIKE "%'.trim(addslashes($this->input->post("firstname"))).'%"';
				$this->session->set_userdata('sess_name',$this->input->post("firstname"));
			}
			else
				$this->session->set_userdata('sess_name','');
			//for date 
			
			if($this->input->post("fromdate")!="" && $this->input->post("todate")=="")
			{
				$fdate= date("Y-m-d", strtotime($this->input->post("fromdate"))); 
				$where2 = 'create_date >= "'.$fdate.'"';
				$this->session->set_userdata('sess_fromdate',$fdate);
			}
			else
				$this->session->set_userdata('sess_fromdate','');

			if($this->input->post("todate")!="" && $this->input->post("fromdate")=="")
			{
				$tdate= date("Y-m-d", strtotime($this->input->post("todate"))); 
				$where3 = 'create_date <= "'.$tdate.'"';
				$this->session->set_userdata('sess_todate',$tdate);
			}
			else
				$this->session->set_userdata('sess_todate','');

			if($this->input->post("fromdate")!="" && $this->input->post("todate")!="")
			{
				$fdate= date("Y-m-d", strtotime($this->input->post("fromdate"))); 
				$tdate= date("Y-m-d", strtotime($this->input->post("todate"))); 
				if($tdate >= $fdate)
				{
					
					$where4 = 'create_date >= "'.$fdate.'" AND create_date <= "'.$tdate.'"';
					$this->session->set_userdata('sess_fromdate',$fdate);
					$this->session->set_userdata('sess_todate',$tdate);
				}
				else
				{
					$this->session->set_userdata('sess_fromdate',$fdate);
					$this->session->set_userdata('sess_todate',$tdate);
					$msg_display= $this->lang->line("DATE_VALIDATION");
				}
			}

			$this->session->set_userdata('sess_search_wh',$where);
			$this->session->set_userdata('sess_search_wh1',$where1);
			$this->session->set_userdata('sess_search_wh2',$where2);
			$this->session->set_userdata('sess_search_wh3',$where3);
			$this->session->set_userdata('sess_search_wh4',$where4);
			
		}
		
		if($this->session->userdata('sess_search_wh')!="")
			$where=" AND ".$this->session->userdata('sess_search_wh');


		if($this->session->userdata('sess_search_wh1')!="")
			$where1=" AND ".$this->session->userdata('sess_search_wh1');

		if($this->session->userdata('sess_search_wh2')!="")
			$where2=" AND ".$this->session->userdata('sess_search_wh2');
		if($this->session->userdata('sess_search_wh3')!="")
			$where3=" AND ".$this->session->userdata('sess_search_wh3');
		if($this->session->userdata('sess_search_wh4')!="")
			$where4=" AND ".$this->session->userdata('sess_search_wh4');


		$main_sql="SELECT * FROM ".TABLE_RESUME_DETAILS." WHERE id IS NOT NULL ";

		$sql=$main_sql.$where.$where1.$where2.$where3.$where4;
 		$query = $this->db->query($sql);
 		$total_count=$query->num_rows();
 	//	echo "hiii".$query->num_rows();

		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");
		$segments = array('resume', 'index');
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
				$limit=" LIMIT ".@$limit_start.",".@$limit_end;
			}
		((@$_SESSION["sess_paging"]==PER_PAGE_RECORDS)?PER_PAGE_RECORDS:@$_SESSION["sess_paging"]);	

	

		$order_by=' ORDER BY id asc '; 
		
		$sql=$main_sql.$where.$where1.$where2.$where3.$where4.$order_by.$limit;//die();
		$query = $this->db->query($sql);

		$data_resume=$query->result_array();
		$data['resume_data'] = $data_resume;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");
		$data['msg_display'] = $msg_display;
		$data['msg_display1'] = $msg_display1;
		$data['msg_err_display'] =$msg_err_display;
		$data['keyword'] = $this->session->userdata('sess_keyword');
		$data['page_title'] = $this->lang->line("RESUMES_LIST");
		$data['view_file'] = 'sendmail/resume_list';
		$this->load->view('layout',$data);


	}//end of resume_list

	public function sendmail()
	{
		$template_list = new EmailModel();
		$job_order_list = new JobModel();

		if( $this->input->post("flag")=="as")
		{
			$data = array(
					'template_name' => $this->input->post("template_name"),
					'job_type' => $this->input->post("job_type"),
					'template_detail' => $this->input->post("template_detail"),
					'subject' => $this->input->post("subject"),
					);
			
			$this->form_validation->set_rules('template_name',$this->lang->line("TEMPLATE_NAME"),'required');
			$this->form_validation->set_rules('subject',$this->lang->line("SUBJECT"),'required');
			$this->form_validation->set_rules('template_detail',$this->lang->line("TEMPLATE_DETAIL"),'required');
			$this->form_validation->set_rules('job_type',$this->lang->line("JOB_TYPE"),'required');

			$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

			if ($this->form_validation->run() == TRUE)
			{
				// code for send mail and zip creation

				 $job_order_data = $job_order_list->view_job($this->input->post("job_type"));
			

				$date = date("d-m-Y");
				$ZipfileName = $date."-"."BulkResumes.zip";
				$filepath= FCPATH.'/MailResumes/'.$ZipfileName;

				 // code for saving zip
				 if(is_array($_SESSION['sess_resume_array'])){

				 	$template_list->downloadZipServer($_SESSION['sess_resume_array'],$filepath);

				 }

				$mail_subject=$this->input->post("subject");
				$mail_body=$this->input->post("template_detail");
				$email = $job_order_data["email_id"];//die();
				$this->send_pulse->sendEmail($email,$mail_body,$mail_subject,$filepath,$ZipfileName);

				// delete file when mail will be send
				unlink($filepath);
				
				redirect('email/resume_list/nosearch');
			
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
					'job_type' => "",
					'flag' => "as",
					'action_page' => "sendmail",					
					);
		}
		

		$resume_array = Array();
	
		if(isset($_POST['resumes_select'])) 
		{
			//print_r($_POST['selectedResume']);die();
			if(!empty($_POST['selectedResume']))
			{
				// Loop to store and display values of individual checked checkbox.
				foreach($_POST['selectedResume'] as $selectedfile)
				{

					if (file_exists($selectedfile) && $selectedfile != "." && $selectedfile != "..") 
					 {
					       array_push($resume_array, "$selectedfile");
					 }

				}
			}
			$this->session->set_userdata('sess_resume_array',$resume_array);
 		}
 		
		$data["job_order_list"] = $job_order_list->get_jobID_list();
		$data["template_list"] = $template_list->getTemplates();
		$data['page_title'] = $this->lang->line("SEND_EMAIL");
		$data['view_file'] = 'sendmail/send_mail';
		//echo "<pre>";print_r($data);
		$this->load->view('layout',$data);
 		
	}

	public function get_template_data()
	{
		$id = $this->input->post("template_id");
		if($id)
		{ 
			$template_list = new EmailModel();
			$template_list = $template_list->get_template($id);
			 echo json_encode($template_list);
		
		}	
	}

	function change_paging($paging=NULL)
	{

		 $_SESSION["sess_paging"]=$paging;
	    redirect("email/index");
	}
	function change_paging_resume($paging=NULL)
	{

		 $_SESSION["sess_paging"]=$paging;
	    redirect("email/resume_list");
	}

}