
        <style>

.form_control_input {
                            border: 1px solid #e2e2e4;
                            border: 1px solid #ccc;
                            box-shadow: none;
                            color: #c2c2c2;
                            color: #797979;
                        }
                        .form_control_input {
                            display: block;
                            width: 100%;
                            height: 34px;
                            padding: 6px 20px !important;
                            font-size: 14px;
                            line-height: 1.428571429;
                            color: #555;
                            background-color: #fff;
                            background-image: none;
                            border: 1px solid #ccc;
                            border-radius: 4px;
                            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                            -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                        }
                       
        </style>
      
        <section id="container" class="">
           
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                 <div class="panel-body">
                                    <a href="<?= base_url();?>report/export_joblist" class="btn sh" style="background-color:#342f29; color:#FFF" id="export_report">Export Job List</a>
                                </div>
 <?php echo form_open('report/jindex');?>
        <?php echo form_hidden('flag', "search");?>
                                <div class="panel-body form-horizontal">
                                	 <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">From Date</label>
                                            <div class="col-lg-2">
                                                <input class="form_control" type="date" name="fromdate" id="fromdate" value="<?= @$_SESSION['sess_fromdate']?>"/>
                                            </div>
                                            <label class="col-lg-1 col-sm-2" style="width:3%">To Date</label>
                                            <div class="col-lg-2">
                                            <input class="form_control" type="date" name="todate" id="todate" value="<?= @$_SESSION['sess_todate']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">Company Name</label>
                                            <div class="col-lg-2">
                                                <input type="text" class="form_control_input" id="txtkeyword" name="txtkeyword" value="<?= @$_SESSION['sess_keyword']?>">
                                            </div>
                                        </div>

                                    <div class="form-group">
                                             <label class="col-lg-1 col-sm-2">Job Type</label>
                                            <div class="col-lg-4">
                                                 <select id="job_type" name="job_type" class="form_control_input m-bot17">
                                                        <?php 
foreach(JOB_TYPE_ARRAY as $key => $jobtype){ 
 ?>
    
                   <option value="<?= $key; ?>" <?php echo ($key == @$_SESSION['sess_jobtype']) ? 'selected' : ''?> ><?= $jobtype; ?></option>
               <?php } ?>
                                                 </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-1 col-sm-2"></label>
                                            <div class="col-lg-8">
                                                 <button type="submit" class="btn sh" style="background-color:#342f29; color:#FFF">Search</button>
                                            </div>
                                        </div>

                                </div>
<?php form_close();?>

 
        <div class="panel-body">
<table align="right"><tr>
            <td width="2%" align="right" valign="middle">
            <?php 
             if($total_count>PER_PAGE_RECORDS)
            echo form_dropdown('paging', $paging_arr,@$_SESSION["sess_paging"],'id="paging" onchange="Paging(this.value)"');?>               
    </td></tr></table></div> 
     <?php if($msg_display!="") {?>
            <table align="center" ><tr>
            <th colspan="4" align="center" valign="middle" ><?php echo $msg_display;?></th>
            </tr></table>  
        <?php } ?>             
								<div><span id="tot">Total Records : <?= $total_count;?></span></div>                         


                                <div class="panel-body">
                                    <div class="adv-table"><?php if($job_data) { ?>
                                         <div id="recordcount"></div>
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Job Order No</th>
                                                    <th><i class="fa fa-bookmark"></i> Position</th>
                                                    <th><i class="fa fa-bookmark"></i> Job Type</th>
                                                    <th><i class="fa fa-calendar"></i> Date</th>
                                                    <th><i class="fa fa-bookmark"></i> Company Name</th>
                                                    <th><i class="fa fa-bookmark"></i> Industry Name</th>
                                                    <th><i class="fa fa-bookmark"></i> Keywords</th>
                                                    <th><i class="fa fa-bookmark"></i> User</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <?php  if($nextrecord==NULL)
                $record_no=1;
            else
                $record_no=$nextrecord+1; 
foreach($job_data as $v) { ?>
<tr>
<th><?php echo $record_no;?></th>
<th>JON-<?= $v["formID"];?></th>
<th><?= $v["position"];?></th>
<th><?= $v["job_type"];?></th>
<th><?= $v["date"];?></th>
<th><?= $v["company_name"];?></th>
<th><?= $v["industry_name"];?></th>
<th><?= $v["keywords"];?></th>
<th><?= $v["user_name"]?></th>
</tr>

<?php  $record_no++;}} ?> 

                       
           </tbody>

                                        </table> 
                   <?php if($msg_display1!="") {?>
            <table align="center" ><tr>
            <td colspan="4" align="center" valign="middle" ><?php echo $msg_display1;?></td>
            </tr></table>  
        <?php } ?>                                                             
                                       
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
 
<script type="text/javascript">

    function Paging(paging)
    {
        window.location="<?= base_url();?>report/change_paging_job/"+paging;
    }

</script>