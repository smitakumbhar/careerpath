   
            <section id="main-content">
                <section class="wrapper">
                       <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back" style="cursor:pointer" class="redirect" title="<?php echo base_url();?>dashboard"><< Home</span>&nbsp;<br>
                                    <span class="pagelbl">User Desk</span>
                                </header>
 <?php echo form_open('desk/mydesk');?>
        <?php echo form_hidden('flag', "search");?>

                                  <div class="panel-body form-horizontal">
                                     <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">From Date</label>
                                            <div class="col-lg-2">
                                                <input class="form-control form-control-inline input-medium default-date-picker"  size="16" type="date"name="fromdate" id="fromdate" value="<?= $_SESSION['sess_fromdate']?>"  />
                                            </div>
                                            <label class="col-lg-3 col-sm-3" style="width:3%">To Date</label>
                                            <div class="col-lg-2">
                                            <input class="form-control form-control-inline input-medium default-date-picker1"  size="16" type="date" name="todate" id="todate" value="<?= $_SESSION['sess_todate']?>"  />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="jobtype" class="col-lg-1 col-sm-2"> Resume Keywords</label>
                                            <div class="col-lg-2">
                                                <input class="form-control"  size="16" type="text" id="txtkeyword" name="txtkeyword" value="<?= $_SESSION['sess_keyword']?>"/>
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
                                </div>
<?php echo form_close(); ?>
      
                
                                           

                                <div class="panel-body">
<table align="right"><tr>
            <td width="2%" align="right" valign="middle">
            <?php 
             if($total_count>PER_PAGE_RECORDS)
            echo form_dropdown('paging', $paging_arr,@$_SESSION["sess_paging"],'id="paging" onchange="Paging(this.value)"');?>               
    </td></tr></table></div>  
<div><span id="tot">Total Records : <?= $total_count;?></span></div>                         
<div align="center" ><table> 
     <?php if($msg_display!="") {?>
    <th>
    <?php echo $msg_display;?>
    </th>
    <?php }?>
    <?php if($msg_err_display!="") {?>
    <th>
    <?php echo $msg_err_display;?>
    </th>
    <?php }?>
     <?php if($msg_display1!="") {?>
    <th>
    <?php echo $msg_display1;?>
    </th>
    <?php }?>
</table></div>

                                <div class="panel-body">
                                    <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="F">
                                            <thead>
                                                <tr>
                                                      
                                                    <tr>
                                                    <th>Sr No</th>
                                                    
                                                    <th><i class="fa fa-calendar"></i> Date</th>
                                                    <th><i class="fa fa-bookmark"></i> First Name</th>
                                                    <th><i class="fa fa-bookmark"></i> Last Name</th>
                                                    <th><i class="fa fa-bookmark"></i> Desk</th>
                                                    <th><i class="fa fa-bookmark"></i> Resume </th>
                                                    <th> Placed </th>
                                                    <th>View</th>
                                                     <th> Edit</th>
                                                    <th class="per"> Delete</th>
                                                    <th> Remove from Desk</th>
                                                </tr>
                                            </thead>
                                           
                                            <tbody>
                                               <?php  if($nextrecord==NULL)
                $record_no=1;
            else
                $record_no=$nextrecord+1; 
foreach($resume_data as $v) {

  ?>
<tr>
<th><?php echo $record_no;?></th>
 <th><?php echo date("Y-m-d",strtotime($v["create_date"]));?></th>
<th><?= $v["firstname"];?></th>
<th><?= $v["lastname"];?></th>
<th>Desk</th>
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
 <th>Remove My Desk</th>
</tr>

<?php  $record_no++;} ?>
                                           </tbody>
                                        </table>
                                        </div>
                                     
                                        
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
function delete_function()
{
    if(confirm('<?php echo lang("DELETE_MESSAGE"); ?>'))
        return true;
    else
        return false;
}

function Paging(paging)
{
    window.location="<?= base_url();?>desk/change_paging/"+paging;
}

</script>
