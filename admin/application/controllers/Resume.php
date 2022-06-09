<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resume extends CI_Controller
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
		$data['page_title'] = $this->lang->line("VIEW_RESUMES");
		$data['view_file'] = 'resumes/index';
		$this->load->view('layout',$data);
	
	}

	public function add()
	{
		 $placed_check = 0;
		if( $this->input->post("flag")=="as")
		{

            if($this->input->post("placed") == "on"){
                $placed_check = 1;
            }
			if(isset($_FILES['upload']['name']) && !empty($_FILES['upload']["name"]))
			{

				$savefile = new JobModel();
				$filepath = $savefile->Storefiles('upload','resumes');

			}
			else{
				$filepath = "";
			}

		$data = array(
					"firstname" => $this->input->post("fname"),
					 "lastname" => $this->input->post("lname"),
                      "keywords" => $this->input->post("keywords"),
					 "industry" => $this->input->post("industry"),
                     "candidate_email" => $this->input->post("c_email"),
                     "filepath" => $filepath,
                     "placed" => $placed_check,
                     "note" => $this->input->post("note"),
                     "jobnumber" => $this->input->post("jobnumber"),
                     "adminname" => $this->input->post("adminname"),
                     "uploaded_admin" => $_SESSION['user_id'],
                     "apply_from" => "M",
                     "create_date" => date('Y-m-d h:i:s'),
					);
			
		$this->form_validation->set_rules('fname','First Name','trim|required');
		$this->form_validation->set_rules('lname','Last Name','trim|required');
		$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

		if ($this->form_validation->run() == TRUE)
		{
			
			$add_resume = new ResumeModel();
			$result = $add_resume->AddResume($data);
			redirect('resume/index/0/add');
		}	
		$data["id"]=0;
		$data["action_page"]="add";
		$data["flag"]="as";
		$data["filepath"]=$filepath;
			
		}
		else
		{
			$data = array(
							"firstname" => "",
							"lastname" => "",
							"keywords" => "",
							"industry" => "",
							"candidate_email" => "",
							"filepath" => "",
							"placed" =>"",
							"note" => "",
							"jobnumber" =>"",
							"adminname" => "",
							"flag" => "as",
							"id" => 0,
							"action_page" => "add",
					);
		}
		
		$job_order_list = new JobModel();
		$data["job_order_list"] = $job_order_list->get_jobID_list();
		$user_list = new UserModel();
		$data["user_list"] = $user_list->getUsers();
		$data['page_no'] = 0;
		$data['page_title'] = $this->lang->line("ADD_RESUMES");
		$data['view_file'] = 'resumes/add';
		$this->load->view('layout',$data);

	
	}

	public function edit($id=NULL,$page_no=NULL)
	{
		$this->session->set_userdata('sess_search_wh','');
		$this->session->set_userdata('sess_keyword','');

		$resume_data = new ResumeModel();
		$placed_check = 0;
		if( $this->input->post("flag")=="es")
		{

			if($this->input->post("placed") == "on")
			{
				$placed_check = 1;
				$jobnumber = $this->input->post("jobnumber");
			}else{

				 $jobnumber = '';
 			}

			if(isset($_FILES['upload']["name"]) && !empty($_FILES['upload']["name"]))
			   {
			   		$savefile = new JobModel();
					$new_filepath = $savefile->Storefiles('upload','resumes');

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

			$data = array(
					"firstname" => $this->input->post("fname"),
					 "lastname" => $this->input->post("lname"),
                     "keywords" => $this->input->post("keywords"),
					 "industry" => $this->input->post("industry"),
                     "candidate_email" => $this->input->post("c_email"),
                     "filepath" => $filepath,
                     "placed" => $placed_check,
                     "note" => $this->input->post("note"),
                     "jobnumber" => $jobnumber,
                     "adminname" => $this->input->post("adminname"),
                     "uploaded_admin" => $_SESSION['user_id'],
                     "apply_from" => "M",
                     "create_date" => date('Y-m-d h:i:s'),
					);
			
		$this->form_validation->set_rules('fname','First Name','trim|required');
		$this->form_validation->set_rules('lname','Last Name','trim|required');
		$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');


			if ($this->form_validation->run() == TRUE)
			{
				
				$result = $resume_data->update($data, $id);
				redirect('resume/index/0/edit');
			}
			$data["action_page"]="edit";
			$data["flag"]="es";
			$data["job_desc"]=$filepath;
			$data["formID"]=$this->input->post("formID");
		}
		else
		{
			$data=$resume_data->get_resume($id);
			if($data)
			{	

				$data["id"]=$id;
				$data["flag"] = "es";
				$data["action_page"] = "edit";
			}
			else
			{
				redirect('resume/index/');
			}
		}
		$data["id"]=$id;
		$data['page_no'] = $page_no;
		$job_order_list = new JobModel();
		$data["job_order_list"] = $job_order_list->get_jobID_list();
		$user_list = new UserModel();
		$data["user_list"] = $user_list->getUsers();
		$data['page_title'] = $this->lang->line("EDIT_RESUME");
		$data['view_file'] = 'resumes/add';
		$this->load->view('layout',$data);

	}

	function delete($id=NULL,$page_no=NULL,$filename=Null)
	{
		if($id)
		{
				if( empty($page_no) || ( $page_no<1 ) )
					$nextrecord = 0 ;
				else
					$nextrecord = ($page_no-1) * @$_SESSION["sess_paging"] ;
				$resume = new ResumeModel();
				$resume->delete($id);

				//when we deleting records on second page, once we delete last entry on second page it should shift to 1st after deleting.
				if(@$_SESSION["sess_search_wh"]!="")
					$this->db->where(@$_SESSION["sess_search_wh"],'');
				$this->db->order_by('id','asc'); 
				$this->db->limit(PER_PAGE_RECORDS,$nextrecord);
				$query = $this->db->get(TABLE_RESUME_DETAILS);
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
					$path = base_url()."resumes/" . $filename;
					while (file_exists($path))
					{
						unlink($path);
			         
			        }//end of while
			    }

				redirect('resume/index/'.(int)$page_no."/d");
		}		
	}

	public function view_my_desk()
	{
		
		$data['page_title'] = $this->lang->line("VIEW_MY_DESK");
		$data['view_file'] = 'resumes/view_my_desk';
		$this->load->view('layout',$data);
	}
	
	public function view_usersdesk(){
		//echo "hii";
		$this->load->view("resumes/view_usersdesk");
		
	}
	
	public function search(){
		//echo "hii";
		$this->load->view("search/search");
		
	}

	public function bulk_download()
	{

		$msg_display1="";
		$resume_array = Array();
	
		if(isset($_POST['resumes_download'])) 
		{
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

			$resume_obj = new ResumeModel();
  			$resume_obj->zipFilesAndDownload($resume_array);
  			}	
  			
 		}
 		
	}

	public function bulk_upload()
	{

		$upload_failed="";
		$fields = array();
      	$filepath = array();
      	if($this->input->post('flag') == "uploadBulk")
      	{
		
	        $this->form_validation->set_rules('file','','callback_filecheck');
			$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

			if($this->form_validation->run() == TRUE)
			{
			
			    foreach ($_FILES as $key => $value)
			        {

			            $savefile = new JobModel();
			            $filepath = $savefile->StoreMUlfiles2($key,'bulkupload');
			        }

			        foreach ($_POST as $key => $value)
			        {
			            $fields[$key] = $value;
			        }
			       	$forms = new ResumeModel();
			   		$status = $forms->UploadMulResumeDetails($fields, $filepath);

			   		if($status != false)
					{
						redirect(base_url('resume/index/nosearch'));
						
					}
			}
		} // end of if

		$data["upload_failed"] = $upload_failed;
		$data['page_title'] = $this->lang->line("BULK_UPLOAD");
		$data['view_file'] = 'resumes/bulk_upload';
		$this->load->view('layout',$data);
	}

	public function filecheck()
	{
       
		$count = count(array_filter($_FILES['file']['name']));
	
		if($count == 0)
		{
			$this->form_validation->set_message('filecheck','Please choose a file to upload');
			return false;
		}
		else
			return true;
		
	}

	public function change_paging($paging=NULL)
	{

		$_SESSION["sess_paging"]=$paging;
	    redirect("resume/index");
	}
	// for bulk filelist
	public function bulk_filelist()
	{
		if($this->input->post("flag") == "export")
		{
			$dir = "./bulkupload";
                        if (is_dir($dir)){
                          if ($dh = opendir($dir)){
                            while (($file = readdir($dh)) !== false){
                              //echo "filename:" . $file . "<br>";
                          //    $temp2 = $dir."/".$file ;
                        	$temp2 = base_url()."bulkupload/"."Aaron_Becerra-Hurtado.pdf" ;
                                $docObj = new Doc2Txt($temp2);
                                $txt = $docObj->convertToText();
                                $matches = array(); //create array
                                 $pattern = '/[A-Za-z0-9_-]+@[A-Za-z0-9_-]+\.([A-Za-z0-9_-][A-Za-z0-9_]+)/'; //regex for pattern of e-mail address
                                  /* $pattern	=	"/(?:[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";*/

                                 preg_match_all($pattern, $txt, $matches); //find matching pattern
                                 var_dump($matches);

                                 $temp_storearray = [];
                                  $handle = fopen("bulkemaillist.csv", "w");
                                                    foreach($matches[0] as $email){
                                                         echo $email."\n";
                                                        // echo '<br>';
                                                       fwrite($handle, $email);
                                                        
                                                   }

     

 header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename('bulkemaillist.csv'));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('bulkemaillist.csv'));
    readfile('bulkemaillist.csv');
    
                          }
                        }
                        fclose($handle);

   
                         closedir($dh);
                        exit;
 fclose($file);

 }
		

		}
		$data["flag"]="export";
		$data['page_title'] = $this->lang->line("EXPORT_RESUMES");
		$data['view_file'] = 'resumes/bulk_filelist';
		$this->load->view('layout',$data);

	}


}