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
			$this->zip->read_file($file);

		}
		$this->zip->download('BulkResumes.zip');
		
	}


	public function UploadMulResumeDetails($fields, $filepath) 
	{
		
		    $data = [];
           
                for($i = 0;$i < count($filepath) ; $i++ ){
             
                   $temp1 = substr($filepath[$i], 11);
	               $arr = explode(".", $temp1, 2);
	               $arr1 = explode("_", $arr[0]);

                $data = array(
                          	"firstname"  => $arr1[0],
                           "lastname" =>  $arr1[1],
                            "keywords" => "",
							"industry" => "",
                         	"candidate_email" => "",
                        	"filepath" => $filepath[$i],
                        	"placed" => "",
                        	"note" => "",
                        	"jobnumber" => "",
                        	"adminname" => $_SESSION['user_name'],
							"apply_from" => "B",
                       		"placed" => 0,
                        	"create_date" => date('Y-m-d H:i:s'),
                );

              
				$this->db->insert(TABLE_RESUME_DETAILS,$data);
                $id = $this->db->insert_id();

               
             
                $docObj = new Doc2Txt($filepath[0]);

                 $txt = $docObj->convertToText();

                if(empty($txt))
                {

                    $this->db->set('resume_text', '{$txt}');
					$this->db->where('id', $id);
					$query=$this->db->update(TABLE_RESUME_DETAILS, $data);

                }
                else
                {
                  
                    $this->db->set('resume_text', $txt);
                    $this->db->where('id', $id);
					$query=$this->db->update(TABLE_RESUME_DETAILS, $data);
                }

            }

            return true;
              
    }


}
?>