   
            <section id="main-content">
                <section class="wrapper">
                       <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back" style="cursor:pointer" class="redirect" title="<?php echo base_url();?>dashboard"><< Home</span>&nbsp;<br>
                                    <span class="pagelbl">User Desk</span>
                                </header>
 <?php echo form_open('desk/userdesk');?>
        <?php echo form_hidden('flag', "search");?>

                                <div class="panel-body form-horizontal">

                                   <div class="form-group">
                                            <label for="usrDeskname" class="col-lg-10">Search User to View Desk</label>
                                            <div class="col-lg-4">
                                                <select id="user_id" name="user_id" class="form-control" >
                                                     <option value="">Select User</option>
 <?php foreach($user_arr as $user):?>
<option value="<?= $user['user_id']; ?>" <?php echo (isset($keyword) && $user['user_id'] == $keyword) ? 'selected' : ''; ?>> <?= $user['user_name']; ?> </option>
               <?php endforeach; ?>       

                                                    </select>

                                            </div>
                                            <div class="col-lg-4">
                                             <button type="submit" class="btn sh" style="background-color:#342f29; color:#FFF">Search</button>
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
<th><?php echo $v["firstname"];?></th>
<th><?= $v["lastname"];?></th>
<th>Desk</th>
<th><?php echo $v["filename"];?></th>

<?php if($v["placed"] == 1){?>
   
    <th>Yes</th><?php }
        else{?>
    <th>No</th>
       <?php  }?>

<th><a href="<?= base_url().$v["filepath"];?>" target="_blank">View</a></th>
 <th><?php echo anchor( 'resume/edit/'.$v["id"]."/".$page_no,lang("EDIT"));?></th>
 <th><?php echo anchor( 'resume/delete/'.$v["id"]."/".$page_no."/".$v["filename"],lang("DELETE"),array("onclick"=>" return delete_function()"));?></th>
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
    window.location="<?= base_url();?>desk/change_paging_user/"+paging;
}

</script>
