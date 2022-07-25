
             <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back" style="cursor:pointer" class="redirect" title="home.php"><< Home</span>&nbsp;<br>
                                   
                                </header>
 <?php echo form_open('search/folder_index');?>
        <?php echo form_hidden('flag', "search");?>

                <div class="panel-body form-horizontal">
                    <div class="form-group">
                        <label for="jobtype" class="col-lg-2">Enter Resume Keywords</label>
                            <div class="col-lg-3">
                                <input class="form-control"  size="16" id="txtkeyword" name="txtkeyword" value="<?php echo $txtkeyword;?>"/>
                            </div>

                        <div class="col-lg-4">
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
<div align="center" ><table> 
    
     <?php if($msg_display!="") {?>
    <th>
    <?php echo $msg_display;?>
    </th>
    <?php }?>
</table></div>
                                <div class="panel-body">
                                    <div class="adv-table"><?php if($resume_data){ ?>
                                    <table  class="display table table-bordered table-striped" id="F">
                                            <thead>
                                                <tr>
                                                      
                                                    <th>Sr No</th>
                                                  
                                                    <th>Upload Type</th>
                                                    <th><i class="fa fa-calendar"></i> Date</th>
                                                    <th><i class="fa fa-bookmark"></i> First Name</th>
                                                    <th><i class="fa fa-bookmark"></i> Last Name</th>
                                                   <th><i class="fa fa-bookmark"></i> Desk</th>
                                                    <th><i class="fa fa-bookmark"></i> Resume </th>
                                                    <th> Placed </th>
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
<th><?php echo $v["filename"];?></th>
<?php if($v["placed"] == 1){?>
   
    <th>Yes</th><?php }
        else{?>
    <th>No</th>
       <?php  }?>

<th><a href="<?= base_url().$v["filepath"];?>" target="_blank">View</a></th>
 <th><?php echo anchor( 'resume/edit/'.$v["id"]."/".$page_no,lang("EDIT"));?></th>
 <th><?php echo anchor( 'resume/delete/'.$v["id"]."/".$page_no."/".$v["filename"],lang("DELETE"),array("onclick"=>" return delete_function()"));?></th>
</tr>

<?php  $record_no++;} ?>
                                           </tbody>
                                        </table>
                                    <?php }?>
                                        </div>
                                       <table align="right"><tr><td width="88%" align="right" style="padding-right:6px;" valign="middle" >
            <?php if(@$_SESSION["sess_paging"]!="All")echo $pagination; ?></td>
            </tr></table>

                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
            </section>
          