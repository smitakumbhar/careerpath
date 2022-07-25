<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller
{
	public function __consrturt()
	{
		parent::__construct();
		if (session_id() == "") session_start();
	}

	// boolean search
	public function index($msg=NULL)
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
		
		if($msg=="nosearch" || $this->uri->segment(4)!="")
		{

			$this->session->set_userdata('sess_search_wh','');
			$this->session->set_userdata('sess_search_wh1','');
			$this->session->set_userdata('sess_search_wh2','');
			$this->session->set_userdata('sess_search_wh3','');
			$this->session->set_userdata('sess_keyword','');
			$this->session->set_userdata('sess_keyword1','');
			$this->session->set_userdata('sess_keyword2','');
			$this->session->set_userdata('sess_keyword3','');
			@$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			
		}
		
		$where="";
		$where1="";
	$where2="";
	$where3="";
		if( $this->input->post("flag")=="search")
		{
			//echo $str1 = strpos($this->input->post("txtkeyword"),"and");// returns 4
		//	$str = explode("and",$this->input->post("txtkeyword"));
		//	print_r($str); die();
			//echo strpos($this->input->post("txtkeyword"), 'and');die();
			$str = stristr($this->input->post("txtkeyword"),"not"); // php not java retrun not java

			
			// die();
			if($this->input->post("txtkeyword")!="" && strpos($this->input->post("txtkeyword"), 'not') == false AND strpos($this->input->post("txtkeyword"), 'or') == true)
			{	
				$this->session->set_userdata('sess_keyword1','');
				$this->session->set_userdata('sess_search_wh1','');
				$where='keywords LIKE "%'.trim(addslashes($this->input->post("txtkeyword"))).'%"';
				$this->session->set_userdata('sess_keyword',$this->input->post("txtkeyword"));
			}
			else if($this->input->post("txtkeyword")!="" && $str!="" )
			{
				$this->session->set_userdata('sess_keyword','');
				$this->session->set_userdata('sess_search_wh','');
				//echo "else";die();
				$search =  str_replace($str,'',$this->input->post("txtkeyword")); // replace not java with blank
			//	echo "else";die();
				$where1='keywords LIKE "%'.trim(addslashes($search)).'%"';
				$this->session->set_userdata('sess_keyword1',$this->input->post("txtkeyword"));

			}else if($this->input->post("txtkeyword")!="" && strpos($this->input->post("txtkeyword"), 'not') == false AND strpos($this->input->post("txtkeyword"), 'and') == true )
			
			{
				//$str1 = stristr($this->input->post("txtkeyword"),"and"); // php and java 
				$str_search = explode("and",trim($this->input->post("txtkeyword")));
			//	print_r(implode(",",$str_search));die();
				$str_old = implode(",",$str_search);
				$str = str_replace(' ', '', $str_old);
				$this->session->set_userdata('sess_keyword','');
				$this->session->set_userdata('sess_search_wh','');
				$this->session->set_userdata('sess_keyword1','');
				$this->session->set_userdata('sess_search_wh1','');
		
				$where2='keywords LIKE "%'.trim(addslashes($str)).'%"';
			
				$this->session->set_userdata('sess_keyword2',$this->input->post("txtkeyword"));


			}else if($this->input->post("txtkeyword")!=""){
				$this->session->set_userdata('sess_keyword','');
				$this->session->set_userdata('sess_search_wh','');
				$this->session->set_userdata('sess_keyword1','');
				$this->session->set_userdata('sess_search_wh1','');
				$this->session->set_userdata('sess_keyword2','');
				$this->session->set_userdata('sess_search_wh2','');

				$where3='keywords LIKE "%'.trim(addslashes($this->input->post("txtkeyword"))).'%"';
			
				$this->session->set_userdata('sess_keyword3',$this->input->post("txtkeyword"));


			}

			$this->session->set_userdata('sess_search_wh',$where);
			$this->session->set_userdata('sess_search_wh1',$where1);
			$this->session->set_userdata('sess_search_wh2',$where2);
			$this->session->set_userdata('sess_search_wh3',$where3);
		}
		
		if($this->session->userdata('sess_search_wh')!="")
			$where=" AND ".$this->session->userdata('sess_search_wh');

		if($this->session->userdata('sess_search_wh1')!="")
			$where1=" AND ".$this->session->userdata('sess_search_wh1');

		if($this->session->userdata('sess_search_wh2')!="")
			$where2=" AND ".$this->session->userdata('sess_search_wh2');

		if($this->session->userdata('sess_search_wh3')!="")
			$where3=" AND ".$this->session->userdata('sess_search_wh3');

		$main_sql="SELECT * FROM ".TABLE_RESUME_DETAILS." WHERE id IS NOT NULL ";

		$sql=$main_sql.$where.$where1.$where2.$where3;
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
		
	 $sql=$main_sql.$where.$where1.$where2.$where3.$order_by.$limit;//die();
		$query = $this->db->query($sql);

		$data_resume=$query->result_array();
		$data['resume_data'] = $data_resume;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");
		$data['page_title'] = $this->lang->line("SEARCH");
		$data['view_file'] = 'search/index';
		$this->load->view('layout',$data);
	
	}

	public function folder_index($msg=NULL)
	{

		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();
		$file_array = array();
		$msg_display="";
		$limit="";
		
		if($msg=="nosearch")
		{

			$this->session->set_userdata('sess_search_wh','');
			$this->session->set_userdata('sess_search_wh1','');
			$this->session->set_userdata('sess_search_wh2','');
			$this->session->set_userdata('sess_search_wh3','');
			$this->session->set_userdata('sess_search_wh4','');
			@$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			
		}
		
		$where="";
		$where1="";
		$where2="";
		$where3="";
		$where4="";

		if( $this->input->post("flag")=="search")
		{
			$search_data= $this->input->post("txtkeyword");

			// No OR ,NOT , only AND
			if($search_data!="" && strpos($search_data, ' not') == false && strpos($search_data, ' or') == false && strpos($search_data, ',') == false && strpos($search_data, ' and') == true )
			{	
				//echo "1";die();
				$this->session->set_userdata('sess_search_wh1','');
				$this->session->set_userdata('sess_search_wh2','');
				$this->session->set_userdata('sess_search_wh3','');
				$this->session->set_userdata('sess_search_wh4','');
				$search_return = array();
				$str_search = explode(" and",trim($search_data));
			
				$search_return= $this->elasticsearch->query_search_and($str_search[0],$str_search[1]);
					
				if(!empty($search_return["hits"]["hits"]))
				{
					foreach($search_return["hits"]["hits"] as $key => $value)
					{
						array_push($file_array,$value["_source"]["file"]["filename"]);
					}
				}

				$file_names = join("','",$file_array); 
				$where = "WHERE filename IN ('$file_names')"; 
			}
			elseif($search_data!="" && strpos($search_data, ' not') == false && strpos($search_data, ' and') == false && strpos($search_data, ',') == false && strpos($search_data, ' or') == true )
			{
			//	echo "2";die();
				$this->session->set_userdata('sess_search_wh','');
				$this->session->set_userdata('sess_search_wh2','');
				$this->session->set_userdata('sess_search_wh3','');
				$this->session->set_userdata('sess_search_wh4','');

				$search_return = array();
				$str_search = explode(" or",trim($search_data));
			
				$search_return= $this->elasticsearch->query_search_or($str_search[0],$str_search[1]);
					
				if(!empty($search_return["hits"]["hits"]))
				{
					foreach($search_return["hits"]["hits"] as $key => $value)
					{
						array_push($file_array,$value["_source"]["file"]["filename"]);
					}
				}

				$file_names = join("','",$file_array); 
				$where1 = "WHERE filename IN ('$file_names')"; 

			}elseif($search_data!="" && strpos($search_data, ' and') == false && strpos($search_data, ' or') == false && strpos($search_data, ',') == false && strpos($search_data, ' not') == true )
			
			{
			//	echo "3";die();
				$this->session->set_userdata('sess_search_wh','');
				$this->session->set_userdata('sess_search_wh1','');
				$this->session->set_userdata('sess_search_wh3','');
				$this->session->set_userdata('sess_search_wh4','');

				// must query php not java
				$str_search = explode(" not",trim($search_data));
				
				$search_return = $this->elasticsearch->query_search_not($str_search[0],$str_search[1]);
				
				foreach($search_return["hits"]["hits"] as $key => $value)
				{
					array_push($file_array,$value["_source"]["file"]["filename"]);
				}
				$file_names = join("','",$file_array);   
				$where2 = "WHERE filename IN ('$file_names')";
		
			}elseif($search_data!="" && strpos($search_data, ' and') == false && strpos($search_data, ' or') == false && strpos($search_data, ' not') == false && strpos($search_data, ',') == false)
			{
				//echo "4";die();
				$this->session->set_userdata('sess_search_wh','');
				$this->session->set_userdata('sess_search_wh1','');
				$this->session->set_userdata('sess_search_wh2','');
				$this->session->set_userdata('sess_search_wh4','');

				// search only for php single search
				$search_return = $this->elasticsearch->query_search($search_data);

				if(!empty($search_return["hits"]["hits"]))
				{
					foreach($search_return["hits"]["hits"] as $key => $value)
					{
					//echo "<pre>";print_r($value["_source"]["file"]["filename"]);
						array_push($file_array,$value["_source"]["file"]["filename"]);
					}
				}
				
				$file_names = join("','",$file_array);   
				$where3 = "WHERE filename IN ('$file_names')";
			}elseif($search_data!="" && strpos($search_data, ' not') == false && strpos($search_data, ' and') == false && strpos($search_data, ' or') == false && strpos($search_data, ',') == true)
			{
			//	echo "5";die();
				$this->session->set_userdata('sess_search_wh','');
				$this->session->set_userdata('sess_search_wh2','');
				$this->session->set_userdata('sess_search_wh3','');
				$this->session->set_userdata('sess_search_wh1','');

				$search_return = array();
				$search_return = array();
				$str_search = explode(",",trim($search_data));
			
				$search_return= $this->elasticsearch->query_search_or($str_search[0],$str_search[1]);
					
				if(!empty($search_return["hits"]["hits"]))
				{
					foreach($search_return["hits"]["hits"] as $key => $value)
					{
						array_push($file_array,$value["_source"]["file"]["filename"]);
					}
				}

				$file_names = join("','",$file_array); 
				$where4 = "WHERE filename IN ('$file_names')"; 
			
			}

			$this->session->set_userdata('sess_search_wh',$where);
			$this->session->set_userdata('sess_search_wh1',$where1);
			$this->session->set_userdata('sess_search_wh2',$where2);
			$this->session->set_userdata('sess_search_wh3',$where3);
			$this->session->set_userdata('sess_search_wh4',$where4);
		}
		
		if($this->session->userdata('sess_search_wh')!="")
			$where=$this->session->userdata('sess_search_wh');

		if($this->session->userdata('sess_search_wh1')!="")
			$where1=$this->session->userdata('sess_search_wh1');

		if($this->session->userdata('sess_search_wh2')!="")
			$where2=$this->session->userdata('sess_search_wh2');

		if($this->session->userdata('sess_search_wh3')!="")
			$where3=$this->session->userdata('sess_search_wh3');

		if($this->session->userdata('sess_search_wh4')!="")
			$where4=$this->session->userdata('sess_search_wh4');

		$main_sql="SELECT * FROM ".TABLE_RESUME_DETAILS." ";

		$sql=$main_sql.$where.$where1.$where2.$where3.$where4;
 		$query = $this->db->query($sql);
 		$total_count=$query->num_rows();
 	//	echo "hiii".$query->num_rows();

		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display=$this->lang->line("NO_RECORD_FOUND");
		$segments = array('search', 'index');
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
	//	$sql=$main_sql.$where.$where1;//die();
		$query = $this->db->query($sql);

		$data_resume=$query->result_array();
		$data['resume_data'] = $data_resume;
		$data['msg_display'] = $msg_display;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['txtkeyword'] = $this->input->post("txtkeyword");
		$data['paging_arr']= lang("paging_array");
		$data['page_title'] = $this->lang->line("SEARCH");
		$data['view_file'] = 'search/folder_index';
		$this->load->view('layout',$data);
	
	}

	// boolean search
	public function folder_index_old($msg=NULL)
	{

		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();
		$flag= 0;
		$file_array= array();

		$msg_display="";
		$msg_display1="";
		$msg_err_display="";
		$limit="";
		$where ="";
		$where1 ="";
		$where2 ="";
		$where3 ="";

		if($msg=="nosearch" || $this->uri->segment(4)!="")
		{

			@$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			
		}
		
		if( $this->input->post("flag")=="search")
		{
			
		if($this->input->post("txtkeyword")!="")
		{
		
			$search_data= $this->input->post("txtkeyword");
			$search_return = $this->elasticsearch->query_file($search_data);
			//echo "<pre>";print_r($search_return["hits"]["hits"]);//die();
			foreach($search_return["hits"]["hits"] as $key => $value)
			{
				//echo "<pre>";print_r($value["_source"]["file"]["filename"]);
				array_push($file_array,$value["_source"]["file"]["filename"]);
			}
			if(!empty($file_array) && $this->input->post("flag")=="search")
			{
				$file_names = join("','",$file_array);   
				$where = "WHERE filepath IN ('$file_names')";
			}
		}
					$this->session->set_userdata('sess_search_wh',$where);

	}
			if($this->session->userdata('sess_search_wh')!="")
			$where=" AND ".$this->session->userdata('sess_search_wh');

	//	echo "<pre>";print_r($file_array);
//	$main_sql="SELECT * FROM ".TABLE_RESUME_DETAILS." WHERE id IS NOT NULL ";
	$sql=$main_sql.$where;
 		$query = $this->db->query($sql);
 		$total_count=$query->num_rows();

	if( $this->input->post("flag")=="search" && $flag == 1)
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
		
	 	$sql=$main_sql.$where.$order_by.$limit;//die();
		$query = $this->db->query($sql);

		$data_resume=$query->result_array();
		$data['resume_data'] = $data_resume;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");
		$data['page_title'] = $this->lang->line("SEARCH");
		$data['view_file'] = 'search/folder_index';
		$this->load->view('layout',$data);
	}


	public function test()
	{
		//start fscrawler to update index
		$fscrawler = $this->elasticsearch->start_fscrawler();
		//echo "<pre>";print_r($fscrawler);

	}

}

?>