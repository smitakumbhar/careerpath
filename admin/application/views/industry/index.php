
		
        <section id="container" class="">
          
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                	<span id="back" class="redirect"><a href="<?php echo base_url();?>home/index"><< Home</a></span>&nbsp;<br><br>

                                    <button class="btn sh" style="background-color:#342f29; color:#FFF" onclick="addIndustry();"><?= lang("ADD_INDUSTRY");?></button><br>
                                </header>
  <?php echo form_open('industry/index');?>
        <?php echo form_hidden('flag', "search");?>


                                <div class="panel-body form-horizontal">
                                	
                                        <div class="form-group">
                                    <label class="col-lg-2">Industry Name</label>
                                            <div class="col-lg-2">
                                                <input type="text" class="form-control" id="txtkeyword" name="txtkeyword" value="<?= @$_SESSION["sess_keyword"];?>">
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
        </th> <?php }?>
    </table></div>                        


                                <div class="panel-body">
                                    <div class="adv-table"><?php if($industry_data){ ?>
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th><i class="fa fa-bookmark"></i> Industry Name</th>
                                                   
                                                    <!--<th> View</th>-->
                                                    <th class='per'> Edit</th>
                                                    <th class="per"> Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="companies">

                                           
                                               <?php  if($nextrecord==NULL)
                $record_no=1;
            else
                $record_no=$nextrecord+1; 
foreach($industry_data as $v) {  ?>
<tr>
<th><?php echo $record_no;?></th>
<th><?php echo $v["industry_name"];?></th>
<th><a href="<?php echo base_url();?>industry/edit/<?php echo $v["id"]."/".$page_no;?>">Edit</a></th>
<th><?php echo anchor( 'industry/delete/'.$v["id"]."/".$page_no,lang("DELETE"),array("onclick"=>" return delete_function()"));?></th>

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
                                </dcompany_nameiv>
                            </section>
                            <table align="right"><tr><td width="88%" align="right" style="padding-right:6px;" valign="middle" >
            <?php if(@$_SESSION["sess_paging"]!="All" )echo $pagination; ?></td>
            </tr></table>
                        </div>
                    </div>
                    
                    <!-- page end-->
                </section>
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
   window.location="<?= base_url();?>industry/change_paging/"+paging;
}
function addIndustry(paging)
{
   window.location="<?= base_url();?>industry/add";
}   
</script>
 