   
            <section id="main-content">
                <section class="wrapper">
                       <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back" style="cursor:pointer" class="redirect" title="Home"><a href="<?php echo base_url();?>home/index"><< Home</a></span>&nbsp;<br>
                                  
                                </header>
 <?php echo form_open('resume/index');?>
        <?php echo form_hidden('flag', "search");?>

                                <div class="panel-body form-horizontal">
                                	 <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">From Date</label>
                                            <div class="col-lg-2">
                                                <input type="date"name="fromdate" id="fromdate" value="<?= @$_SESSION['sess_fromdate']?>"  />
                                            </div>
                                            <label class="col-lg-3 col-sm-3" style="width:3%">To Date</label>
                                            <div class="col-lg-2">
                                            <input type="date" name="todate" id="todate" value="<?= @$_SESSION['sess_todate']?>"  />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="jobtype" class="col-lg-1 col-sm-2"> Resume Keywords</label>
                                            <div class="col-lg-2">
                                                <input class="form-control"  size="16" type="text" id="txtkeyword" name="txtkeyword" value="<?= @$_SESSION['sess_keyword']?>"/>
                                            </div>

                                            <label for="jobtype" class="col-lg-2 col-sm-2">Enter Name</label>
                                            <div class="col-lg-3">
                                                <input class="form-control"  size="16" type="text" id="firstname" name="firstname" value="<?= @$_SESSION['sess_name']?>"/>
                                            </div>
                                        </div>
                                       

                                </div>
                                <div class="panel-body form-horizontal">
                                    <div class="form-group">
                                           
                                            <label  for="jobtype"></label>
                                            <div class="col-lg-3">
                                                 <button type="submit" class="btn name_serachbutton" style="background-color:#342f29; color:#FFF">Search</button>
                                            </div>
                                        </div>
                                </div>
                                <?php echo form_close();?>
      
<form method="post" name= "bulk_download" action="<?php echo base_url();?>resume/bulk_download">
                                 
                                            <label class="col-lg-11 col-sm-2"></label>
                                            <div class="col-lg-8">
                                                 <button type="submit" class="btn name_bulkDowbutton" style="background-color:#342f29; color:#FFF" name="resumes_download" value="submit" onclick="return checkfile()" <?php if(empty($resume_data)){?> disabled <?php } ?>>Bulk Download</button>
                                            </div>
                               

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
                                    <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="F">
                                            <thead>
                                                <tr>
                                                      
                                                    <th>Sr No</th>
                                                   <th>Select &nbsp;&nbsp;<input type="checkbox" id="ckbCheckAll"/>
                                                    </th>
                                                    <th>Upload Type</th>
                                                    <th><i class="fa fa-calendar"></i> Date</th>
                                                    <th><i class="fa fa-bookmark"></i> First Name</th>
                                                    <th><i class="fa fa-bookmark"></i> Last Name</th>
<!--                                                    <th><i class="fa fa-bookmark"></i> Job Type</th>-->
                                                    <th><i class="fa fa-bookmark"></i> Desk</th>
                                                    <th><i class="fa fa-bookmark"></i> Resume </th>
                                                    <th> Placed </th>
                                                    <!-- <th> Preview</th> -->
													<th> View</th>
                                                    <th class="per"> Edit</th>
                                                    <th class="per"> Delete</th>
                                                </tr>
                                            </thead>
                                           
                                            <tbody id="resumes">
                                               <?php  if($nextrecord==NULL)
                $record_no=1;
            else
                $record_no=$nextrecord+1; 
foreach($resume_data as $v) {

  ?>
<tr>
<th><?php echo $record_no;?></th>
 <th><input type="checkbox" name="selectedResume[]" id ="selectedResume[]" class="selectedResume" value=<?= $v["filepath"]; ?>></th>
<th><?= $v["apply_from"];?></th>
<th><?= date("Y-m-d",strtotime($v["create_date"]));?></th>
<th><?= $v["firstname"];?></th>
<th><?= $v["lastname"];?></th>
<?php if($v["uploaded_admin"] == 0){?>
   
    <th><input type='button' class='addmydesk' rel = '" + obj.id + "' value='Add to my Desk' ></th><?php }
        else{?>
    <th>

        <?php $user = new UserModel();
           $user_name = $user->get_user_name($v["uploaded_admin"]);
        ?><?php echo $user_name["user_name"]?></th>
       <?php  }?>
 </th>
<th>
<?php     if($v["filepath"] != "")
    {
        if($v["apply_from"] == "M")
        {
            $filename = str_replace("resumes/","",$v["filepath"]);

        }elseif($v["apply_from"] == "B")
        {
            $filename = str_replace("bulkupload/","",$v["filepath"]);
        }
    }
    else
    {
        $filename = "Not Available";
    }

?>


    <?= $filename;?></th>
<?php if($v["placed"] == 1){?>
   
    <th>Yes</th><?php }
        else{?>
    <th>No</th>
       <?php  }?>

<th><a href="<?= base_url().$v["filepath"];?>" target="_blank">View</a></th>
 <th><?php echo anchor( 'resume/edit/'.$v["id"]."/".$page_no,lang("EDIT"));?></th>
 <th><?php echo anchor( 'resume/delete/'.$v["id"]."/".$page_no."/".$filename,lang("DELETE"),array("onclick"=>" return delete_function()"));?></th>
</tr>

<?php  $record_no++;} ?>
                                           </tbody>
                                        </table>
                                        </div>
                                      <?php if($msg_display1!="") {?>
            <table align="center" ><tr>
            <td colspan="4" align="center" valign="middle" ><?php echo $msg_display1;?></td>
            </tr></table>  
        <?php } ?>    
</form>
                                         <!-- Modal -- reset password -->
                                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Add To My Desk</h4>
                                            </div>
                                            <form name="changePwd" id="changePwd" class="cmxform form-horizontal tasi-form">
                                            <input type="hidden" id="desk_id" name="desk_id" value=""/>
                                                <div class="modal-body">
                                                    <label id="mb_lable">Have you interviewed this candidate?</label>
                                                </div>
                                    <div class="modal-footer">
                                    <button class="btn btn-success" type="button" id="yesb" name="yesb" onClick="yesAddmydesk();">Yes</button>
                                    <button class="btn btn-danger" type="button" id="nob" name="nob" onClick="doNotAddToDesk();">No</button>
                                    
                                     <button data-dismiss="modal" class="btn btn-default" type="button" id="okb" name="okb">Ok</button>
                                                                         </div>
                                            </form>
                                            <div id="newmessage">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal -- reset password -->
 <table align="right"><tr><td width="88%" align="right" style="padding-right:6px;" valign="middle" >
            <?php if(@$_SESSION["sess_paging"]!="All")echo $pagination; ?></td>
            </tr></table>
                                </div>


                            </section>
                        </div>

                    </div>
                     
                    <!-- page end-->
                </section>
            </section>
         
   
<script type="text/javascript">


    $("#ckbCheckAll").click(function(){ //alert("hii");
            $(".selectedResume").prop('checked',$(this).prop('checked'));
            

    });

    function checkfile()
    {
        var checked_list = $('[name="selectedResume[]"]:checked').length;
        if(checked_list == 0)
        {
            alert("Please Select File. ");
            return false;
        }else 
        {
                return true;
        }
    }
    
</script>
<script>
    $('.default-date-picker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-150y',
        endDate: '+0d'
    });
     $('.default-date-picker1').datepicker({
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

function Paging(paging)
{
    window.location="<?= base_url();?>resume/change_paging/"+paging;
}

</script>
