<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
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
		if($this->uri->segment(4)!="")
		{
			@$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			if($this->uri->segment(4)=="d")
				$msg_display=$this->lang->line("USER_DELETE_MSG");
			if($this->uri->segment(4)=="add")
				$msg_display=$this->lang->line("USER_ADD_MSG");
			if($this->uri->segment(4)=="edit")
				$msg_display=$this->lang->line("USER_EDIT_MSG");
		}
		
		if($msg == "nosearch"){
			$_SESSION["sess_paging"] = PER_PAGE_RECORDS;
			$this->session->set_userdata('sess_search_wh','');
			$this->session->set_userdata('sess_keyword','');
		}
		
		$where="";
		if( $this->input->post("flag")=="search")
		{
			if($this->input->post("txtkeyword")!="")
			{
				$where='user_name LIKE "%'.trim(addslashes($this->input->post("txtkeyword"))).'%"';
				$this->session->set_userdata('sess_keyword',$this->input->post("txtkeyword"));
			}
			else
				$this->session->set_userdata('sess_keyword','');
				
			$this->session->set_userdata('sess_search_wh',$where);
			
		}
		
		if($this->session->userdata('sess_search_wh')!="")
			$where=" WHERE ".$this->session->userdata('sess_search_wh');
		
		$sql="SELECT * FROM ".TABLE_BACKEND_USER_MASTER."  ".$where	;
		$query = $this->db->query($sql);
		$total_count = $query->num_rows();
		if( $this->input->post("flag")=="search" && $query->num_rows()==0)
			$msg_display1=$this->lang->line("NO_RECORD_FOUND");

		$segments = array('user', 'index');
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
		$this->db->order_by('user_name','asc'); 
		
		$query = $this->db->get(TABLE_BACKEND_USER_MASTER);
		
		$data_user=$query->result_array();
		$data['users_data'] = $data_user;
		$data['page_no'] = $page_no;
		$data['pagination'] =$pagination;
		$data['nextrecord'] = $nextrecord;
		$data['total_count'] = @$total_count;
		$data['paging_arr']= lang("paging_array");

		$data['msg_display'] = $msg_display;
		$data['msg_display1'] = $msg_display1;
		$data['msg_err_display'] =$msg_err_display;
		$data['keyword'] = $this->session->userdata('sess_keyword');
		$data['page_title'] = $this->lang->line("USER_MANAGEMENT");
		$data['view_file'] = 'user/index';
		$this->load->view('layout',$data);
	
	}


	public function add()
	{

		//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		if( $this->input->post("flag")=="as")
		{
				$user_name = $this->input->post("user_name");
				$user_email = $this->input->post("user_email");
				$user_type = $this->input->post("user_type");
				$password = $this->input->post("user_password");
				$user_rpassword = $this->input->post("user_rpassword");

			$this->form_validation->set_rules('user_name','Name','trim|required');
			$this->form_validation->set_rules('user_type','User Type','trim|required');
			$this->form_validation->set_rules('user_password','Password','trim|required|min_length[6]');
			$this->form_validation->set_rules('user_rpassword','Reenter Password','trim|required|matches[user_password]');
			$this->form_validation->set_rules('user_email','Email','trim|required|valid_email|is_unique[backend_users_master.user_email]'); 
			$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

	
		
		$password = hash("sha256", $password);

		$data = array(
				'user_name' => $user_name,
				'user_email' => $user_email,
				'user_type' => $user_type,
				'user_password' => $password,
				'admin_approval' => 0,
				'user_addition_timestamp' => date("Y-m-d h:i:s"),
				);

		if ($this->form_validation->run() == TRUE)
		{
			
			$add_user = new UserModel();
			$result = $add_user->add_new_user($data);
			redirect('user/index/0/add');
		}	
		$data["user_id"]=0;
		$data["action_page"]="add";
		$data["flag"]="as";
			
		}
		else
		{
			$data = array(
					'user_name' => "",
					'user_email' => "",
					'user_type' => "",
					'user_password' => "",
					'user_rpassword' => "",
					'flag' => "as",
					'user_id' => 0,
					'action_page' => "add",
					);
		}
		
		$data['page_no'] = 0;
		$data['page_title'] = $this->lang->line("NEW_USER");
		$data['view_file'] = 'user/add';
		$this->load->view('layout',$data);		
	}

	
	//-----------change status for admin approval
	public function change_status()
	{   
				//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

	$data_users = array(
					'user_id' => $this->input->post("user_id"),
					'admin_approval' =>$this->input->post("admin_approval"),
				);
		$update_users = new UserModel();
		$data['users_data'] =  $update_users->change_status($data_users);
		$this->load->view("user/view_user_list",$data);    
	}


	function delete($id=NULL,$page_no=NULL)
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

				// delete admin user
				$user = new UserModel();
				$user->delete($id);

				//delete rights assigned to user
				$rights = new RightsModel();
				$rights->deleteRights($id);
				

				//when we deleting records on second page, once we delete last entry on second page it should shift to 1st after deleting.
				if(@$_SESSION["sess_search_wh"]!="")
					$this->db->where(@$_SESSION["sess_search_wh"],'');
				$this->db->order_by('user_name','asc'); 
				$this->db->limit(PER_PAGE_RECORDS,$nextrecord);
				$query = $this->db->get(TABLE_BACKEND_USER_MASTER);
				$data_cat=$query->result_array();
				if(empty($data_cat))
				{
					$page_no--;
				}
				if($page_no<0)
					$page_no=0;
				redirect('user/index/'.(int)$page_no."/d");
		}		
	}


	public function edit($id=NULL,$page_no=NULL)
	{
				//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		//echo "<pre>";print_r($_POST);die();
		$view_user= new UserModel();
		if( $this->input->post("flag")=="es")
		{
			
		$this->form_validation->set_rules('user_name','Name','trim|required');
		$this->form_validation->set_rules('user_type','User Type','trim|required');
		$this->form_validation->set_error_delimiters('<div id="valid_error">','</div>');

		 if($this->input->post('user_password')!= "")
		 {
		 	$password = hash("sha256", $this->input->post('user_password'));
		 }
		 else
		 {
		 	$data_user =  $view_user->get_user_by_id($id);
		 	$password = $data_user["user_password"];
		 }
		$data = array(
				'user_name' => $this->input->post('user_name'),
				'user_type' => $this->input->post('user_type'),
				'user_password' =>  $password,
				'user_addition_timestamp' => date('Y-m-d : h:m:s'),
				);
			

			if ($this->form_validation->run() == TRUE)
			{
				$result = $view_user->edit_user($data, $id);
				redirect('user/index/0/edit');
			}
			$data =  $view_user->get_user_by_id($id);
			$data["action_page"]="edit";
			$data["flag"]="es";
			$data["user_id"]=$id;
		}
		else
		{
			
			$data =  $view_user->get_user_by_id($id);
			
			if($data)
			{	
				$data["user_id"]=$id;
				//$data["user_type"]=$id;
				$data["flag"] = "es";
				$data["action_page"] = "edit";
			}
			else
			{
				redirect('user/index/');
			}
		}
		$data["user_id"]=$id;
		$data['page_no'] = $page_no;
		$data['page_title'] = $this->lang->line("EDIT_USER");
		$data['view_file'] = 'user/add';
		$this->load->view('layout',$data);

	}

	function change_paging($paging=NULL)
	{
				//check admin is login
		$this->load->model('Commfuncmodel');
		$this->Commfuncmodel->checkAdminLogin();

		$_SESSION["sess_paging"]=$paging;
	    redirect("user/index");
	}
	
}