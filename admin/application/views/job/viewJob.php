

		<style>
        	.jobf{
				width:88% !important;
				margin:1px auto;
			background-color: #ebebeb;
 /*         background-color: #FFE8D5;*/

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

       

   

        <section id="container">
             <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                	<span><a href="<?php echo base_url(); ?>job/index/nosearch"><< View Job list</a></span><br><br>
                                    
                                </header>

                                <div class="panel-body">
                                	<div class="jobf">
                                    <form class="cmxform form-horizontal tasi-form store" id="jobForm">
                                    	
                                        <div class="col-lg-12">
                                            <label for="position" class="col-lg-11">Position</label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="position" name="position" value="<?php echo $job_data["position"]?>" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="jobtype" class="col-lg-10">Job Type</label>
                                            <div class="col-lg-10">
                                                    <select id="jobtype" name="jobtype" class="form-control m-bot15" disabled>
                                                       
<?php 
foreach(JOB_TYPE_ARRAY as $key => $jobtype){ 
 ?>
                   <option value="<?= $key; ?>" 
                    <?php echo ($key == $job_data['job_type']) ? 'selected' : ''; ?>><?= $key; ?></option>
               <?php } ?>
                                                        
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="industry" class="col-lg-10">Industry</label>
                                            <div class="col-lg-10">
                                                    <select id="industry" name="industry" class="form-control m-bot15" disabled>
                                                        <option value="">Select Industry</option>
 <?php foreach($industry_list as $industry){
 ?>
                   <option value="<?= $industry['id']; ?>" 
                    <?php echo ($industry['id'] == $job_data['industry']) ? 'selected' : ''; ?>> <?= $industry['industry_name']; ?> </option>
               <?php } ?>

                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="dob" class="col-lg-10">Date</label>
                                            <div class="col-lg-10" id="dateDiv">
                                                <input class="form-control form-control-inline input-medium default-date-picker"  size="16" type="text"  name="date" id="date" value="<?php echo $job_data["date"]; ?>" readonly="readonly" />                                             </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label for="cons" class="col-lg-10">(Cons)</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="cons" name="cons" value="<?php echo $job_data["cons"]; ?>" readonly="readonly" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="contact_name" class="col-lg-10">Contact Name</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="contact_name" name="contact_name" value="<?php echo $job_data["contact_name"]; ?>" readonly="readonly"  >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="email" class="col-lg-10">Contact Email</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $job_data["email_id"]; ?>" readonly="readonly"  >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="title" class="col-lg-10">Title</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $job_data["title"]; ?>" readonly="readonly"  >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="company_name" class="col-lg-10">Company Name</label>
                                            <div class="col-lg-10">
                                                <select id="company_name" name="company_name" class="form-control m-bot15"  disabled >
 <option value="">Select Company</option>
 <?php foreach($company_list as $company){
 ?>
                   <option value="<?= $company['id']; ?>" 
                    <?php echo ($company['id'] == $job_data['company_id']) ? 'selected' : ''; ?>> <?= $company['company_name']; ?> </option>
               <?php } ?>

                                                    </select>
                                            </div>
                                        </div>
                                         <div class="col-lg-6">
                                            <label for="company_name" class="col-lg-10">Location Name</label>
                                            <div class="col-lg-10">
                                                    <select id="location_name" name="location_name" class="form-control m-bot15" disabled>
 <?php foreach($location_list as $location){
 ?>
                   <option value="<?= $location['id']; ?>" 
                    <?php echo ($location['id'] == $job_data['location_name']) ? 'selected' : ''; ?>> <?= $location['location_name']; ?> </option>
               <?php } ?>

                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="company_name" class="col-lg-10">Department Name</label>
                                            <div class="col-lg-10">
                                                    <select id="department_name" name="department_name" class="form-control m-bot15" disabled>
<?php foreach($department_list as $department){
 ?>
                   <option value="<?= $department['id']; ?>" 
                    <?php echo ($department['id'] == $job_data['department_name']) ? 'selected' : ''; ?>> <?= $department['department_name']; ?> </option>
               <?php } ?>
                                                    </select>
                                            </div>
                                        </div>
                                         <div class="col-lg-12">
                                            <label for="cell_number" class="col-lg-11">Cell Number / Directline</label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="cell_number" name="cell_number" value="<?php echo $job_data["cell_number"]; ?>" readonly="readonly" >
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        	<label for="target_clients" class="col-lg-11">Target Clients or vertical</label>
                                            <div class="col-lg-11">
                                                <textarea rows="2" id="target_clients" name="target_clients" class="form-control form-control-inline"  readonly="readonly"><?php echo $job_data["target_clients"]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        	<label for="target_clients" class="col-lg-11">Job Description/Duties</label>
                                            <div class="col-lg-11">
                                                <textarea rows="2" id="job_desc_textarea" name="job_desc_textarea" class="form-control form-control-inline"readonly="readonly"><?php echo $job_data["job_desc_textarea"]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label id="upf" for="upload" class="col-lg-11">File for Job Description/Duties</label>
                                            <div class="col-lg-10" id="showfile"></div>

                                          
                                            <div class="col-lg-10" id="dwn">
                               <a href="<?php echo base_url()?><?=$job_data['job_desc']?>" target= _blank>                <?php 
                                          $filename = str_replace("description/","",$job_data["job_desc"]);                echo $filename; ?> </a> 
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        	<label for="reason" class="col-lg-11">Reason position is open</label>
                                            <div class="col-lg-11">
                                                <textarea rows="2" id="reason" name="reason" class="form-control form-control-inline" readonly="readonly"><?php echo $job_data["reason_position"]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        	<label for="unique" class="col-lg-11">What makes the company unique?</label>
                                            <div class="col-lg-11">
                                                <textarea rows="2" id="unique" name="unique" class="form-control form-control-inline" readonly="readonly">
                                    <?php echo $job_data["company_unique_reason"]; ?>
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="years_in_bus" class="col-lg-4 col-sm-2">Years in business</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="years_in_bus" name="years_in_bus" value="<?php echo $job_data["years_in_business"]; ?>" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="prog" class="col-lg-4 col-sm-2">Training Program</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="prog" name="prog" value="<?php echo $job_data["training_program"]; ?>" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="sal" class="col-lg-4 col-sm-2">Salary Range</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="sal" name="sal" value="<?php echo $job_data["salary_range"]; ?>" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="tot_comp" class="col-lg-4 col-sm-2">Total Comp</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="tot_comp" name="tot_comp" value="<?php echo $job_data["total_comp"]; ?>" readonly="readonly" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="fee" class="col-lg-4 col-sm-2">Fee</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="fee" name="fee" value="<?php echo $job_data["fee"]; ?>" readonly="readonly"  >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="interview" class="col-lg-4 col-sm-2">Interview Process</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="interview" name="interview" value="<?php echo $job_data["interview_process"]; ?>" readonly="readonly" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="benefits" class="col-lg-4 col-sm-2">Benefits</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="benefits" name="benefits" value="<?php echo $job_data["benefits"]; ?>" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<label for="allowance" class="col-lg-4 col-sm-2">Car Allowance</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="allowance" name="allowance" value="<?php echo $job_data["car_allowance"]; ?>" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        	<label for="profile" class="col-lg-11">Desired Candidate Profile</label>
                                            <div class="col-lg-11">
    <textarea rows="2" id="profile" name="profile" class="form-control form-control-inline" readonly="readonly"><?php echo $job_data["desired_candidate_profile"]; ?></textarea>
</div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="keywords" class="col-lg-11">Keywords</label>
                                            <div class="col-lg-11" id="keyDiv">
                                                <input name="keywords" id="keywords" class="tagsinput" value="<?php echo $job_data["keywords"]; ?>" readonly="readonly"/>
                                            </div>
                                        </div>

                                    </form>
                                    </div>
                                </div>
                               
                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
            </section>
           