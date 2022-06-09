

            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                	<span id="back" class="redirect"><a href="<?php echo base_url();?>home/index"><< Home</a></span>&nbsp;<br><br>
                                    
                                    <button class="btn sh" style="background-color:#342f29; color:#FFF" onclick="addCompany();"><?= lang("ADD_COMPANIES");?></button><br>
                                </header>

 <?php echo form_open('company/index');?>
        <?php echo form_hidden('flag', "search");?>
 
                                <div class="panel-body form-horizontal">
                                    <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">From Date</label>
                                            <div class="col-lg-2">
                                                <input class="form-control form-control-inline input-medium default-date-picker"  size="16" type="text"name="fromdate" id="fromdate" value="<?= @$_SESSION['sess_fromdate']?>"  />
                                            </div>
                                            <label class="col-lg-3 col-sm-3" style="width:4%">To Date</label>
                                            <div class="col-lg-2">
                                            <input class="form-control form-control-inline input-medium default-date-picker1"  size="16" type="text" name="todate" id="todate" value="<?= @$_SESSION['sess_todate']?>"  />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">Company Name</label>
                                            <div class="col-lg-2">
                                                <input type="text" class="form-control" id="company_name" name="company_name" value="<?= @$_SESSION['sess_company']?>" >
                                            </div>
                                              
                                                <label class="col-lg-1 col-sm-2">Location </label>
                                            <div class="col-lg-2">
                                                <input type="text" class="form-control" id="location_name" name="location_name" value="<?= @$_SESSION['sess_location']?>">
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
<div align="center" ><table>
    <?php if($msg_display1!="") {?>
                                  
        <th>
        <?php echo $msg_display1;?>
        </th>
      <?php }?>
<?php if($msg_display!="") {?>
                                  
        <th>
        <?php echo $msg_display;?>
        </th>
      <?php }?>
       <?php if($msg_err_display!="") {?>
      <th>
        <?php echo $msg_err_display;?>
        </th>
      <?php }?></table></div>
							

        <?php if($company_data){?>                        <div class="panel-body">
                                    <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th><i class="fa fa-bookmark"></i> Company Name</th>
                                                    <th><i class="fa fa-bookmark"></i> City</th>
                                                     <th><i class="fa fa-bookmark"></i> Industry Name</th>
                                                    <th><i class="fa fa-bookmark"></i> Company Website</th>
                                                    <th><i class="fa fa-bookmark"></i> Service Agreement</th>
                                                    
                                                    <th class='per'> Edit</th>
                                                    <th class="per"> Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="companies">
<?php  $count= 1;
foreach($company_data as $v) {
    if($v["uploaded_files"]!=""){   
        $filename = str_replace("company_details/","",$v["uploaded_files"]);
    }else {
        $filename = "Not Available";
    }
   ?>
<tr>
<th><?php echo $count;?></th>
<th><?php echo $v["company_name"];?></th>
<th><?php echo $v["city"];?></td>
<th><?php echo $v["industry_name"];?></th>
<th><?php echo $v["website"];?></th>
<th><a href="<?php echo base_url();?><?php echo $v["uploaded_files"];?>" target="_blank"><?= $filename;?></a></th>
<th><a href="<?php echo base_url();?>company/edit/<?php echo $v["id"];?>">Edit</a></th>
<th>

<?php echo anchor( 'company/delete/'.$v["id"]."/".$page_no."/".$filename,lang("DELETE"),array("onclick"=>" return delete_function()"));?></th>

</tr>

<?php  $count++;} ?>
                                            </tbody>
                                          
                                        </table>
                                    </div><?php }else { ?>
                                    <div align="center" class="panel-body" style="font-weight:bold;">No Records Available</div><?php }?>
                                </dcompany_nameiv>
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
function addCompany()
{
   window.location="<?= base_url();?>company/add";
}
function delete_function()
{
    if(confirm('<?php echo lang("DELETE_MESSAGE"); ?>'))
        return true;
    else
        return false;
}

function Paging(paging)
{
   window.location="<?= base_url();?>company/change_paging/"+paging;
}

</script>