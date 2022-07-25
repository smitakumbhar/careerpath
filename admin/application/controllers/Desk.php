<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desk extends CI_Controller
{
	public function __consrturt()
	{
		parent::__construct();
		if(session_id() == "") session_start();
	}
	public function userdesk($msg=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$msg_display="";
		$msg_display1="";
		$msg_err_display="";
		$limit="";

		if($this->uri->segment(4)!="")
		{
			@$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			if($this->uri->segment(4)=="d")
				$msg_display=$this->lang->line("RESUME_DELETE_MSG");
			if($this->uri->segment(4)=="add")
				$msg_display=$this->lang->line("RESUME_ADD_MSG");
			if($this->uri->segment(4)=="edit")
				$msg_display=$this->lang->line("RESUME_EDIT_MSG");
		}
		
		if($msg=="nosearch")
		{
			$this->session->set_userdata('sess_search_wh','');
			$this->session->set_userdata('sess_keyword','');
			$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			
		}
		
		$where="";
	//echo $this->input->post("user_id");die();	
		if( $this->input->post("flag")=="search")
		{
			if($this->input->post("user_id")!="")
			{
				$where='WHERE uploaded_admin = '.$this->input->post("user_id");
				$this->session->set_userdata('sess_keyword',$this->input->post("user_id"));
			}
			else
				$this->session->set_userdata('sess_keyword','');
			
			$this->session->set_userdata('sess_search_wh',$where);
				
		}
		
		if($this->session->userdata('sess_search_wh')!="")
			$where=$this->session->userdata('sess_search_wh');

		$main_sql="SELECT * FROM ".TABLE_RESUME_DETAILS." ";


		$sql=$main_sql.$where;
 		$query = $this->db->query($sql);
 		$total_count=$query->num_rows();
 	//	echo "hiii".$query->num_rows();

		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");
		$segments = array('desk', 'usersdesk');
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
		
		$sql=$main_sql.$where.$order_by.$limit;//die();
		$query = $this->db->query($sql);

		$data_resume=$query->result_array();
		$data['resume_data'] = $data_resume;
		$user= new UserModel();
		$user_arr = $user->getUsers();
		$data['user_arr'] = $user_arr;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");
		$data['msg_display'] = $msg_display;
		$data['msg_display1'] = $msg_display1;
		$data['msg_err_display'] =$msg_err_display;
		$data['keyword'] = $this->session->userdata('sess_keyword');
		$data['page_title'] = $this->lang->line("VIEW_USER_DESK");
		$data['view_file'] = 'desk/usersdesk';
		$this->load->view('layout',$data);
	
	}


	public function mydesk($msg=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$msg_display="";
		$msg_display1="";
		$msg_err_display="";
		$limit="";

		if($this->uri->segment(4)!="")
		{
			if($this->uri->segment(4)=="d")
				$msg_display=$this->lang->line("RESUME_DELETE_MSG");
			if($this->uri->segment(4)=="add")
				$msg_display=$this->lang->line("RESUME_ADD_MSG");
			if($this->uri->segment(4)=="edit")
				$msg_display=$this->lang->line("RESUME_EDIT_MSG");
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
			$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			
		}
		
		$where="";
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
			$this->session->set_userdata('sess_search_wh2',$where2);
			$this->session->set_userdata('sess_search_wh3',$where3);
			$this->session->set_userdata('sess_search_wh4',$where4);
			
		}
		
		if($this->session->userdata('sess_search_wh')!="")
			$where=" AND ".$this->session->userdata('sess_search_wh');

		if($this->session->userdata('sess_search_wh2')!="")
			$where2=" AND ".$this->session->userdata('sess_search_wh2');
		if($this->session->userdata('sess_search_wh3')!="")
			$where3=" AND ".$this->session->userdata('sess_search_wh3');
		if($this->session->userdata('sess_search_wh4')!="")
			$where3=" AND ".$this->session->userdata('sess_search_wh4');


		$main_sql="SELECT * FROM ".TABLE_RESUME_DETAILS." WHERE uploaded_admin = " .$_SESSION['user_id'];


		$sql=$main_sql.$where.$where2.$where3;
 		$query = $this->db->query($sql);
 		$total_count=$query->num_rows();
 	//	echo "hiii".$query->num_rows();

		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");
		$segments = array('desk', 'mydesk');
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
		
		$sql=$main_sql.$where.$where2.$where3.$order_by.$limit;//die();
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
		$data['page_title'] = $this->lang->line("VIEW_RESUMES");
		$data['view_file'] = 'desk/mydesk';
		$this->load->view('layout',$data);
	
	}

	public function change_paging($paging=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		@$_SESSION["sess_paging"]=$paging;
	    redirect("desk/mydesk");
	}

	public function change_paging_user($paging=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		@$_SESSION["sess_paging"]=$paging;
	    redirect("desk/userdesk");
	}

}