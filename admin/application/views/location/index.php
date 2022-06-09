
      
       
       
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                	<span id="back" class="redirect"><a href="<?php echo base_url();?>home/index"><< Home</a></span>&nbsp;<br><br>
                                   
                                     <button class="btn sh" style="background-color:#342f29; color:#FFF" onclick="addLocation();"><?= lang("ADD_LOCATION");?></button><br>
                                </header>
 <?php echo form_open('location/index');?>
        <?php echo form_hidden('flag', "search");?>
 
                                <div class="panel-body form-horizontal">
                                	 <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">Date</label>
                                            <div class="col-lg-2">
                                                <input type="date"  name="fromdate" id="fromdate" value="<?= @$_SESSION['sess_fromdate'];?>"  />
                                            </div>
                                            <label class="col-lg-1 col-sm-2" style="width:3%">To</label>
                                            <div class="col-lg-2">
                                            <input type="date" name="todate" id="todate" value="<?= @$_SESSION['sess_todate'];?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">Company Name</label>
                                            <div class="col-lg-2">
                                                <input type="text" class="form-control" id="company_name" name="company_name" value="<?= @$_SESSION['sess_company'];?>">
                                            </div>
                                              <!-- 25 may_______________________________ -->
                                                <label class="col-lg-1 col-sm-2">Location </label>
                                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="location_name" name="location_name" value="<?= @$_SESSION['sess_location'];?>" >
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
                                    <div class="adv-table"><?php if($location_data){ ?>
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th><i class="fa fa-bookmark"></i> Company Name</th>
                                                    <th><i class="fa fa-bookmark"></i> Location Name</th>
                                                    <th><i class="fa fa-bookmark"></i> Location Link</th>
                                                    <!--<th> View</th>-->
                                                    <th class='per'> Edit</th>
                                                    <th class="per"> Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="companies">

                                                <?php if($nextrecord==NULL)
                $record_no=1;
            else
                $record_no=$nextrecord+1; 
foreach($location_data as $v) {  ?>
<tr>
<th><?php echo $record_no;?></th>
<th><?php echo $v["company_name"];?></th>
<th><?php echo $v["location_name"];?></th>
<th><?php echo $v["location_link"];?></th>

<th><a href="<?php echo base_url();?>location/edit/<?php echo $v["id"]."/".$page_no;?>">Edit</a></th>
<th><?php echo anchor( 'location/delete/'.$v["id"]."/".$page_no,lang("DELETE"),array("onclick"=>" return delete_function()"));?></th>

</tr>

<?php  $record_no++;} }?>
    </tbody>
                                        </table>
                                    </div>
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
function addLocation()
{
   window.location="<?= base_url();?>location/add";
}
function delete_function()
{
    if(confirm('<?php echo lang("DELETE_MESSAGE"); ?>'))
        return true;
    else
        return false;
}
function Paging(paging)
{//alert(paging);
   window.location="<?= base_url();?>location/change_paging/"+paging;
}
        
</script>
    
