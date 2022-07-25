<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{
	public function __consrturt()
	{
		parent::__construct();
		if (session_id() == "") session_start();

	}
	public function cindex($msg=NULL)
	{

		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$msg_display="";
		$msg_display1="";
		$msg_err_display="";
		
		if($msg=="nosearch")
		{

			$this->session->set_userdata('sess_search_wh','');
			$this->session->set_userdata('sess_search_wh1','');
			$this->session->set_userdata('sess_search_wh2','');
			$this->session->set_userdata('sess_keyword','');
			$this->session->set_userdata('sess_location','');
			$this->session->set_userdata('sess_industry','');
			@$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
		}
		
		$where="";
		$where1="";
		$where2="";
		//echo $this->input->post("industry_name");die();
		if( $this->input->post("flag")=="search")
		{
			if($this->input->post("company_name")!="")
			{
				$where='company_name LIKE "%'.trim(addslashes($this->input->post("company_name"))).'%"';
				$this->session->set_userdata('sess_keyword',$this->input->post("company_name"));
			}
			else
				$this->session->set_userdata('sess_keyword','');

			if($this->input->post("industry_name")!="")
			{
				$where1='industry_name LIKE "%'.trim(addslashes($this->input->post("industry_name"))).'%"';
				$this->session->set_userdata('sess_industry',$this->input->post("industry_name"));
			}
			else
				$this->session->set_userdata('sess_industry','');

			if($this->input->post("location_name")!="")
			{
				$where2='city LIKE "%'.trim(addslashes($this->input->post("location_name"))).'%"';
				$this->session->set_userdata('sess_location',$this->input->post("location_name"));
			}
			else
				$this->session->set_userdata('sess_location','');
				
			$this->session->set_userdata('sess_search_wh',$where);
			$this->session->set_userdata('sess_search_wh1',$where1);	
			$this->session->set_userdata('sess_search_wh2',$where2);
			
		}
	
		if($this->session->userdata('sess_search_wh')!="")
			$this->db->where($this->session->userdata('sess_search_wh'));
		if($this->session->userdata('sess_search_wh1')!="")
			$this->db->where($this->session->userdata('sess_search_wh1'));
		if($this->session->userdata('sess_search_wh2')!="")
			$this->db->where($this->session->userdata('sess_search_wh2'));

	//	echo $_SESSION["sess_paging"];
		$this->db->order_by('company_name','asc'); 
		$query = $this->db->get(TABLE_COMPANY_DETAILS);
		$total_count=$query->num_rows();


		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");
		$segments = array('report', 'cindex');
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
		if($this->session->userdata('sess_search_wh1')!="")
			$this->db->where($this->session->userdata('sess_search_wh1'),'');
		if($this->session->userdata('sess_search_wh2')!="")
			$this->db->where($this->session->userdata('sess_search_wh2'),'');

		$this->db->limit(@$limit_end,@$limit_start);
		$this->db->order_by('company_name','asc'); 
		$query = $this->db->get(TABLE_COMPANY_DETAILS);

		$data_company=$query->result_array();
		$data['company_data'] = $data_company;

		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");
		$data['msg_display'] = $msg_display;
		$data['msg_display1'] = $msg_display1;
		$data['msg_err_display'] =$msg_err_display;
		$data['keyword'] = $this->session->userdata('sess_keyword');
		$data['page_title'] = $this->lang->line("COMPANY_REPORT_LIST");
		$industry_list = new IndustryModel();
		$data["industry_list"] = $industry_list->getIndustries();
		$data['view_file'] = 'report/cindex';
		$this->load->view('layout',$data);
	
	}
	
	function change_paging($paging=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();
		 $_SESSION["sess_paging"]=$paging;
	    redirect("report/cindex");
	}

	function change_paging_job($paging=NULL)
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();
		 $_SESSION["sess_paging"]=$paging;
	    redirect("report/jindex");
	}

	public function jindex($msg=NULL)
	{

		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();
		$msg_display="";
		$msg_display1="";
		$msg_err_display="";
		$limit = "";
		
		if($msg=="nosearch"){
			$this->session->set_userdata('sess_search_wh4','');
			$this->session->set_userdata('sess_search_wh3','');
			$this->session->set_userdata('sess_search_wh2','');
			$this->session->set_userdata('sess_search_wh1','');
			$this->session->set_userdata('sess_search_wh','');
			$this->session->set_userdata('sess_keyword','');
			$this->session->set_userdata('sess_jobtype','');
			$this->session->set_userdata('sess_fromdate','');
			$this->session->set_userdata('sess_todate','');
			@$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			
		}
		
		$where="";
		$where1="";
		$where2="";
		$where3="";
		$where4="";
		
		if( $this->input->post("flag")=="search")
		{

		//	date("Y-m-d", strtotime($fdate));

			if($this->input->post("txtkeyword")!="")
			{
				$where='company_name LIKE "%'.trim(addslashes($this->input->post("txtkeyword"))).'%"';
				$this->session->set_userdata('sess_keyword',$this->input->post("txtkeyword"));
			}
			else
				$this->session->set_userdata('sess_keyword','');

			if($this->input->post("job_type")!="")
			{
				$where1='t1.job_type LIKE "%'.trim(addslashes($this->input->post("job_type"))).'%"';
				$this->session->set_userdata('sess_jobtype',$this->input->post("job_type"));
			}
			else
				$this->session->set_userdata('sess_jobtype','');
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

		 $main_sql="SELECT t1.*,t2.company_name as company_name,t3.user_name as user_name,t4.industry_name as industry_name FROM ".TABLE_JOB_ORDER_FORM." t1,".TABLE_COMPANY_DETAILS." t2,".TABLE_BACKEND_USER_MASTER." t3,".TABLE_INDUSTRIES." t4 WHERE t1.company_id=t2.id AND t1.user_id=t3.user_id AND t1.industry = t4.id";

		$sql=$main_sql.$where.$where1.$where2.$where3.$where4;
 		$query = $this->db->query($sql);
 		$total_count=$query->num_rows();
 	//	echo "hiii".$query->num_rows();

		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");
		$segments = array('report', 'jindex');
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
		$sql=$main_sql.$where.$where1.$where2.$where3.$where4.$order_by.$limit;//die();
		$query = $this->db->query($sql);

		$data_job=$query->result_array();
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
		$data['page_title'] = $this->lang->line("JOB_REPORT_LIST");
		$data['view_file'] = 'report/jindex';
		$this->load->view('layout',$data);
	
	}

	// function for export CSV

	public function export_joblist()
	{
		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		 $companyName = "";
          $locationName = "";
          $industryName = "";
          $main_search_value = "";
          $companyName = "";
//          $fromDate = $_GET["fromDate"];
//          $toDate = $_GET["toDate"];
          $main_search_value ="";
//         $locationName =$_GET["locationName"];
//         $industryName = $_GET["industryName"];


//  
 $main_sql="SELECT t1.*,t2.company_name as company_name,t2.address,t3.user_name as user_name,t4.industry_name as industry_name, t5.location_name as location_name FROM ".TABLE_JOB_ORDER_FORM." t1,".TABLE_COMPANY_DETAILS." t2,".TABLE_BACKEND_USER_MASTER." t3,".TABLE_INDUSTRIES." t4,".TABLE_LOCATION." t5 WHERE t1.company_id=t2.id AND t1.user_id=t3.user_id AND t1.industry=t4.id AND t1.location_name=t5.id ORDER BY t1.formID DESC";

/*   $sql2 = "SELECT formID,cell_number,position,job_type,date,contact_name,location_name,email_id,salary_range,DATE_FORMAT(date,'%m-%d-%Y') AS date,(SELECT company_name FROM company_details WHERE id = company_id) AS company_name,keywords,cell_number,(SELECT user_name FROM backend_users_master WHERE backend_users_master.user_id = job_order_form.user_id) AS user_name FROM job_order_form  WHERE date != '' AND (SELECT company_name FROM company_details WHERE id = company_id) LIKE '%$companyName%' AND (SELECT company_name FROM company_details WHERE id = company_id) LIKE '%$main_search_value%' ORDER BY formID  DESC";
   */
   //$sql2 = "SELECT formID, position, job_type, DATE_FORMAT( date, '%m-%d-%Y' ) AS date, (SELECT company_name FROM company_details WHERE id = company_id ) AS company_name, keywords, cell_number, (SELECT user_name FROM backend_users_master WHERE backend_users_master.user_id = job_order_form.user_id) AS user_name FROM job_order_form WHERE date != '' AND  (SELECT company_name FROM company_details WHERE id = company_id ) LIKE '%$companyName%' AND (SELECT company_name FROM company_details WHERE id = company_id ) LIKE '%$main_search_value%' ORDER BY formID DESC ";
   

		$query = $this->db->query($main_sql);		
		$res2=$query->result_array();
  
$columnHeader = '';  
$columnHeader = "Sr NO" . "\t" . "Company NAME" . "\t" . "job_type" . "\t" . "Position" . "\t". "date" . "\t" . "address" . "\t" . "location" . "\t" . "Contact Name" . "\t" ."Email" . "\t" . "Industry Name" . "\t". "Salary Range" . "\t". "Cell Number" . "\t";  
 
$setData = '';  
 

for($i = 0; $i< count($res2);$i++){
    $rowData = '';  

       $rowData .=  '"JON-' . $res2[$i]["formID"] . '"' . "\t";  
       
        $value = '"' . $res2[$i]["company_name"] . '"' . "\t";  
        $rowData .= $value;  
        $rowData .=  '"' . $res2[$i]["job_type"] . '"' . "\t";  
         $rowData .=  '"' . $res2[$i]["position"] . '"' . "\t";  
        $rowData .=  '"' . $res2[$i]["date"] . '"' . "\t";  
        $rowData .=  '"' . $res2[$i]["address"] . '"' . "\t";  
        $rowData .=  '"' . $res2[$i]["location_name"] . '"' . "\t";  
          $rowData .=  '"' . $res2[$i]["contact_name"] . '"' . "\t";  
        
         $rowData .=  '"' . $res2[$i]["email_id"] . '"' . "\t";  
          $rowData .=  '"' . $res2[$i]["industry_name"] . '"' . "\t";  
          $rowData .=  '"' . $res2[$i]["salary_range"] . '"' . "\t";  
          $rowData .=  '"' . $res2[$i]["cell_number"] . '"' . "\t";  
        
    //}  
    $setData .= trim($rowData) . "\n";  
}  
  
  
	header("Content-type: application/octet-stream");  
	header("Content-Disposition: attachment; filename=JobList_Reoprt.xls");  
	header("Pragma: no-cache");  
	header("Expires: 0");  
	  
	echo ucwords($columnHeader) . "\n" . $setData . "\n";  
	}

	// export company list


	public function export_companylist()
	{
			//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();
		
			 $companyName = "";
          $locationName = "";
          $industryName = "";
          $main_search_value = "";
          /*$companyName = $_GET["companyName"];
          $locationName =$_GET["locationName"];
          $industryName = $_GET["industryName"];
          $main_search_value = $_GET["main_search_value"];
*/
   /*$main_sql = "SELECT company_name,contact,address,std,phone,industry_name,company_website from company_details where  company_name LIKE  '%$companyName%' AND city LIKE '%$locationName%' AND industry_name LIKE '%$industryName%'  AND  (company_name LIKE  '%$main_search_value%' OR city LIKE '%$main_search_value%' OR industry_name LIKE '%$main_search_value%' OR company_website LIKE '%$main_search_value%') ";
*/
 $main_sql = "SELECT * FROM " . TABLE_COMPANY_DETAILS;
  
		$query = $this->db->query($main_sql);		
		$res2=$query->result_array();
  
$columnHeader = '';  
$columnHeader = "Sr NO" . "\t" . "Company NAME" . "\t" . "Contact" . "\t" . "address" . "\t" . "Contact No" . "\t" . "Industry Name" . "\t". "Phone No" . "\t";  
  
$setData = '';  
 

for($i = 0; $i< count($res2);$i++){
    $rowData = '';  

       $rowData .=  '"' . $i . '"' . "\t";  
        $value = '"' . $res2[$i]["company_name"] . '"' . "\t";  
        $rowData .= $value;  
        $rowData .=  '"' . $res2[$i]["contact"] . '"' . "\t";  
        $rowData .=  '"' . $res2[$i]["address"] . '"' . "\t";  
        $rowData .=  '"' . $res2[$i]["std"]."-".$res2[$i]["phone"] . '"' . "\t";  
        $rowData .=  '"' . $res2[$i]["industry_name"] . '"' . "\t";  
        $rowData .=  '"' . $res2[$i]["phone"] . '"' . "\t";  
    //}  
    $setData .= trim($rowData) . "\n";  
}  
  
  
	header("Content-type: application/octet-stream");  
	header("Content-Disposition: attachment; filename=CompanyList_Reoprt.xls");  
	header("Pragma: no-cache");  
	header("Expires: 0");  
	  
	echo ucwords($columnHeader) . "\n" . $setData . "\n";  
	}

}
	