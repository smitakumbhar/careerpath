

		<style>
        	.jobf{
				width:88% !important;
				margin:1px auto;
				background-color: #ebebeb;
  /*            background-color: #FFE8D5;*/

				padding-left:80px;
				padding-top:15px;
				padding-bottom:15px;
				padding-right:5px;
				border-radius:10px;
				/*box-shadow: 0 1px 5px rgba(0, 0, 0, 0.65);*/
			}
			.jobf label{
				font-size:15px;
				font-weight:600;
				margin-bottom:0;
				margin-top:0;
				padding-top:7px;
			}
			.jobf input[type="text"]{
				border:1px solid #ccc;
			}
			.jobf textarea{
				border:1px solid #ccc;
			}
			.jobf select{
				border:1px solid #ccc;
			}
        </style>

           
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                	<span id="back"><a href="<?php echo base_url();?>job/index/nosearch"><< View Jobs</a></span><br>
                                    
                                </header>

                                <div class="panel-body">
                                	<div class="jobf">
                                       
                <?php echo form_open_multipart('job/'.$action_page.'/'.$formID,array("class" => "cmxform form-horizontal tasi-form store"));?>
                <?php echo form_hidden('flag', $flag);?>
                <?php echo form_hidden('formID', $formID);?>
                <?php echo form_hidden('old_file', $job_desc);?>
                                    
                                        <div class="col-lg-12">
                                            <label for="position" class="col-lg-11">Position&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="position" name="position" value="<?= $position?>" >
                                                <?php echo form_error('position');?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="jobtype" class="col-lg-10">Job Type</label>
                                            <div class="col-lg-10">
                                                    <select id="jobtype" name="jobtype" class="form-control m-bot15">
                                                        <?php 
foreach(JOB_TYPE_ARRAY as $key => $jobtype){ 
 ?>
                   <option value="<?= $key; ?>" <?php  echo ($job_type == $jobtype) ? 'selected' : '' ;?> ><?= $jobtype; ?></option>
               <?php } ?>
                                                        
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="industry" class="col-lg-10">Industry</label>
                                            <div class="col-lg-10">
                                                    <select id="industry" name="industry" class="form-control m-bot15">
 <option value="">Select Industry</option>
 <?php foreach($industry_list as $industry_arr):?>
                   <option value="<?= $industry_arr['id']; ?>" <?php echo ($industry_arr['id'] == $industry ) ? 'selected' :''?>> <?= $industry_arr['industry_name']; ?> </option>
               <?php endforeach; ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="dob" class="col-lg-10">Date</label>
                                            <div class="col-lg-10" id="dateDiv">
                                                <input type="date" name="date" id="date" value="<?= $date?>"  />                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label for="cons" class="col-lg-10">(Cons)</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="cons" name="cons" value="<?= $cons?>" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="contact_name" class="col-lg-10">Contact Name&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="contact_name" name="contact_name" value="<?= $contact_name?>" ><?php echo form_error('contact_name');?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="email" class="col-lg-10">Contact Email</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="email" name="email" value="<?= $email_id?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="title" class="col-lg-10">Title&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="title" name="title" value="<?= $title;?>"><?php echo form_error('title');?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="company_name" class="col-lg-10">Company Name</label>
                                            <div class="col-lg-10">
                                                <select id="company_name" name="company_name" class="form-control m-bot15">
                                                    <option value="">Select Company</option>
                                                    <?php foreach($company_list as $company):?>
                   <option value="<?= $company['id']; ?>" <?php echo($company['id'] == $company_id) ? 'selected' : ''?>> <?= $company['company_name']; ?> </option>
               <?php endforeach; ?>

                                                    </select>
                                            </div>
                                        </div>

                                         <div class="col-lg-6">
                                            <label for="company_name" class="col-lg-10">Location Name</label>
                                            <div class="col-lg-10">
                                                    <select id="location_name" name="location_name" class="form-control m-bot15">
<option value="">Select Location</option>
                                                <?php foreach($location_list as $location):?>
                   <option value="<?= $location['id']; ?>" <?php echo ($location['id'] == $location_name) ? 'selected' :''?>> <?= $location['location_name']; ?> </option>
               <?php endforeach; ?>
                                                    </select>
                                                   
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="company_name" class="col-lg-10">Department Name</label>
                                            <div class="col-lg-10">
                                                    <select id="department_name" name="department_name" class="form-control m-bot15">
                                                        <option value="">Select Department</option>
                                                <?php foreach($department_list as $department):?>
                   <option value="<?= $department['id']; ?>" <?php echo($department['id'] == $department_name) ? 'selected' : ''?>> <?= $department['department_name']; ?> </option>
               <?php endforeach; ?>
                                                    </select>
                                            </div>
                                        </div>
                                         <div class="col-lg-12">
                                            <label for="cell_number" class="col-lg-11">Cell Number / Directline&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="cell_number" name="cell_number" value="<?= $cell_number; ?>" ><?php echo form_error('cell_number');?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        	<label for="target_clients" class="col-lg-11">Target Clients or vertical</label>
                                            <div class="col-lg-11">
                                                <textarea rows="2" id="target_clients" name="target_clients" class="form-control form-control-inline"><?= $target_clients;?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        	<label for="target_clients" class="col-lg-11">Job Description/Duties</label>
                                            <div class="col-lg-11">
                                                <textarea rows="2" id="job_desc_textarea" name="job_desc_textarea" class="form-control form-control-inline"><?= $job_desc_textarea;?></textarea>
                                            </div>
                                        </div>
<?php if($job_desc!="")
{
    $filename= str_replace("description/","",$job_desc);

 }else{
     $filename = "File Not Available";
 }  ?>
                                        <div class="col-lg-12">
                                            <label id="upf" for="upload" class="col-lg-11">If require upload file for Job Description/Duties</label>
                                            <div class="col-lg-10" id="showfile"></div>
                                            <div class="col-lg-10" id="dwn">
                                                <input type="file" id="upload" name="upload">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"></label>

                                            <?php if($flag == 'es'){?>
                                            <div class="col-lg-11"><?= $filename;?></div>
                                        <?php }?>


                                        </div> 
                                        <div class="col-lg-12">
                                        	<label for="reason" class="col-lg-11">Reason position is open</label>
                                            <div class="col-lg-11">
                                                <textarea rows="2" id="reason" name="reason" class="form-control form-control-inline"><?= $reason_position;?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        	<label for="unique" class="col-lg-11">What makes the company unique?</label>
                                            <div class="col-lg-11">
                                                <textarea rows="2" id="unique" name="unique" class="form-control form-control-inline"><?= $company_unique_reason;?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="years_in_bus" class="col-lg-4 col-sm-2">Years in business</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="years_in_bus" name="years_in_bus" value="<?= $years_in_business; ?>" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="prog" class="col-lg-4 col-sm-2">Training Program</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="prog" name="prog" value="<?= $training_program; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="sal" class="col-lg-4 col-sm-2">Salary Range</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="sal" name="sal" value="<?= $salary_range;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="tot_comp" class="col-lg-4 col-sm-2">Total Comp</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="tot_comp" name="tot_comp" value="<?= $total_comp;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="fee" class="col-lg-4 col-sm-2">Fee</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="fee" name="fee" value="<?= $fee ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="interview" class="col-lg-4 col-sm-2">Interview Process</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="interview" name="interview" value="<?= $interview_process;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="benefits" class="col-lg-4 col-sm-2">Benefits</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="benefits" name="benefits" value="<?= $benefits; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="allowance" class="col-lg-4 col-sm-2">Car Allowance</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="allowance" name="allowance" value="<?= $car_allowance ;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        	<label for="profile" class="col-lg-11">Desired Candidate Profile</label>
                                            <div class="col-lg-11">
                                                <textarea rows="2" id="profile" name="profile" class="form-control form-control-inline"><?= $desired_candidate_profile;?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="keywords" class="col-lg-11">Keywords</label>
                                            <div class="col-lg-11" id="keyDiv">
                                                <input name="keywords" id="keywords" class="tagsinput" value="<?= $keywords?>"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn sh" style="background-color:#342f29; color:#FFF; margin-left: 5%; margin-top: 3%;">Submit</button>
                                            </div>
                                        </div>
                                   <?php echo form_close(); ?>
                                    </div>
                                </div>
                                
                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
           </section>
        