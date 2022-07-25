<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResumeModel extends CI_Model
{

    
    function resume_list()
	{
		$this->db->order_by('id','asc'); 
		$query = $this->db->get(TABLE_RESUME_DETAILS);
		$data_resumes=$query->result_array();
		return $data_resumes;
    }

    // adding industry data 
	public function AddResume($data)
	{	
		$this->db->insert(TABLE_RESUME_DETAILS,$data);
		return true;
		
	}

	public function update($data, $id)
	{
		$this->db->where('id', $id);
		$query=$this->db->update(TABLE_RESUME_DETAILS, $data);
		return true;
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_RESUME_DETAILS);
	   	return TRUE;
	}

	public function get_resume($id)
	{
		$this->db->where("id",$id);
		$query = $this->db->get(TABLE_RESUME_DETAILS);
		return $result = $query->row_array();
	}

	// Function for creating a zip of a directory
	public function zipFilesAndDownload($file_names)
	{
		
		foreach ($file_names as $key=>$file)
		{
			$this->zip->read_file(RESUMES_FOLDER.$file);

		}
		$this->zip->download('BulkResumes.zip');
		
	}


	public function UploadMulResumeDetails($fields, $filepath) 
	{
	         // start the fscrawler to update index
	   		$fscrawler = $this->elasticsearch->start_fscrawler();	

		    $data = [];
		    $candidate_email="";

            for($i = 0;$i < count($filepath) ; $i++ )
                {
            		$filename1 = str_replace("resumes/","",$filepath[$i]);


            	//fetch file contents using elastic search
	   			 $file_content= $this->elasticsearch->fetch_file_content($filename1);
				if(!empty($file_content["hits"]["hits"]))
				{
					foreach($file_content["hits"]["hits"] as $key => $value)
					{
						
						$content= $value["_source"]["content"];
					}

				}
				
			$pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
			preg_match_all($pattern, $content, $matches);

//echo "<pre>";print_r($matches[0][0]);	
			if (filter_var($matches[0][0], FILTER_VALIDATE_EMAIL)) 
			{
					$candidate_email =$matches[0][0];
			}else
			{
					$candidate_email ="Not Available";
			}     
	           $temp1 = substr($filepath[$i], 8);
	           $arr = explode(".", $temp1, 2);
	           $arr1 = explode("_", $arr[0]);

	            $data = array(
	                  	"firstname"  => $arr1[0],
	                   "lastname" =>  $arr1[1],
	                    "keywords" => "",
						"industry" => "",
	                 	"candidate_email" => $candidate_email,
	                 	"filename" => $filename1,
	                	"filepath" => $filepath[$i],
	                	"note" => "",
	                	"jobnumber" => "",
	                	"adminname" => $_SESSION['user_name'],
						"apply_from" => "B",
	               		"placed" => 0,
	                	"create_date" => date('Y-m-d H:i:s'),
	        );
              //  echo "<pre>";print_r($data);die();
				$this->db->insert(TABLE_RESUME_DETAILS,$data);
                $id = $this->db->insert_id();

            }

            return true;
              
    }
}
?>