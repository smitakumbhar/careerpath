<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobModel extends CI_Model
{

	// adding user data 
	public function AddJobOrder($data)
	{	
		$this->db->insert(TABLE_JOB_ORDER_FORM,$data);
		return true;
		
	}

	public function get_job($formID)
	{
		$this->db->where("formID",$formID);
		$query = $this->db->get(TABLE_JOB_ORDER_FORM);
		return $result = $query->row_array();
	}


	//User List 
	function job_list($fromDate='', $todate='', $companyName='',$industryName='')
	{

		$columns = array("user_id","formID", "position", "job_type", "DATE_FORMAT(date,'%m-%d-%Y') AS date","(SELECT company_name FROM company_details WHERE id = company_id) AS company_name","(SELECT industry_name FROM industries WHERE id = industry) AS industry_name", "keywords", "cell_number", "(SELECT user_name FROM backend_users_master WHERE backend_users_master.user_id = job_order_form.user_id) AS user_name");
                
                if($fromDate == '' && $todate == '' & $companyName == ''){
                	$this->db->select($columns); 
		$this->db->where(array());
		$this->db->order_by('formID','DESC'); 
		$query = $this->db->get(TABLE_JOB_ORDER_FORM);
		$data_job=$query->result_array();
			//$jobs = CommonDBFunctions::SelectData("job_order_form", $columns, $where = array(), $order);
		}
		else{
			if($companyName == ''){
				$op = '!=';
			}
			else{
				$op = 'LIKE';
			}
                        if($industryName == ''){
				$op = '!=';
			}
			else{
				$op = 'LIKE';
			}

			$fdate = '';
			$tdate = '';

			if($fromDate != ''){
				$resD = explode("-",$fromDate);
				$fromDate = $resD[1].'-'.$resD[0].'-'.$resD[2];

				$resD = explode("-",$todate);
				$todate = $resD[1].'-'.$resD[0].'-'.$resD[2];

				$fdate = Functions::getformatteddate($fromDate);
				$tdate = Functions::getformatteddate($todate);
				$val = $fdate."' AND '".$tdate;
				$dop ="BETWEEN";
			}
			else{
				$val = '';
				$dop ="!=";
			}

			$where = array(
            	array("column" => "date"
                , "operation" => $dop
                , "value" => $val)
				,
				array("column" => "(SELECT company_name FROM company_details WHERE id = company_id)"
                , "operation" => $op
                , "value" => "%".$companyName."%")
                            ,
				array("column" => "(SELECT industry_name FROM industries WHERE id = industry)"
                , "operation" => $op
                , "value" => "%".$industryName."%")
        	);
		$this->db->select($columns); 
		$this->db->where($where);
		$this->db->order_by('formID','DESC'); 
		$query = $this->db->get(TABLE_JOB_ORDER_FORM);
		$data_job=$query->result_array();
       		
		}
       	
		return $data_job;
    }  

    function delete($id)
	{
		$this->db->where('formID', $id);
		$this->db->delete(TABLE_JOB_ORDER_FORM);
	   	return TRUE;
	}

    public function view_job($formID)
    {
    	$this->db->where("formID",$formID);
		$query = $this->db->get(TABLE_JOB_ORDER_FORM);
		return $result = $query->row_array();
    }


    public function update($data, $formID)
	{
		$this->db->where('formID', $formID);
		$query=$this->db->update(TABLE_JOB_ORDER_FORM, $data);
		return true;
	}

	function get_jobID_list()
	{
		$this->db->order_by('formID','asc'); 
		$query = $this->db->get(TABLE_JOB_ORDER_FORM);
		$data_job=$query->result_array();
		return $data_job;
    }

    public function Storefiles($fileindex, $folder) 
	{
       
        $arr = explode(".", $_FILES[$fileindex]["name"]);
        $finalname = str_replace(' ', '', $arr[0]);
        $imagename = $finalname . "." . $arr[1];
        $path = $folder . "/" . $imagename;
       // echo "hiii".$path;die();
        $counter = 1;

        while (file_exists($path)) {
            $arr = explode(".", $_FILES[$fileindex]["name"]);
            $finalname = str_replace(' ', '', $arr[0]);
            $imagename = $finalname . "_" . $counter . "." . $arr[1];
            $path = $folder . "/" . $imagename;
            $counter++;
        }//end of while

        $finalpath = $folder . "/" . $imagename;
        move_uploaded_file($_FILES[$fileindex]["tmp_name"], $finalpath);

        $returnpath = $folder . "/" . $imagename;
        return $finalpath ;
    }

     public function StoreMUlfiles2($fileindex, $folder)
     {
        //  echo $_FILES[$fileindex]['name'];die();
         $cnt = count($_FILES[$fileindex]['name']);
        // print_r($_FILES[$fileindex]['name']) ;
        $cnt2 = 0;
        $finalpath = array();
        for($i=0; $i<$cnt; $i++){
            if($_FILES[$fileindex]["name"][$i] != ''){
            $arr = explode(".", $_FILES[$fileindex]["name"][$i]);
            $finalname = str_replace(' ', '', $arr[0]);
            $imagename = $finalname . "." . $arr[1];
            $path = $folder . "/" . $imagename;
            $counter = 1;

            while (file_exists($path)) {
                $arr = explode(".", $_FILES[$fileindex]["name"][$i]);
                $finalname = str_replace(' ', '', $arr[0]);
                $imagename = $finalname . "_" . $counter . "." . $arr[1];
                $path = $folder . "/" . $imagename;
                $counter++;
            }//end of while

            $finalpath[$cnt2] = $folder ."/" . $imagename;

             move_uploaded_file($_FILES[$fileindex]["tmp_name"][$i], $finalpath[$cnt2]);
             // move_uploaded_file($_FILES[$fileindex]['name'], "../resume_details");
            $returnpath = $folder . "/" . $imagename;
            }
            $cnt2++;
        }

        return $finalpath ;
    }

}
?>