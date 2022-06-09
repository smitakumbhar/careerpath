<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industry extends CI_Controller
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
				$msg_display=$this->lang->line("INDUSTRY_DELETE_MSG");
			if($this->uri->segment(4)=="add")
				$msg_display=$this->lang->line("INDUSTRY_ADD_MSG");
			if($this->uri->segment(4)=="edit")
				$msg_display=$this->lang->line("INDUSTRY_EDIT_MSG");
		}
		
		if($msg == "nosearch")
		{
			$this->session->set_userdata('sess_search_wh','');
			$this->session->set_userdata('sess_keyword','');
			$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
		}
		
		$where="";
		if( $this->input->post("flag")=="search")
		{
			if($this->input->post("txtkeyword")!="")
			{
				$where='industry_name LIKE "%'.trim(addslashes($this->input->post("txtkeyword"))).'%"';
				$this->session->set_userdata('sess_keyword',$this->input->post("txtkeyword"));
			}
			else
				$this->session->set_userdata('sess_keyword','');
				
			$this->session->set_userdata('sess_search_wh',$where);
			
		}
		
		if($this->session->userdata('sess_search_wh')!="")
			$where=" WHERE ".$this->session->userdata('sess_search_wh');
		
		$sql="SELECT * FROM ".TABLE_INDUSTRIES."  ".$where	;
		$query = $this->db->query($sql);
		$total_count=$query->num_rows();
		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");

		$segments = array('industry', 'index');
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
		$this->db->order_by('industry_name','asc'); 
		$query = $this->db->get(TABLE_INDUSTRIES);
		
		$data_industry=$query->result_array();
		$data['industry_data'] = $data_industry;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");

		$data['msg_display'] = $msg_display;
		$data['msg_display1'] = $msg_display1;
		$data['msg_err_display'] =$msg_err_display;
		$data['keyword'] = $this->session->userdata('sess_keyword');
		$data['page_title'] = $this->lang->line("INDUSTRY_LIST");
		$data['view_file'] = 'industry/index';
		$this->load->view('layout',$data);
	
	}

	public function add()
	{
		
		if( $this->input->post("flag")=="as")
		{
			$data = array(
					'industry_name' => $this->input->post("industry_name"),
					);
			
			$this->form_validation->set_rules('industry_name',$this->lang->line("INDUSTRY_NAME"),'required');
			$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

			if ($this->form_validation->run() == TRUE)
			{
				
				$industry_model = new IndustryModel();
				$result =  $industry_model->add_new_industry($data);
				redirect('industry/index/0/add');
			}	
			$data["id"]=0;
			$data["action_page"]="add";
			$data["flag"]="as";
			
		}
		else
		{
			$data = array(
					'industry_name' => "",
					'flag' => "as",
					'id' => 0,
					'action_page' => "add",
					);
		}
		
		$data['page_no'] = 0;
		$data['page_title'] = $this->lang->line("ADD_INDUSTRY");
		$data['view_file'] = 'industry/add';
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
				$department = new IndustryModel();
				$department->delete($id);

				//when we deleting records on second page, once we delete last entry on second page it should shift to 1st after deleting.
				if(@$_SESSION["sess_search_wh"]!="")
					$this->db->where(@$_SESSION["sess_search_wh"],'');
				$this->db->order_by('industry_name','asc'); 
				$this->db->limit(PER_PAGE_RECORDS,$nextrecord);
				$query = $this->db->get(TABLE_INDUSTRIES);
				$data_cat=$query->result_array();
				if(empty($data_cat))
				{
					$page_no--;
				}
				if($page_no<0)
					$page_no=0;
				redirect('industry/index/'.(int)$page_no."/d");
		}		
	}

	

	public function edit($id=NULL,$page_no=NULL)
	{
		$industry_model = new IndustryModel();
		if( $this->input->post("flag")=="es")
		{
			$data = array(
					'industry_name' => $this->input->post("industry_name"),
					);
			
			$this->form_validation->set_rules('industry_name',$this->lang->line("INDUSTRY_NAME"),'required');
		
			$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');
			if ($this->form_validation->run() == TRUE)
			{
				$industry_model->edit_industry($data, $id);
				redirect('industry/index/0/edit');
			}
			$data["action_page"]="edit";
			$data["flag"]="es";
			$data["id"]=$this->input->post("id");
		}
		else
		{
			$data=$industry_model->get_industry($id);
			
			if($data)
			{	
				$data["id"]=$id;
				$data["flag"] = "es";
				$data["action_page"] = "edit";
			}
			else
			{
				redirect('industry/index/');
			}
		}
		$data["id"]=$id;
		$data['page_no'] = $page_no;
		$data['page_title'] = $this->lang->line("EDIT_INDUSTRY");
		$data['view_file'] = 'industry/add';
		$this->load->view('layout',$data);

	}

	function change_paging($paging=NULL)
	{

		 $_SESSION["sess_paging"]=$paging;
	    redirect("industry/index");
	}

}