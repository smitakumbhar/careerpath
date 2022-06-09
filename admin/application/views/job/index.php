
        <section id="container" class="">
          
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back" class="redirect" title="Home"><a href="<?php echo base_url();?>home/index"><< Home</a></span>&nbsp;<br><br>
                                   
                                    <button class="btn sh" style="background-color:#342f29; color:#FFF" onclick="addJob();"><?= lang("ADD_JOB");?></button><br>
                                </header>
                                <?php echo form_open('job/index');?>
        <?php echo form_hidden('flag', "search");?>


                                <div class="panel-body form-horizontal">
                                	 <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">From Date</label>
                                            <div class="col-lg-2">
                                                <input type="date" value="<?= @$_SESSION['sess_fromdate']?>" name="fromdate" id="fromdate"  />
                                            </div>
                                            <label class="col-lg-1 col-sm-2" style="width:3%">To Date</label>
                                            <div class="col-lg-2">
                                            <input type="date" value="<?= @$_SESSION['sess_todate']?>" name="todate" id="todate"  />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">Company Name</label>
                                            <div class="col-lg-2">
                                                <input type="text" class="form-control" id="txtkeyword" name="txtkeyword"  value="<?= @$_SESSION['sess_keyword']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-1 col-sm-2"></label>
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
<div align="center" >   <table>     
 <?php if($msg_display!="") {?>
                                    
        <th>
        <?php echo $msg_display;?>
        </th>
      <?php }?>
       <?php if($msg_err_display!="") {?>
      <th>
        <?php echo $msg_err_display;?>
        </th>
      <?php }?> <?php if($msg_display1!="") {?>
                                    
        <th>
        <?php echo $msg_display1;?>
        </th>
      <?php }?></table></div>

                                <div class="panel-body">
                                    <div class="adv-table"><?php if($job_data){ ?>
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                   <!--  <th>Sr. No</th> -->
                                                    <th>Job Form ID</th>
                                                    <th><i class="fa fa-bookmark"></i> Position</th>
                                                    <th><i class="fa fa-bookmark"></i> Job Type</th>
                                                    <th><i class="fa fa-calendar"></i> Date</th>
                                                    <th><i class="fa fa-bookmark"></i> Company Name</th>
                                                    <th><i class="fa fa-bookmark"></i> Keywords</th>
                                                    <th><i class="fa fa-bookmark"></i> User</th>
                                                    <th> View</th>
                                          
                                                    <th class='per'> Edit</th>
                                                    <th class="per"> Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="jobs">
 <?php  if($nextrecord==NULL)
                $record_no=1;
            else
                $record_no=$nextrecord+1;  
    foreach($job_data as $v) { 


        if($v["user_name"] == null || $v["user_name"] == ''  ){
                $user_name = '-';
        }
        else
        {
               $user_name = $v["user_name"];
        } 

        if($v["job_desc"]!=""){   
        $filename = str_replace("description/","",$v["job_desc"]);
    }else {
        $filename = "Not Available";
    }
        ?>
                                                    <tr>
                                                   <!--  <th><?php //echo $record_no;?></th> -->
                                                    <th><?php echo "JON-".$v["formID"];?></th>
                                                    <th><?php echo $v["position"];?></th>
                                                    <th><?php echo $v["job_type"];?></th>
                                <th><?php echo $v["date"];?></th>
                                                    <th><?= $v["company_name"];?></th>
                                                    <th><?php echo $v["keywords"];?></th>
                                                    <th><?= $user_name;?></th>


                                                    <th><a href="<?php echo base_url();?>job/ViewJob/<?php echo $v["formID"];?>">View</a></th>

                                                    <th>
<?php echo anchor( 'job/edit/'.$v["formID"]."/".$page_no,lang("EDIT"));?>

                                                    </th>
 <th>
<?php echo anchor( 'job/delete/'.$v["formID"]."/".$page_no."/".$filename,lang("DELETE"),array("onclick"=>" return delete_function()"));?>
   </th>
        
                                                </tr>

                                                <?php  $record_no++;}} ?>
  <?php if($msg_display1!="") {?>
           <tr>
            <td colspan="4" align="center" valign="middle" class="star"><?php echo $msg_display1;?></td>
            </tr>
        <?php } ?>                                                  

                                            </tbody>
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
        

       <script type="text/javascript">
        $('.default-date-picker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-150y',
            endDate: '+0d'
        });
        
        </script>


 <script type="text/javascript">
function delete_function()
{
    if(confirm('<?php echo lang("DELETE_MESSAGE"); ?>'))
        return true;
    else
        return false;
}
function addJob(paging)
{
   window.location="<?= base_url();?>job/add";
}
function Paging(paging)
{
  //  alert(paging);
   window.location="<?= base_url();?>job/change_paging/"+paging;
}

</script>
 