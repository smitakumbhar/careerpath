<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller
{
	public function __consrturt()
	{
		parent::__construct();
		if (session_id() == "") session_start();
	}

	public function index($msg=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$msg_display="";
		$msg_display1="";
		$msg_err_display="";
		$limit ="";
		if($this->uri->segment(4)!="")
		{
			@$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			if($this->uri->segment(4)=="d")
				$msg_display=$this->lang->line("JOB_DELETE_MSG");
			if($this->uri->segment(4)=="add")
				$msg_display=$this->lang->line("JOB_ADD_MSG");
			if($this->uri->segment(4)=="edit")
				$msg_display=$this->lang->line("JOB_EDIT_MSG");
		}
		
		if($msg =="nosearch")
		{

			$this->session->set_userdata('sess_fromdate','');
			$this->session->set_userdata('sess_todate','');
			$this->session->set_userdata('sess_keyword','');
			$this->session->set_userdata('sess_search_wh4','');
			$this->session->set_userdata('sess_search_wh3','');
			$this->session->set_userdata('sess_search_wh2','');
			$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			$this->session->set_userdata('sess_search_wh','');
		}
		
		$where="";
		$where2="";
		$where3="";
		$where4="";
		if( $this->input->post("flag")=="search")
		{
			
			if($this->input->post("txtkeyword")!="")
			{
				$where='t2.company_name LIKE "%'.trim(addslashes($this->input->post("txtkeyword"))).'%"';
				$this->session->set_userdata('sess_keyword',$this->input->post("txtkeyword"));
			}
			else
				$this->session->set_userdata('sess_keyword','');

						//for date 
		
			if($this->input->post("fromdate")!="" && $this->input->post("todate")=="")
			{
				$fdate= date("Y-m-d", strtotime($this->input->post("fromdate"))); 
				$where2 = 't1.date >= "'.$fdate.'"';
				$this->session->set_userdata('sess_fromdate',$fdate);
			}
			else
				$this->session->set_userdata('sess_fromdate','');

			if($this->input->post("todate")!="" && $this->input->post("fromdate")=="")
			{
				$tdate= date("Y-m-d", strtotime($this->input->post("todate"))); 
				$where3 = 't1.date <= "'.$tdate.'"';
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
					
					$where4 = 't1.date >= "'.$fdate.'" AND t1.date <= "'.$tdate.'"';
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
			$where4=" AND ".$this->session->userdata('sess_search_wh4');

	
		 $main_sql="SELECT t1.*,t2.company_name as company_name,t3.user_name as user_name FROM ".TABLE_JOB_ORDER_FORM." t1,".TABLE_COMPANY_DETAILS." t2,".TABLE_BACKEND_USER_MASTER." t3 WHERE t1.company_id=t2.id AND t1.user_id=t3.user_id";

		$sql=$main_sql.$where.$where2.$where3.$where4;

		$query = $this->db->query($sql);
		$total_count = $query->num_rows();

		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");

		$segments = array('job', 'index');
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


		$order_by=' ORDER BY t1.formID asc '; 
		
		$sql=$main_sql.$where.$where2.$where3.$where4.$order_by.$limit;//die();
		$query = $this->db->query($sql);
				
		$data_job=$query->result_array();
		//echo "<pre>";print_r($data_job);die();
		$data['job_data'] = $data_job;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");
		$data['msg_display'] = $msg_display;
		$data['msg_display1'] = $msg_display1;
		$data['msg_err_display'] =$msg_err_display;
		$data['keyword'] = $this->session->userdata('sess_keyword');
		$data['page_title'] = $this->lang->line("JOB_LIST");
		$data['view_file'] = 'job/index';
		$this->load->view('layout',$data);
	
	}


	public function add()
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		if( $this->input->post("flag")=="as")
		{
			if(isset($_FILES['upload']['name']) && !empty($_FILES['upload']["name"]))
			{

				$savefile = new JobModel();
				$file_array = $savefile->Storefiles('upload','description');
				$filepath = $file_array["filepath"];
			}
			else{
				$filepath = "";
			}

         	$date = date("Y-m-d", strtotime($this->input->post("date")));

			$data = array(
					'user_id' => $_SESSION['user_id'], 
					'position' => $this->input->post("position"),
					'type_of_job' => $this->input->post("type_of_job"),
					'date' => $date,
					'cons' => $this->input->post("cons"),
					'company_id' => $this->input->post("company_name"),
					'location_name' => $this->input->post("location_name"),
					'department_name' => $this->input->post("department_name"),
					'contact_name' => $this->input->post("contact_name"),
					'email_id' => $this->input->post("email"),
					'title' => $this->input->post("title"),
					'target_clients' => $this->input->post("target_clients"),
					'job_desc' => $filepath, // path of description folder
					'job_desc_textarea' => $this->input->post("job_desc_textarea"),
					'reason_position' => $this->input->post("reason"),
					'company_unique_reason' => $this->input->post("unique"),
					'years_in_business' => $this->input->post("years_in_bus"),
					'training_program' => $this->input->post("prog"),
					'salary_range' => $this->input->post("sal"),
					'total_comp' => $this->input->post("tot_comp"),
					'fee' => $this->input->post("fee"),
					'interview_process' => $this->input->post("interview"),
					'benefits' => $this->input->post("benefits"),
					'car_allowance' => $this->input->post("allowance"),
					'desired_candidate_profile' => $this->input->post("profile"),
					'industry' => $this->input->post("industry"),
					'job_type' => $this->input->post("jobtype"),
					'keywords' => $this->input->post("keywords"),
					'cell_number' => $this->input->post("cell_number"),
					'create_date' => date('Y-m-d h:i:s'),
					);
			
		$this->form_validation->set_rules('position','Position','trim|required');
		$this->form_validation->set_rules('contact_name','Contact Name','trim|required');
		$this->form_validation->set_rules('title','Title','trim|required');
		$this->form_validation->set_rules('cell_number','Cell Number','trim|required'); 
		$this->form_validation->set_rules('type_of_job','Type Of Job','required');
		$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');
//echo "<pre>";print_r($data);die();
		if ($this->form_validation->run() == TRUE)
		{
			
			$add_job = new JobModel();
			$result = $add_job->AddJobOrder($data);
			redirect('job/index/0/add');
		}	
		$data["formID"]=0;
		$data["action_page"]="add";
		$data["flag"]="as";
		$data["job_desc"]=$filepath;
			
		}
		else
		{
			$data = array(

					'position' => "",
					'type_of_job' => "",
					'date' => "",
					'cons' => "",
					'company_id' => "",
					'location_name' => "",
					'department_name' => "",
					'contact_name' => "",
					'email_id' => "",
					'title' => "",
					'target_clients' => "",
					'job_desc' => "",
					'job_desc_textarea' => "",
					'reason_position' => "",
					'company_unique_reason' => "",
					'years_in_business' => "",
					'training_program' => "",
					'salary_range' => "",
					'total_comp' => "",
					'fee' => "",
					'interview_process' => "",
					'benefits' => "",
					'car_allowance' => "",
					'desired_candidate_profile' => "",
					'industry' => "",
					'job_type' => "",
					'keywords' => "",
					'cell_number' => "",

					'flag' => "as",
					'formID' => 0,
					'action_page' => "add",
					);
		}
		
		$industry_list = new IndustryModel();
		$data["industry_list"] = $industry_list->getIndustries();
		$department_list = new DepartmentModel();
		$data["department_list"] = $department_list->getDepartments();
		$company_list = new CompanyModel();
		$data["company_list"] = $company_list->getCompanies();
		$location_list = new LocationModel();
		$data["location_list"] = $location_list->getLocations();
		$data['page_no'] = 0;
		$data['page_title'] = $this->lang->line("ADD_JOB");
		$data['view_file'] = 'job/add';
		$this->load->view('layout',$data);

	
	}
	
	public function delete($id=NULL,$page_no=NULL,$filename=Null)
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
				$job = new JobModel();
				$job->delete($id);

				//when we deleting records on second page, once we delete last entry on second page it should shift to 1st after deleting.
				if(@$_SESSION["sess_search_wh"]!="")
					$this->db->where(@$_SESSION["sess_search_wh"],'');
				$this->db->order_by('formID','asc'); 
				$this->db->limit(PER_PAGE_RECORDS,$nextrecord);
				$query = $this->db->get(TABLE_JOB_ORDER_FORM);
				$data_cat=$query->result_array();
				if(empty($data_cat))
				{
					$page_no--;
				}
				if($page_no<0){
					$page_no=0;
				}

				if($filename != "Not Available")
				{
					$path = base_url()."description/" . $filename;
					while (file_exists($path))
					{
						unlink($path);
			         
			        }//end of while
			    }

				redirect('job/index/'.(int)$page_no."/d");
		}		
	}


	public function edit($formID=NULL,$page_no=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$add_job = new JobModel();
		if( $this->input->post("flag")=="es")
		{

			if(isset($_FILES['upload']["name"]) && !empty($_FILES['upload']["name"]))
			   {
			   		$savefile = new JobModel();
					$file_array = $savefile->Storefiles('upload','description');
					$new_filepath = $file_array["filepath"];

			    if ($new_filepath)
			    {
			    	
			    	$filepath= $new_filepath;
			        $filename = $this->input->post('old_file');     
			        if (file_exists($filename))
			        {
			            unlink($filename);
			          
			        }
			       
			   }
			   else
			   {
			    
			       $filepath=$this->input->post('old_file');

			   }
			}
			else{
			   $filepath=$this->input->post('old_file');

			}

        	$date = date("Y-m-d", strtotime($this->input->post("date")));

			$data = array(
					'user_id' => $_SESSION['user_id'], 
					'position' => $this->input->post("position"),
					'type_of_job' => $this->input->post("type_of_job"),
					'date' => $date,
					'cons' => $this->input->post("cons"),
					'company_id' => $this->input->post("company_name"),
					'location_name' => $this->input->post("location_name"),
					'department_name' => $this->input->post("department_name"),
					'contact_name' => $this->input->post("contact_name"),
					'email_id' => $this->input->post("email"),
					'title' => $this->input->post("title"),
					'target_clients' => $this->input->post("target_clients"),
					'job_desc' => $filepath, // path of description folder
					'job_desc_textarea' => $this->input->post("job_desc_textarea"),
					'reason_position' => $this->input->post("reason"),
					'company_unique_reason' => $this->input->post("unique"),
					'years_in_business' => $this->input->post("years_in_bus"),
					'training_program' => $this->input->post("prog"),
					'salary_range' => $this->input->post("sal"),
					'total_comp' => $this->input->post("tot_comp"),
					'fee' => $this->input->post("fee"),
					'interview_process' => $this->input->post("interview"),
					'benefits' => $this->input->post("benefits"),
					'car_allowance' => $this->input->post("allowance"),
					'desired_candidate_profile' => $this->input->post("profile"),
					'industry' => $this->input->post("industry"),
					'job_type' => $this->input->post("jobtype"),
					'keywords' => $this->input->post("keywords"),
					'cell_number' => $this->input->post("cell_number"),
					'create_date' => date('Y-m-d h:i:s'),
					);
			
		$this->form_validation->set_rules('position','Position','trim|required');
		$this->form_validation->set_rules('contact_name','Contact Name','trim|required');
		$this->form_validation->set_rules('title','Title','trim|required');
		$this->form_validation->set_rules('cell_number','Cell Number','trim|required'); 
		$this->form_validation->set_rules('type_of_job','Type Of Job','required');
		$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

	

			if ($this->form_validation->run() == TRUE)
			{
				
				$result = $add_job->update($data, $formID);
				redirect('job/index/0/edit');
			}
			$data["action_page"]="edit";
			$data["flag"]="es";
			$data["job_desc"]=$filepath;
			$data["formID"]=$this->input->post("formID");
		}
		else
		{
			$data=$add_job->get_job($formID);
			//echo "<pre>";print_r($data);die($data);
			if($data)
			{	

				$data["formID"]=$formID;
				$data["flag"] = "es";
				$data["action_page"] = "edit";
			}
			else
			{
				redirect('job/index/');
			}
		}
		$data["formID"]=$formID;
		$data['page_no'] = $page_no;
		$industry_list = new IndustryModel();
		$data["industry_list"] = $industry_list->getIndustries();
		$department_list = new DepartmentModel();
		$data["department_list"] = $department_list->getDepartments();
		$company_list = new CompanyModel();
		$data["company_list"] = $company_list->getCompanies();
		$location_list = new LocationModel();
		$data["location_list"] = $location_list->getlocations();
		$data['page_title'] = $this->lang->line("EDIT_JOB");
		$data['view_file'] = 'job/add';
		$this->load->view('layout',$data);

	}

	public function ViewJob($id = 0)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$view_job= new JobModel();
		$data['job_data'] =  $view_job->view_job($id);
		$industry_list = new IndustryModel();
		$data["industry_list"] = $industry_list->getIndustries();
		$department_list = new DepartmentModel();
		$data["department_list"] = $department_list->getDepartments();
		$company_list = new CompanyModel();
		$data["company_list"] = $company_list->getCompanies();
		$location_list = new LocationModel();
		$data["location_list"] = $location_list->getlocations();

		$data['page_title'] = $this->lang->line("VIEW_JOB");
		$data['view_file'] = 'job/viewJob';
		$this->load->view('layout',$data); 
	}
	

	
	public function job_order_book($msg=NULl)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$where="";
		$where1="";
		$where2="";
		$msg_display="";
		$_SESSION['job_data']="";

		if($msg!="")
		{
			if($msg=="nodata")
				$msg_display=$this->lang->line("DATA_NOT_FOUND");
			
		}
	
		if( $this->input->post("flag")=="as")
		{
		
		// industry
			if($this->input->post("industry")!="")
			{
				$where='t1.industry = '.$this->input->post("industry").'';
			}
			// for job type
			if($this->input->post("job_type")!="")
			{
				$where1='t1.job_type LIKE "%'.trim(addslashes($this->input->post("job_type"))).'%"';
			}
		
			// for keywords
			if($this->input->post("keywords")!="")
			{
				$where2='t1.keywords LIKE "%'.trim(addslashes($this->input->post("keywords"))).'%"';
			}

		if($where!="")
			$where=" AND ".$where;
		if($where1!="")
			$where1=" AND ".$where1;
		if($where2!="")
			$where2=" AND ".$where2;


		 $main_sql="SELECT t1.*,t2.industry_name as industry_name,t2.id,t3.company_name as company_name,t4.location_name as location_name,t5.department_name as department_name FROM ".TABLE_JOB_ORDER_FORM." t1,".TABLE_INDUSTRIES." t2, ".TABLE_COMPANY_DETAILS." t3,".TABLE_LOCATION." t4,".TABLE_DEPARTMENT." t5 WHERE t1.industry=t2.id AND t1.company_id=t3.id AND t1.location_name=t4.id AND t1.department_name=t5.id";

			
			$order_by=' ORDER BY t1.formID asc '; 
			$sql=$main_sql.$where.$where1.$where2.$order_by;//die();
			$query = $this->db->query($sql);
					
			$data_job=$query->result_array();
			$data['job_data'] = $data_job;
			$data["flag"]="as";
			$_SESSION['job_order_book_title']= $this->input->post("book_title");
			$_SESSION['job_data']= $data_job;
			redirect(base_url('job/digital_book'));
			
		}
		else
		{
			$data = array(
					'industry' => "",
					'job_type' => "",
					'keywords' => "",
					'book_title' => "",
					'flag' => "as",
					);
		}

		$industry_list = new IndustryModel();
		$data["industry_list"] = $industry_list->getIndustries();
		$data['page_title'] = $this->lang->line("JOB_ORDER_BOOK");
		$data['msg_display'] = $msg_display;
		$data['view_file'] = 'job_order_book/job_order_book';
		$this->load->view('layout',$data);
			
	}
	public function digital_book()
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		if(!empty($_SESSION['job_data']))
		{
			$data['view_file'] = 'job_order_book/digital_book';
			$data['page_title'] = $this->lang->line("JOB_ORDER_BOOK");
			$this->load->view('book_layout',$data);
		}
		else
		{
			redirect(base_url('job/job_order_book/nodata'));

		}
	}

	public function change_paging($paging=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		@$_SESSION["sess_paging"]=$paging;
	    redirect("job/index");
	}

	public function download_book()
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$html="";
		$limit=1;
		$pdfFilename = "JobOrderBook.pdf";
		require_once(APPPATH."helpers/tcpdf/tcpdf.php");
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->setTitle("Job Order Book");

		$pdf->AddPage();
     	$pdf->Image(base_url().'/images/logo.png',30);
     	$pdf->Ln ( 50 );
     //	$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );

     	$html_content = '<div style="text-align:center;margin-battom:10px; font-size: 10px;font-family: arial">&copy; Copyright Careerpaths NW</div>';    


		if($_SESSION['job_order_book_title']!="")
		{
			
            $html .='<table align="center">
            <tr><td align="center" style="font-size:60px;font-weight:bold;
    font-family: Arial ;">'.$_SESSION['job_order_book_title'].'</td></tr>
             <tr><td style="font-size:60px;">&nbsp;</td></tr>
            <tr><td align="center" style="font-size:60px;">&nbsp;</td></tr>
        </table>';
        $html .=$html_content;
        $html.='<br pagebreak="true"/>';
        }
        else
        {
        	$html .='<table align="center">
		            <tr><td align="center" style="font-size:60px;">JOB</td></tr>
		             <tr><td style="font-size:60px;">ORDER</td></tr>
		            <tr><td align="center" style="font-size:60px;">BOOK</td></tr>
		       		 </table>';
		    $html .=$html_content;
		    $html.='<br pagebreak="true"/>';
    	 }

		
		if(!empty($_SESSION['job_data']))
		{
				
				//$html= '<h1>Job Order Book</h1>';
				foreach($_SESSION['job_data'] as $key => $v)
				{
					$limit+=$key;
        			$limit1=$limit%4;
		
				$html .='<div>
				<table>
					<tr><td></td></tr>
					<tr><td><b>Job Form Id :</b> JON - '.$v["formID"].'</td></tr>
					<tr><td><b>Position :</b> '.$v["position"].'</td></tr>
					<tr><td><b>Job Type :</b> '.$v["job_type"].'</td></tr>
					<tr><td><b>Industry :</b> '.$v["industry_name"].'</td></tr>
					<tr><td><b>Added Date :</b> '.$v["date"].'</td></tr>
					<tr><td><b>(Cons) :</b> '.$v["cons"].'</td></tr>
					<tr><td><b>Contact Name :</b> '.$v["contact_name"].'</td></tr>
					<tr><td><b>Contact Email : </b>'.$v["email_id"].'</td></tr>
					<tr><td><b>Title :</b> '.$v["title"].'</td></tr>
					<tr><td><b>Company Name :</b> '.$v["company_name"].'</td></tr>
					<tr><td><b>Location Name :</b> '.$v["location_name"].'</td></tr>
					<tr><td><b>Department Name :</b> '.$v["department_name"].'</td></tr>
					<tr><td><b>Cell Number / Directline :</b>'.$v["cell_number"].'</td></tr>
					<tr><td><b>Target Clients or Vertical :</b> '.$v["target_clients"].'</td></tr>
					<tr><td><b>Reason Position is Open :</b> '. $v["reason_position"].'</td></tr>
					<tr><td><b>What makes the company unique? :</b> '.$v["company_unique_reason"].'</td></tr>
					<tr><td><b>Years In Business :</b> '.$v["years_in_business"].'</td></tr>
					<tr><td><b>Training Program :</b> '.$v["training_program"].'</td></tr>

					<tr><td><b>Salary Range : </b>'.$v["salary_range"].'</td></tr>
					<tr><td><b>Total Company :</b> '.$v["total_comp"].'</td></tr>
					<tr><td><b>Fee :</b>'.$v["fee"].'</td></tr>
					<tr><td><b>Interview Process :</b>'. $v["interview_process"].'</td></tr>
					<tr><td><b>Benifits  :</b>'.$v["benefits"].'</td></tr>
					<tr><td><b>Car Allowance  :</b>'.$v["car_allowance"].'</td></tr>
					<tr><td><b>Desired Candidate Profile  :</b> '.$v["desired_candidate_profile"].'</td></tr>
					<tr><td><b>Keywords  :</b>'.$v["keywords"].'</td></tr>

				</table>
			</div><br pagebreak="true"/>';

		//	 if($limit1==0)
          //		$html.='<br pagebreak="true"/>';

		}
		
			$pdf->writeHTML($html);
			$lastPage = $pdf->getPage();
			$pdf->deletePage($lastPage);
			//download it D save F.
		//	ob_start();
			$pdf->Output($pdfFilename, "D"); 
		//	ob_end_flush();
			$_SESSION['job_data'] = '';
			
		}
	}

	// send flip book in email
	public function share_book()
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		if($this->input->post('flag') == 'send')
		{

			$html="";
			$limit=1;

			require_once(APPPATH."helpers/tcpdf/tcpdf.php");
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$pdf->setTitle("Job Order Book");
			$pdf->AddPage();

			$pdf->Image(base_url().'/images/logo.png',30);
     	$pdf->Ln ( 50 );
     //	$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );

     	$html_content = '<div style="text-align:center;margin-battom:10px; font-size: 10px;font-family: arial">&copy; Copyright Careerpaths NW</div>';    


		if($_SESSION['job_order_book_title']!="")
		{
			
            $html .='<table align="center">
            <tr><td align="center" style="font-size:60px;font-weight:bold;
    font-family: Arial ;">'.$_SESSION['job_order_book_title'].'</td></tr>
             <tr><td style="font-size:60px;">&nbsp;</td></tr>
            <tr><td align="center" style="font-size:60px;">&nbsp;</td></tr>
        </table>';
        $html .=$html_content;
        $html.='<br pagebreak="true"/>';
        }
        else
        {
        	$html .='<table align="center">
		            <tr><td align="center" style="font-size:60px;">JOB</td></tr>
		             <tr><td style="font-size:60px;">ORDER</td></tr>
		            <tr><td align="center" style="font-size:60px;">BOOK</td></tr>
		       		 </table>';
		    $html .=$html_content;
		    $html.='<br pagebreak="true"/>';
    	 }

			if(!empty($_SESSION['job_data']))
			{
					
					foreach($_SESSION['job_data'] as $key => $v)
					{
						$limit+=$key;
	        			$limit1=$limit%4;
			
					$html .='<div>
					<table>
						<tr><td></td></tr>
						<tr><td><b>Job Form Id :</b> JON - '.$v["formID"].'</td></tr>
						<tr><td><b>Position :</b> '.$v["position"].'</td></tr>
						<tr><td><b>Job Type :</b> '.$v["job_type"].'</td></tr>
						<tr><td><b>Industry :</b> '.$v["industry_name"].'</td></tr>
						<tr><td><b>Added Date :</b> '.$v["date"].'</td></tr>
						<tr><td><b>(Cons) :</b> '.$v["cons"].'</td></tr>
						<tr><td><b>Contact Name :</b> '.$v["contact_name"].'</td></tr>
						<tr><td><b>Contact Email : </b>'.$v["email_id"].'</td></tr>
						<tr><td><b>Title :</b> '.$v["title"].'</td></tr>
						<tr><td><b>Company Name :</b> '.$v["company_name"].'</td></tr>
						<tr><td><b>Location Name :</b> '.$v["location_name"].'</td></tr>
						<tr><td><b>Department Name :</b> '.$v["department_name"].'</td></tr>
						<tr><td><b>Cell Number / Directline :</b>'.$v["cell_number"].'</td></tr>
						<tr><td><b>Target Clients or Vertical :</b> '.$v["target_clients"].'</td></tr>
						<tr><td><b>Reason Position is Open :</b> '. $v["reason_position"].'</td></tr>
						<tr><td><b>What makes the company unique? :</b> '.$v["company_unique_reason"].'</td></tr>
						<tr><td><b>Years In Business :</b> '.$v["years_in_business"].'</td></tr>
						<tr><td><b>Training Program :</b> '.$v["training_program"].'</td></tr>

						<tr><td><b>Salary Range : </b>'.$v["salary_range"].'</td></tr>
						<tr><td><b>Total Company :</b> '.$v["total_comp"].'</td></tr>
						<tr><td><b>Fee :</b>'.$v["fee"].'</td></tr>
						<tr><td><b>Interview Process :</b>'. $v["interview_process"].'</td></tr>
						<tr><td><b>Benifits  :</b>'.$v["benefits"].'</td></tr>
						<tr><td><b>Car Allowance  :</b>'.$v["car_allowance"].'</td></tr>
						<tr><td><b>Desired Candidate Profile  :</b> '.$v["desired_candidate_profile"].'</td></tr>
						<tr><td><b>Keywords  :</b>'.$v["keywords"].'</td></tr>

					</table>
				</div><br pagebreak="true"/>';

				// if($limit1==0)
	          	//	$html.='<br pagebreak="true"/>';

			}
			
				$pdf->writeHTML($html);
				$lastPage = $pdf->getPage();
				$pdf->deletePage($lastPage);
				$date = date("d-m-Y");
				$pdfFilename = $date."-"."JobOrderBook.pdf";
				$file_location = FCPATH.'/JobOrderBook/'.$pdfFilename;
				//download it D save F.
				$pdf->Output($file_location, "F"); 
				$filepath = FCPATH.'/JobOrderBook/'.$pdfFilename;

				$mail_subject="Job Order Book";
				$mail_body="This is Job Order Book";

				if(!empty($_POST['email']))
				{
					foreach($_POST['email'] as $email_id)
					{
						$this->send_pulse->sendEmail($email_id,$mail_body,$mail_subject,$filepath,$pdfFilename);
					}
				}
				// delete file when mail will be send
				unlink($filepath);
				$this->session->set_flashdata('msg', lang("MAIL_SENT_SUCCESS"));
				redirect("job/job_order_book");
						
			}
	} //end fo flag send

	$data['view_file'] = 'job_order_book/share_book';
	$data['page_title'] = $this->lang->line("SHARE_BOOK");
	$this->load->view('layout',$data);

}

// function for matching resumes
	public function match_resumes($id,$msg=NULL)
	{

		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$msg_display="";
		$limit ="";
		
		if($msg =="nosearch")
		{

			$this->session->set_userdata('sess_jobtype','');
			$this->session->set_userdata('sess_search_wh','');
			$this->session->set_userdata('sess_industry','');
			$this->session->set_userdata('sess_search_wh1','');
			$this->session->set_userdata('sess_location','');
			$this->session->set_userdata('sess_search_wh2','');
			$_SESSION["sess_paging"] = PER_PAGE_RECORDS;

		}
		
		$where="";
		$where1="";
		$where2="";


		if( $this->input->post("flag")=="search")
		{
			
			if($this->input->post("type_of_job")!="")
			{
				$where=' t2.type_of_job = "'.$this->input->post("type_of_job").'" ';
				$this->session->set_userdata('sess_jobtype',$this->input->post("type_of_job"));
			}
			else
				$this->session->set_userdata('sess_jobtype','');

			if($this->input->post("industry_id")!="")
			{
				$where1=' t2.industry_id = "'.$this->input->post("industry_id").'" ';
				$this->session->set_userdata('sess_industry',$this->input->post("industry_id"));
			}
			else
				$this->session->set_userdata('sess_industry','');

			if($this->input->post("location_id")!="")
			{
				$where2=' t2.location_id = "'.$this->input->post("location_id").'" ';
				$this->session->set_userdata('sess_location',$this->input->post("location_id"));
			}
			else
				$this->session->set_userdata('sess_location','');

			$this->session->set_userdata('sess_search_wh',$where);
			$this->session->set_userdata('sess_search_wh1',$where1);
			$this->session->set_userdata('sess_search_wh2',$where2);
		}
		
		if($this->session->userdata('sess_search_wh')!="")
			$where=" AND ".$this->session->userdata('sess_search_wh');

		if($this->session->userdata('sess_search_wh1')!="")
			$where1=" AND ".$this->session->userdata('sess_search_wh1');

		if($this->session->userdata('sess_search_wh2')!="")
			$where2=" AND ".$this->session->userdata('sess_search_wh2');

		 $main_sql="SELECT t1.*,t2.*,t3.location_name as location_name,t4.industry_name as industry_name FROM ".TABLE_JOB_ORDER_FORM." t1,".TABLE_RESUME_DETAILS." t2,".TABLE_LOCATION." t3,".TABLE_INDUSTRIES." t4 WHERE (t1.formID = t2.jobnumber OR t1.location_name=t2.location_id OR t1.industry = t2.industry_id OR t1.type_of_job = t2.type_of_job) AND t2.location_id=t3.id AND t2.industry_id = t4.id";

		$sql=$main_sql.$where.$where1.$where2;

		$query = $this->db->query($sql);
		$total_count = $query->num_rows();

		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display=$this->lang->line("NO_RECORD_FOUND");

		$segments = array('job', 'match_resumes');
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


		$order_by=' ORDER BY t2.firstname asc '; 
		
		$sql=$main_sql.$where.$where1.$where2.$order_by.$limit;//die();
		$query = $this->db->query($sql);
				
		$data_job=$query->result_array();
	//	echo "<pre>";print_r($data_job);//die();
		$data['msg_display'] = $msg_display;
		$data['resume_data'] = $data_job;
		$data['id'] =$id;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		
		$industry_list = new IndustryModel();
		$data["industry_list"] = $industry_list->getIndustries();
		$location_list = new LocationModel();
		$data["location_list"] = $location_list->getLocations();

		$data['paging_arr']= lang("paging_array");
		$data['view_file'] = 'job/matchResumes';
		$data['page_title'] = $this->lang->line("VIEW_RESUMES");
		$this->load->view('layout',$data);
	}



}