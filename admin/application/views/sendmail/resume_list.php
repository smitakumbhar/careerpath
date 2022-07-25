
            

            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back" style="cursor:pointer"><a href="<?php echo base_url();?>home/index"><< Home</a></span>&nbsp;<br>
                                    <span class="pagelbl">View Resumes</span><br>
                                </header>
 <?php echo form_open('email/resume_list');?>
        <?php echo form_hidden('flag', "search");?>

                                <div class="panel-body form-horizontal">
                                	 <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">Date From</label>
                                            <div class="col-lg-3">
                                            <input type="date" name="fromdate" id="fromdate" class="form-control" value="<?= @$_SESSION['sess_fromdate']?>"/>
                                            </div>
                                            <label class="col-lg-1 col-sm-2" style="width:3%">Date To</label>
                                            <div class="col-lg-3">
                                            <input type="date" name="todate" id="todate" class="form-control" value="<?= @$_SESSION['sess_todate']?>"  />
                                            </div>

              
                                        </div>
                                        
                                </div>
                                 
                                <div class="panel-body form-horizontal">
                                    <div class="form-group">
                                            <label for="jobtype" class="col-lg-1 col-sm-2">Enter Name</label>
                                            <div class="col-lg-3">
                                                <input class="form-control"  size="16" type="text" id="firstname" name="firstname" value="<?= @$_SESSION['sess_name']?>"/>
                                            </div>
                                              <label for="jobtype" class="col-lg-1 col-sm-2"> Resume Keywords</label>
                                            <div class="col-lg-2">
                                                 <input class="form-control"  size="16" type="text" id="txtkeyword" name="txtkeyword" value="<?= @$_SESSION['sess_keyword']?>"/>

                                            <label class="col-lg-1 col-sm-2"></label>
                                           
                                            </div>
                                            <label class="col-lg-1 col-sm-2"></label>
                                            <div class="col-lg-11">
                                                 <button type="submit" class="btn name_serachbutton" style="background-color:#342f29; color:#FFF">Search</button>
                                            </div>
                                        </div>
<?php echo form_close();?>
<form method="post" name= "send_mail" action="<?php echo base_url();?>email/sendmail">                                        
                                     <table align="right">
                                            <tr><td><button type="submit" class="btn name_sendemailbtn" style="background-color:#342f29; color:#FFF" name="resumes_select" onclick="return checkfile()"
                                             value="submit" <?php if(empty($resume_data)){?> disabled <?php } ?> ><?= lang("SEND_EMAIL");?></button>
                                            </td></tr>
                                            </table>  
                                       
                                </div>
  <div class="panel-body">
<table align="right"><tr>
            <td width="2%" align="right" valign="middle">
            <?php 
             if($total_count>PER_PAGE_RECORDS)
            echo form_dropdown('paging', $paging_arr,@$_SESSION["sess_paging"],'id="paging" onchange="Paging(this.value)"');?>               
    </td></tr></table></div>  
    
<div><span id="tot">Total Records : <?= $total_count;?></span></div>                            
                                 <?php if($resume_data){?>                        
                                        
                                <div class="panel-body">
                                    <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="F">
                                            <thead>
                                                <tr>
                                                      
                                                    <th>Sr No</th>
                                                   <th>Select &nbsp;&nbsp;<input type="checkbox" id="ckbCheckAll"/>
                                                    </th>
                                                    <th>Upload Type</th>
                                                    <th><i class="fa fa-calendar"></i> Date</th>
                                                    <th><i class="fa fa-bookmark"></i> Name</th>
                                                    <th><i class="fa fa-bookmark"></i> Contact Number</th>
                                                    <th><i class="fa fa-bookmark"></i> Email</th>

                                                    <th><i class="fa fa-bookmark"></i> Resume </th>
                                                    <th> Placed </th>
                                                   
													<th> View</th>
                                                   
                                                </tr>
                                            </thead>
                                           
                                            <tbody id="resumes">
                                               <?php     if($nextrecord==NULL)
                $record_no=1;
            else
                $record_no=$nextrecord+1; 
foreach($resume_data as $v) {

  ?>
<tr>
<th><?php echo $record_no;?></th>
 <th><input type="checkbox" name="selectedResume[]" id ="selectedResume[]" class="selectedResume" value=<?php echo $v["filename"]; ?>></th>
<th><?= $v["apply_from"];?></th>
<th><?= date("Y-m-d",strtotime($v["create_date"]));?></th>
<th><?= $v["firstname"]." ".$v["lastname"];?></th>
<th><?= $v["candidate_mobile_number"];?></th>
<th><?= $v["candidate_email"];?></th>

<th><?php echo $v["filename"];?></th>
<?php if($v["placed"] == 1){?>
   
    <th>Yes</th><?php }
        else{?>
    <th>No</th>
       <?php  }?>
<th>
<?php if($v["filepath"]!=""){?>
    <a href="<?= base_url().$v["filepath"];?>" target="_blank">View</a><?php }else{?>No Preview<?php }?></th>

</tr>

<?php  $record_no++;} ?>
                                           </tbody>
                                        </table>
                                        </div>
                                        <?php } ?>
</form>
                                    

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

        <script type="text/javascript">


            $("#ckbCheckAll").click(function(){ 
                    $(".selectedResume").prop('checked',$(this).prop('checked'));
                    

            });
            
            function checkfile()
            {
                var checked_list = $('[name="selectedResume[]"]:checked').length;
                //alert(checked_list);
                if(checked_list == 0){
                        alert("Please Select Candidate. ");
                        return false;
                }else if(checked_list > 12)
                    {
                        alert("Limit is 12 Only!! ");
                      //   $(".name_sendemailbtn").prop('disabled', true);
                        return false;
                    }else{

                     //   $(".name_sendemailbtn").prop('disabled', false);
                        return true;
                    }
                }
            
        </script>
<script type="text/javascript">
function Paging(paging)
{
   window.location="<?= base_url();?>email/change_paging_resume/"+paging;
}      
</script>
 
