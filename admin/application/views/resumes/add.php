<style>
            .jobf{
                width:100%!important;
                margin:1px auto;
                background-color: #ebebeb;
     /*           background-color: #FFE8D5;*/
                padding-left:20px;
                padding-top:15px;
                padding-bottom:15px;
                padding-right:5px;
                border-radius:10px;
                float:left!important;
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
                        #main-content{
                                background-color: #FFFFFF;
                        }
                        .btn.btn-success.fileinput-button {
                            background-color: #6dbb4a;
                            margin-left: 2.5%;
                            margin-top: 1%;
                        }
                          #addinputtag{
                         float:left;width:74%;
                         }
                         input[type=file] {

                        margin-top: 5px;
                }

                #cta{ width:35%!important;
                float:right!important;}

                .clear{clear:both;}

                .location{background-color: #1fbcd2; color:#ffffff;}

                .depart{background-color: #673fb4; color:#ffffff;}

                .indus{background-color: #673fb4; color:#ffffff;}


                @media only screen and (max-width: 480px) {
                    #cta{ width:90%!important;
                float:none!important;
                margin-top:30px; }
                .jobf{width:90%!important;
                    float:none!important;}
                }



        </style>

            
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                	<span id="back" class="redirect"><a href="<?php echo base_url();?>desk/mydesk/nosearch"><< View My Desk</a></span><br>
                                        <span id="back" class="redirect"><a href="<?php echo base_url();?>resume/index/nosearch"><< View Resumes</a></span>
                         
                                    <button class="btn sh" id="add_forms" style="cursor: pointer; float: right; background-color:#342f29; color:#FFF;" onclick="bulk_upload();">Bulk Upload</button>
                        
                                </header>

                                <div class="panel-body">
                                	<div class="jobf">
   <?php echo form_open_multipart('resume/'.$action_page.'/'.$id,array("class" => "cmxform form-horizontal tasi-form store"));?>
                <?php echo form_hidden('flag', $flag);?>
                <?php echo form_hidden('id', $id);?>
                <?php echo form_hidden('old_file', $filepath);?>

                                        <div class="form-group">
                                            <div class="col-lg-5">
                                            <label for="fname" class="col-lg-4 col-sm-2">First Name&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="fname" name="fname" value="<?= $firstname;?>" >
                                            </div>
                                            <div class="col-lg-10">
                                                <?= form_error("fname");?>
                                            </div>
                                        </div>

                                             <div class="col-lg-5">
                                                 <label for="lname" class="col-lg-4 col-sm-2">Last Name&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="lname" name="lname" value="<?= $lastname;?>" >
                                            </div>
                                             <div class="col-lg-11">
                                                <?= form_error("lname");?>
                                            </div>
                                       
                                             </div>

                                            
                                           
                                            
                                            <div class="col-lg-5">
                                            <label for="industry" class="col-lg-4 col-sm-2">Email&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="c_email" name="c_email" value="<?= $candidate_email;?>" >
                                            </div>
                                            <div class="col-lg-10">
                                                <?= form_error("c_email");?>
                                            </div> 
                                        </div>

                                        <div class="col-lg-6">

                                              <label for="industry" class="col-lg-5 col-sm-2">Mobile Number&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="candidate_mobile_number" name="candidate_mobile_number" value="<?= $candidate_mobile_number;?>">
                                            </div> 

                                            <div class="col-lg-11">
                                                <?= form_error("candidate_mobile_number");?>
                                            </div> 

                                        </div>
                                       
 
                                    
                                          
                                    


                                         <div class="col-lg-5">
                                         <label for="industry" class="col-lg-4 col-sm-2">Industry&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-10">
                                                  <select id="industry_id" name="industry_id" class="form-control">
 <option value="">Select Industry</option>
 <?php foreach($industry_list as $industry_arr):?>
                   <option value="<?= $industry_arr['id']; ?>" <?php echo ($industry_arr['id'] == $industry_id ) ? 'selected' :''?>> <?= $industry_arr['industry_name']; ?> </option>
               <?php endforeach; ?>
                                                    </select>
                                            </div>
                                             <div class="col-lg-10">
                                                <?= form_error("industry_id");?>
                                            </div>

                                     </div>
<div class="col-lg-5">
                                            <label for="industry" class="col-lg-4 col-sm-2">Location&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-10">
                                               <select id="location_id" name="location_id" class="form-control">
<option value="">Select Location</option>
                                                <?php foreach($location_list as $location):?>
                   <option value="<?= $location['id']; ?>" <?php echo ($location['id'] == $location_id) ? 'selected' :''?>> <?php echo $location['location_name']; ?> </option>
               <?php endforeach; ?>
                                                    </select>

                                                    
                                            </div>
                                            <div class="col-lg-10">
                                                <?= form_error("location_id");?>
                                            </div>
                                        </div>
 <div class="col-lg-5">
                                          <label for="industry" class="col-lg-4 col-sm-2">Type Of Job&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-10">
<?php echo form_radio(array('name' => 'type_of_job', 'value' => 'WFH', 'id' => 'type_of_job', 'checked' => ('WFH' == $type_of_job))).form_label('WFH', 'wfh');?>&nbsp;&nbsp;&nbsp;
<?php echo form_radio(array('name' => 'type_of_job', 'value' => 'WFO', 'id' => 'type_of_job', 'checked' => ('WFO' == $type_of_job))).form_label('WFO', 'wfo');?>&nbsp;&nbsp;&nbsp;
<?php echo form_radio(array('name' => 'type_of_job', 'value' => 'Hybrid', 'id' => 'type_of_job', 'checked' => ('Hybrid' == $type_of_job))).form_label('Hybrid', 'hybrid');?>


                                        <?php echo form_error('type_of_job');?>
                                            </div>
                                     </div>

  <div class="col-lg-5" style="padding-top: 10px">
                                            <label for="industry" class="col-lg-4 col-sm-2">Placed</label>
                                           
                                                <div class="switch switch-square" data-on-label="Yes" data-off-label="No">
                                                    <input type="checkbox" id="placed" name="placed" <?php echo ($placed == 1) ? 'checked': ''?> onChange="check_switch();" />
                                           
                                           
                                        </div>
                                    </div>
                                     

           <div id="jNumber" style="display:none;">
                                             <div class="col-lg-8">
                                            <label class="col-lg-5 col-sm-2">Select Job number</label>
                                            <div class="col-lg-10">
                                                <select id="jobnumber" name="jobnumber" class="form-control m-bot15">
<option value="">Please Select</option>
 <?php foreach($job_order_list as $job_order):?>
                   <option value="<?= $job_order['formID']; ?>" <?php echo ($job_order['formID']== $jobnumber) ? 'selected' : ''?>>JON-<?= $job_order['formID']; ?> </option>
               <?php endforeach; ?>
                                                </select>
                                            </div></div>
                                        </div>

                                        <div class="col-lg-8">
                                            <label class="col-lg-5 col-sm-2">Is Interviewed by</label>
                                            <div class="col-lg-10">
                                                <select id="adminname" name="adminname" class="form-control m-bot15">
<option value="">Please Select</option>
 <?php foreach($user_list as $user):?>
                   <option value="<?= $user['user_id']; ?>" <?php echo ($user['user_id']== $adminname) ? 'selected' : ''?>> <?= $user['user_name']; ?> </option>
               <?php endforeach; ?>
                                                </select>
                                            </div>
                                       </div>

                                 <div class="col-lg-8">
                                             <label for="industry" class="col-lg-3 col-sm-2">Note</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" name="note" id="note"><?= $note;?></textarea>
                                            </div>

                                         </div>

                                          <div class="col-lg-8">
                                            <label for="keywords" class="col-lg-4 col-sm-2">Keywords</label>
                                            <div class="col-lg-10" id="keyDiv">
                                                <input name="keywords" id="keywords" class="tagsinput" value="<?= $keywords;?>"/>
                                            </div>
                                       </div>


                                         
                                     

                                        <div class="col-lg-8">

                                            <label id="filepath" ></label><br>
                                            <label id="upf" for="upload" class="col-lg-4 col-sm-2">Upload File&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-10">
                                                <input type="file" id="upload" name="upload">
                                            </div>
                                      <div class="col-lg-10">
                                                <?= form_error("upload");?>
                                            </div>

                                       </div>
                                        <?php //if($flag == 'es'){?>
                                            <div class="col-lg-11"><?= $filename;?></div>
                                        <?php //}?>

                                      
                                    <div class="col-lg-5">&nbsp;</div>
                                            <div class="col-lg-10" align="center">
                                                <button type="submit" class="btn sh" style="background-color:#342f29; color:#FFF">SUBMIT</button>
                                            </div>
                                       </div>
                                   <?php echo form_close();?>


<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap-switch.js"></script>

<script type="text/javascript">
function bulk_upload()
{
    window.location="<?php echo base_url();?>resume/bulk_upload";
}

function check_switch()
{

    var next_followup = $('#placed').is(':checked') ? 'yes' : 'no';
  //  alert(next_followup);
    if (next_followup == 'yes') {
        //$("div#jobnumber").hide();
        $("div#jNumber").show();
    }
    else if (next_followup == 'no') {
        $("div#jNumber").hide();
        //$("div#next_followup_no").show();
    }
}
</script>
        
                                    </div>
                                </div>
                                
                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
            </section>
        
 