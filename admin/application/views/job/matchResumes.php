
        <section id="container" class="">
          
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back" class="redirect" title="Home"><a href="<?php echo base_url();?>job/index/nosearch"><< View JOBS</a></span>&nbsp;
                                   
                                </header>
                                <?php echo form_open('job/match_resumes/'.$id);?>
        <?php echo form_hidden('flag', "search");?>
        <?php echo form_hidden('id', $id);?>


                                <div class="panel-body form-horizontal">
                                                                           
                                        <div class="form-group">
                                          <div class="col-lg-4">
                                         <label class="col-lg-4 col-sm-2">Type Of Job</label>
                                            <div class="col-lg-11">
<?php 
echo form_radio(array('name' => 'type_of_job', 'value' => 'WFH', 'id' => 'type_of_job', 'checked' => ('WFH' == @$_SESSION['sess_jobtype']))).form_label('WFH', 'wfh');?>&nbsp;&nbsp;&nbsp;
<?php echo form_radio(array('name' => 'type_of_job', 'value' => 'WFO', 'id' => 'type_of_job', 'checked' => ('WFO' == @$_SESSION['sess_jobtype']))).form_label('WFO', 'wfo');?>&nbsp;&nbsp;&nbsp;
<?php echo form_radio(array('name' => 'type_of_job', 'value' => 'Hybrid', 'id' => 'type_of_job', 'checked' => ('Hybrid' == @$_SESSION['sess_jobtype']))).form_label('Hybrid', 'hybrid');?>
<?php echo form_error('type_of_job');?>
                                            </div>
                                       </div>
                                        
                                    <div class="col-lg-4"> 
                                         <label for="industry" class="col-lg-4 col-sm-2">Industry</label>
                                            <div class="col-lg-10">
                                                  <select id="industry_id" name="industry_id" class="form-control">
 <option value="">Select Industry</option>
 <?php foreach($industry_list as $industry_arr):?>
                   <option value="<?= $industry_arr['id']; ?>" <?php echo ($industry_arr['id'] == $_SESSION['sess_industry'] ) ? 'selected' :''?>> <?= $industry_arr['industry_name']; ?> </option>
               <?php endforeach; ?>
                                                    </select>
                                            </div>
                                          
</div><div class="col-lg-4"> 
                                            <label for="industry" class="col-lg-4 col-sm-2">Location</label>
                                            <div class="col-lg-10">
                                               <select id="location_id" name="location_id" class="form-control">
<option value="">Select Location</option>
                                                <?php foreach($location_list as $location):?>
                   <option value="<?= $location['id']; ?>" <?php echo ($location['id'] == $_SESSION['sess_location']) ? 'selected' :''?>> <?php echo $location['location_name']; ?> </option>
               <?php endforeach; ?>
                                                    </select>

                                                    
                                            </div>
</div>
                                       <div class="col-lg-4">  
                                            <label class="col-lg-4 col-sm-2">&nbsp;</label>
                                            <div class="col-lg-8">
                                                 <button type="submit" class="btn sh" style="background-color:#342f29; color:#FFF">Search</button>
                                            </div>
                                   </div>    
                                </div>
<?php echo form_close();?> 
<div class="panel-body">
<table align="right"><tr>
            <td width="2%" align="right" valign="middle">
            <?php 
             if($total_count>PER_PAGE_RECORDS)
            echo form_dropdown('paging', $paging_arr,@$_SESSION["sess_paging"],'id="paging" onchange="Paging(this.value)"');?>               
    </td></tr></table></div>
                                <div><span id="tot">Total Records : <?= $total_count;?></span></div>                         
<div align="center"><table>     
 <?php if($msg_display!="") {?>
<th><?php echo $msg_display;?></th><?php }?>
</table></div>


                <div class="panel-body">
                                    <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="example"><?php if(!empty($resume_data)){?>
                                            <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Candidate Name</th>
                        <th>Candidate Email</th>
                        <th>Type Of Job</th>
                        <th>Industry</th>
                        <th>Location</th>
                        <th>View</th>
                    </tr>
                                            </thead>
                                            <tbody id="jobs">
 <?php  if($nextrecord==NULL)
                $record_no=1;
            else
                $record_no=$nextrecord+1;  
    foreach($resume_data as $v) { 

        ?>
    <tr>
        <th><?php echo $record_no;?></th>
        <th><?php echo $v["firstname"]."  ".$v["lastname"];?></th>
        <th><?php echo $v["candidate_email"];?></th>
        <th><?php echo $v["type_of_job"];?></th>
        <th><?php echo $v["industry_name"];?></th>
        <th><?php echo $v["location_name"];?></th>
        <th><a href="<?= base_url().$v["filepath"];?>" target="_blank">View</a></th>
    </tr>

                                               
                                             </tbody> <?php  $record_no++; }}?>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <table align="right"><tr><td width="88%" align="right" style="padding-right:6px;" valign="middle" >
            <?php if(@$_SESSION["sess_paging"]!="All" )echo $pagination; ?></td>
            </tr></table>
                    <!-- page end-->
                </section>
            </section>
           
        </section>
        



 