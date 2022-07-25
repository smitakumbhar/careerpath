
            
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back" class="redirect" title="Home"><a href="<?php echo base_url();?>home/index"><< <?= lang("HOME");?></a></span>&nbsp;<br><br>
                                  
                                    <button class="btn sh" style="background-color:#342f29; color:#FFF"  onclick="addUser();"><?= lang("ADD_USER");?></button><br>
                                </header>
<?php echo form_open('user/index');?>
        <?php echo form_hidden('flag', "search");?>


                                <div class="panel-body form-horizontal">
                                    
                                        <div class="form-group">
                                    <label class="col-lg-2">User Name</label>
                                            <div class="col-lg-2">
                                                <input type="text" class="form-control" id="txtkeyword" name="txtkeyword" value="<?= @$_SESSION['sess_keyword']?>">
                                            </div>
                                           
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
 <?php if($msg_display!="") {?>
                                    <div align="center" ><table>
        <th>
        <?php echo $msg_display;?>
        </th>
      <?php }?>
       <?php if($msg_err_display!="") {?>
      <th>
        <?php echo $msg_err_display;?>
        </th></table></div>
      <?php }?>


                                <div class="panel-body">
                                    <div class="adv-table"><?php if($users_data){ ?>
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th><?= lang("SR_NO");?></th>
                                                    <th><?= lang("NAME");?></th>
                                                    <th><?= lang("EMAIL");?></th>
                                                    <th><?= lang("EDIT");?></th>
                                                    <th><?= lang("DELETE");?></th>
                                                    <th><?= lang("APPROVE_USER");?></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            
                                                <?php if($nextrecord==NULL)
                $record_no=1;
            else
                $record_no=$nextrecord+1; 
                                                foreach($users_data as $v) {  ?>
                                                    <tr>
                                                    <th><?php echo $record_no;?></th>
                                                    <th><?php echo $v["user_name"];?></th>
                                                    <th><?php echo $v["user_email"];?></th>
                                                    <th><?php echo anchor( 'rights/edit/'.$v["user_id"]."/".$page_no,lang("EDIT"));?>
                                                   </th>
                                                    <th><?php echo anchor( 'user/delete/'.$v["user_id"]."/".$page_no,lang("DELETE"),array("onclick"=>" return delete_function()"));?>
                                                   </th>
                <?php  

                $status = ($v['admin_approval'] == 1)? 'checked': '';
                if ($v["admin_approval"] == 1) {
                     $active_class = "switch-on";
                } else {
                   $active_class = "switch-off";
                }?>
                            <th>
                           <div class="switch has-switch">
                    <div class="switch-animate <?php echo $active_class;?>" rel ="<?php echo $v["user_id"];?>">
                    <input type="checkbox" data-toggle="switch" checked=<?php echo $status;?>>
                    <span class="switch-left"><?= lang("YES");?></span>
                    <label> </label><span class="switch-right"><?= lang("NO");?></span></div></div></th>
                                                </tr>

                                                <?php   $record_no++;}} ?>
                                                
                                                
                                           </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                              <table align="right"><tr><td width="88%" align="right" style="padding-right:6px;" valign="middle" >
            <?php if(@$_SESSION["sess_paging"]!="All" )echo $pagination; ?></td>
            </tr></table>
                        </div>
                    </div>
                   
                    <!-- page end-->
                </section>
            </section>
<script type="text/javascript">
function addUser()
{
   window.location="<?= base_url();?>rights/add/";
}

function Paging(paging)
{
   window.location="<?= base_url();?>user/change_paging/"+paging;
}

function delete_function()
{
    if(confirm('<?php echo lang("DELETE_MESSAGE"); ?>'))
        return true;
    else
        return false;
}
        
</script>

       <script type="text/javascript">
  $("body").on("click",".switch-animate",function(){//alert("hii");
  
    var new_active;

    $(this).toggleClass("switch-off switch-on");
    if ($(this).hasClass("switch-off"))
    {
        new_active = 0;
    
    } else {
        if ($(this).hasClass("switch-on")) 
        {
            new_active = 1;
        }
    }

    $.post('<?=base_url("user/change_status")?>',
    {

      user_id : $(this).attr('rel'),
      admin_approval : new_active
    },
    function(data){ //alert(data);
     //$.notify("Status Changed Successfully", "success");
    });
  });
</script>

