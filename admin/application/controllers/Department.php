<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller
{
	public function __consrturt()
	{
		parent::__construct();
		if(session_id() == "") session_start();
		
	}

	public function index($msg=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$msg_display="";
		$msg_display1="";
		$msg_err_display="";
		$limit = "";
		
		if($this->uri->segment(4)!="")
		{
			@$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			if($this->uri->segment(4)=="d")
				$msg_display=$this->lang->line("DEPARTMENT_DELETE_MSG");
			if($this->uri->segment(4)=="add")
				$msg_display=$this->lang->line("DEPARTMENT_ADD_MSG");
			if($this->uri->segment(4)=="edit")
				$msg_display=$this->lang->line("DEPARTMENT_EDIT_MSG");
		}

		if($msg=="nosearch")
		{

			$this->session->set_userdata('sess_search_wh4','');
			$this->session->set_userdata('sess_search_wh3','');
			$this->session->set_userdata('sess_search_wh2','');
			$this->session->set_userdata('sess_search_wh1','');
			$this->session->set_userdata('sess_search_wh','');
			$this->session->set_userdata('sess_company','');
			$this->session->set_userdata('sess_department','');
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
			if($this->input->post("department_name")!="")
			{
				$where='department_name LIKE "%'.trim(addslashes($this->input->post("department_name"))).'%"';
				$this->session->set_userdata('sess_department',$this->input->post("department_name"));
			}
			else
				$this->session->set_userdata('sess_department','');

			if($this->input->post("company_name")!="")
			{
				$where1='company_name LIKE "%'.trim(addslashes($this->input->post("company_name"))).'%"';
				$this->session->set_userdata('sess_name',$this->input->post("company_name"));
			}
			else
				$this->session->set_userdata('sess_company','');
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
			$where3=" AND ".$this->session->userdata('sess_search_wh4');


		 $main_sql="SELECT * FROM ".TABLE_DEPARTMENT." WHERE id IS NOT NULL";


		$sql=$main_sql.$where.$where1.$where2.$where3;
 		$query = $this->db->query($sql);
 		$total_count=$query->num_rows();
 	//	echo "hiii".$query->num_rows();

		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");
		$segments = array('department', 'index');
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

		$order_by=' ORDER BY department_name asc '; 
		$sql=$main_sql.$where.$where1.$where2.$where3.$order_by.$limit;//die();
		$query = $this->db->query($sql);

		$data_department=$query->result_array();
		$data['department_data'] = $data_department;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");
		$data['msg_display'] = $msg_display;
		$data['msg_display1'] = $msg_display1;
		$data['msg_err_display'] =$msg_err_display;
		$data['page_title'] = $this->lang->line("DEPARTMENT_LIST");
		$data['view_file'] = 'department/index';
		$this->load->view('layout',$data);
	
	}


	public function add()
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		
		if( $this->input->post("flag")=="as")
		{

			$data = array(

					'company_name' => $this->input->post("company_name"),
					'department_name' => $this->input->post("department_name"),
					'contact' => $this->input->post("contact"),
					'title' => $this->input->post("title"),
					'std' => $this->input->post("std"),
					'phone' => $this->input->post("phone"),
					'email' => $this->input->post("email"),
					'address' => $this->input->post("address"),
					'city' => $this->input->post("city"),
					'state' =>$this->input->post("state"),
					'zip' => $this->input->post("zip"),
					);
			
		$this->form_validation->set_rules('company_name','Company Name','trim|required');
		$this->form_validation->set_rules('department_name','Department Name','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

		if ($this->form_validation->run() == TRUE)
			{
				
				$department_model = new DepartmentModel();
				$result =  $department_model->add_new_department($data);
				redirect('department/index/0/add');
			}	
			$data["id"]=0;
			$data["action_page"]="add";
			$data["flag"]="as";
			
		}
		else
		{
			$data = array(
					'company_name' => "",
					'department_name' => "",
					'contact' => "",
					'title' => "",
					'std' => "",
					'phone' => "",
					'email' => "",
					'address' => "",
					'city' => "",
					'state' =>"",
					'zip' => "",
			
					'flag' => "as",
					'id' => 0,
					'action_page' => "add",
					);
		}
		
		$company_list = new CompanyModel();
		$data["company_list"] = $company_list->getCompanies();
		$data['page_no'] = 0;
		$data['page_title'] = $this->lang->line("ADD_DEPARTMENT");
		$data['view_file'] = 'department/add';
		$this->load->view('layout',$data);

	
	}


	public function delete($id=NULL,$page_no=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		if($id)
		{
				if( empty($page_no) || ( $page_no<1 ) )
					$nextrecord = 0 ;
				else
					$nextrecord = ($page_no-1) * @$_SESSION["sess_paging"] ;
				$department = new DepartmentModel();
				$department->delete($id);

				//when we deleting records on second page, once we delete last entry on second page it should shift to 1st after deleting.
				if(@$_SESSION["sess_search_wh"]!="")
					$this->db->where(@$_SESSION["sess_search_wh"],'');
				$this->db->order_by('department_name','asc'); 
				$this->db->limit(PER_PAGE_RECORDS,$nextrecord);
				$query = $this->db->get(TABLE_DEPARTMENT);
				$data_cat=$query->result_array();
				if(empty($data_cat))
				{
					$page_no--;
				}
				if($page_no<0)
					$page_no=0;
				redirect('department/index/'.(int)$page_no."/d");
		}		
	}


	public function edit($id=NULL,$page_no=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$department_model = new DepartmentModel();
		if( $this->input->post("flag")=="es")
		{
			$data = array(

					'company_name' => $this->input->post("company_name"),
					'department_name' => $this->input->post("department_name"),
					'contact' => $this->input->post("contact"),
					'title' => $this->input->post("title"),
					'std' => $this->input->post("std"),
					'phone' => $this->input->post("phone"),
					'email' => $this->input->post("email"),
					'address' => $this->input->post("address"),
					'city' => $this->input->post("city"),
					'state' =>$this->input->post("state"),
					'zip' => $this->input->post("zip"),
					);
			
		$this->form_validation->set_rules('company_name','Company Name','trim|required');
		$this->form_validation->set_rules('department_name','Department Name','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');
		

			if ($this->form_validation->run() == TRUE)
			{
				$department_model->edit_department($data, $id);
				redirect('department/index/0/edit');
			}
			$data["action_page"]="edit";
			$data["flag"]="es";
			$data["id"]=$this->input->post("id");
		}
		else
		{
			$data=$department_model->get_department($id);
			
			if($data)
			{	
				$data["id"]=$id;
				$data["flag"] = "es";
				$data["action_page"] = "edit";
			}
			else
			{
				redirect('department/index/');
			}
		}
		$data["id"]=$id;
		$data['page_no'] = $page_no;
		$company_list = new CompanyModel();
		$data["company_list"] = $company_list->getCompanies();
		$data['page_title'] = $this->lang->line("EDIT_DEPARTMENT");
		$data['view_file'] = 'department/add';
		$this->load->view('layout',$data);

	}

	public function change_paging($paging=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$_SESSION["sess_paging"]=$paging;
	    redirect("department/index");
	}
}