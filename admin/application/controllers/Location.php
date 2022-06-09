<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller
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
		$limit="";
		if($this->uri->segment(4)!="")
		{
			@$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			if($this->uri->segment(4)=="d")
				$msg_display=$this->lang->line("LOCATION_DELETE_MSG");
			if($this->uri->segment(4)=="add")
				$msg_display=$this->lang->line("LOCATION_ADD_MSG");
			if($this->uri->segment(4)=="edit")
				$msg_display=$this->lang->line("LOCATION_EDIT_MSG");
		}
		
		if($msg=="nosearch"){
			$this->session->set_userdata('sess_search_wh4','');
			$this->session->set_userdata('sess_search_wh3','');
			$this->session->set_userdata('sess_search_wh2','');
			$this->session->set_userdata('sess_search_wh1','');
			$this->session->set_userdata('sess_search_wh','');
			$this->session->set_userdata('sess_company','');
			$this->session->set_userdata('sess_location','');
			$this->session->set_userdata('sess_fromdate','');
			$this->session->set_userdata('sess_todate','');
			$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			
		}
		
		$where="";
		$where1="";
		$where2="";
		$where3="";
		$where4="";
		if( $this->input->post("flag")=="search")
		{
			if($this->input->post("location_name")!="")
			{
				$where='location_name LIKE "%'.trim(addslashes($this->input->post("location_name"))).'%"';
				$this->session->set_userdata('sess_location',$this->input->post("location_name"));
			}
			else
				$this->session->set_userdata('sess_location','');

			if($this->input->post("company_name")!="")
			{
				$where1='company_name LIKE "%'.trim(addslashes($this->input->post("company_name"))).'%"';
				$this->session->set_userdata('sess_company',$this->input->post("company_name"));
			}
			else
				$this->session->set_userdata('sess_company','');

			if($this->input->post("fromdate")!="")
			{
				$fdate= $this->input->post("fromdate"); 
				$where2 = 'create_date >= "'.$fdate.'"';
				$this->session->set_userdata('sess_fromdate',$fdate);
			}
			else
				$this->session->set_userdata('sess_fromdate','');

			if($this->input->post("todate")!="")
			{
				$tdate= $this->input->post("todate"); 
				$where3 = 'create_date <= "'.$tdate.'"';
				$this->session->set_userdata('sess_todate',$tdate);
			}
			else
				$this->session->set_userdata('sess_todate','');

			if($this->input->post("fromdate")!="" && $this->input->post("todate")!="")
			{
				$fdate= $this->input->post("fromdate"); 
				$tdate= $this->input->post("todate"); 
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
		
		 $main_sql="SELECT * FROM ".TABLE_LOCATION." WHERE id IS NOT NULL ";

		$sql=$main_sql.$where.$where1.$where2.$where3;
 		$query = $this->db->query($sql);
 		$total_count=$query->num_rows();

		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");
		$segments = array('location', 'index');
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

		
		$order_by=' ORDER BY location_name asc '; 
		$sql=$main_sql.$where.$where1.$where2.$where3.$order_by.$limit;//die();
		$query = $this->db->query($sql);
		
		$data_location=$query->result_array();
		$data['location_data'] = $data_location;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");
		$data['msg_display'] = $msg_display;
		$data['msg_display1'] = $msg_display1;
		$data['msg_err_display'] =$msg_err_display;
		$data['keyword'] = $this->session->userdata('sess_keyword');
		$data['page_title'] = $this->lang->line("LOCATION_LIST");
		$data['view_file'] = 'location/index';
		$this->load->view('layout',$data);
	
	}

	public function add()
	{
		
		if( $this->input->post("flag")=="as")
		{
			$data = array(
							'company_name' =>  $this->input->post("company_name"),
							'location_name' => $this->input->post("location_name"),
							'location_link' => $this->input->post("location_link"),
							'contact' => $this->input->post("contact"),
							'title' => $this->input->post("title"),
							'std' => $this->input->post("std"),
							'phone' => $this->input->post("phone"),
							'email' => $this->input->post("email"),
							'address' => $this->input->post("address"),
							'city' => $this->input->post("city"),
							'state' => $this->input->post("state"),
							'zip' => $this->input->post("zip"),
						 );
			
		$this->form_validation->set_rules('company_name','Company Name','trim|required');
		$this->form_validation->set_rules('location_name','Location Name','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

		if ($this->form_validation->run() == TRUE)
			{
				
				$location_model = new LocationModel();
				$result =  $location_model->add_location($data);
				redirect('location/index/0/add');
			}	
			$data["id"]=0;
			$data["action_page"]="add";
			$data["flag"]="as";
			
		}
		else
		{
			$data = array(
					'company_name' =>  "",
					'location_name' =>  "",
					'location_link' =>  "",
					'contact' => "",
					'title' =>  "",
					'std' =>  "",
					'phone' => "",
					'email' => "",
					'address' =>  "",
					'city' =>  "",
					'state' =>  "",
					'zip' =>  "",
			
					'flag' => "as",
					'id' => 0,
					'action_page' => "add",
					);
		}
		
		$company_list = new CompanyModel();
		$data["company_list"] = $company_list->getCompanies();
		$data['page_no'] = 0;
		$data['page_title'] = $this->lang->line("ADD_LOCATION");
		$data['view_file'] = 'location/add';
		$this->load->view('layout',$data);

	
	}

	public function edit($id=NULL,$page_no=NULL)
	{
		$location_model = new LocationModel();
		if( $this->input->post("flag")=="es")
		{
		$data = array(
							'company_name' =>  $this->input->post("company_name"),
							'location_name' => $this->input->post("location_name"),
							'location_link' => $this->input->post("location_link"),
							'contact' => $this->input->post("contact"),
							'title' => $this->input->post("title"),
							'std' => $this->input->post("std"),
							'phone' => $this->input->post("phone"),
							'email' => $this->input->post("email"),
							'address' => $this->input->post("address"),
							'city' => $this->input->post("city"),
							'state' => $this->input->post("state"),
							'zip' => $this->input->post("zip"),
						 );
			
		$this->form_validation->set_rules('company_name','Company Name','trim|required');
		$this->form_validation->set_rules('location_name','Location Name','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

			if ($this->form_validation->run() == TRUE)
			{
				$location_model->edit_location($data, $id);
				redirect('location/index/0/edit');
			}
			$data["action_page"]="edit";
			$data["flag"]="es";
			$data["id"]=$this->input->post("id");
		}
		else
		{
			$data=$location_model->get_location($id);
			
			if($data)
			{	
				$data["id"]=$id;
				$data["flag"] = "es";
				$data["action_page"] = "edit";
			}
			else
			{
				redirect('location/index/');
			}
		}
		$data["id"]=$id;
		$data['page_no'] = $page_no;
		$company_list = new CompanyModel();
		$data["company_list"] = $company_list->getCompanies();
		$data['page_title'] = $this->lang->line("EDIT_LOCATION");
		$data['view_file'] = 'location/add';
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
				$location = new LocationModel();
				$location->delete($id);

				//when we deleting records on second page, once we delete last entry on second page it should shift to 1st after deleting.
				if(@$_SESSION["sess_search_wh"]!="")
					$this->db->where(@$_SESSION["sess_search_wh"],'');
				$this->db->order_by('location_name','asc'); 
				$this->db->limit(PER_PAGE_RECORDS,$nextrecord);
				$query = $this->db->get(TABLE_LOCATION);
				$data_cat=$query->result_array();
				if(empty($data_cat))
				{
					$page_no--;
				}
				if($page_no<0)
					$page_no=0;
				redirect('location/index/'.(int)$page_no."/d");
		}		
	}



	function change_paging($paging=NULL)
	{

		 $_SESSION["sess_paging"]=$paging;
	    redirect("location/index");
	}

}