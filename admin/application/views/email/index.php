
		
        <section id="container">
           
            <section id="main-content"  >
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row" >
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back" class="redirect" title="Home"><a href="<?php echo base_url();?>home/index"><< Home</a></span>&nbsp;<br><br>
                                   
                                    <button class="btn sh" style="background-color:#342f29; color:#FFF" onclick="addTemplate();"><?= lang("ADD_TEMPLATE");?></button><br>
                                </header>
<?php echo form_open('email/index');?>
        <?php echo form_hidden('flag', "search");?>
                                <div class="panel-body form-horizontal">
                                	
                                        <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">Template Name</label>
                                            <div class="col-lg-2">

                                                <?php $data = array(
                        'name'        => 'txtkeyword',
                        'size'        => '25',
                        'value'     => @$_SESSION['sess_keyword'],
                        'class' => 'form-control'
                        
            );
            echo form_input($data);?>   

                                               
                                            </div>
                                            
                                        </div>



                                        <div class="form-group">
                                            <label class="col-lg-1 col-sm-2"></label>
                                            <div class="col-lg-8">

                                                <?php $data = array(
                        'name'        => 'mysubmit',
                        'type'  => 'submit',
                    'class' => 'btn sh',
                    'style' =>'background-color:#342f29; color:#FFF'
                        
            );
        echo form_submit($data,lang("SEARCH"));?>

                                            </div>
                                        </div>
                                </div>
                                <?php echo form_close();?>  <?php if($msg_display!="") {?>
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
<table align="right"><tr>
            <td width="2%" align="right" valign="middle">
            <?php 
             if($total_count>PER_PAGE_RECORDS)
            echo form_dropdown('paging', $paging_arr,@$_SESSION["sess_paging"],'id="paging" onchange="Paging(this.value)"');?>               
    </td></tr></table></div>

								<div><span id="tot">Total Records : <?= $total_count;?></span></div>                         


                                <div class="panel-body">
                                    <div class="adv-table"> <?php if($template_data){ ?>
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th><i class="fa fa-bookmark"></i> Template Name</th>
                                                   
                                                    <!--<th> View</th>-->
                                                    <th class='per'> Edit</th>
                                                    <th class="per"> Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="companies"> 
 <?php 
                                                if($nextrecord==NULL)
                $record_no=1;
            else
                $record_no=$nextrecord+1; 
                                               
foreach($template_data as $v) {  ?>
<tr>
<th><?php echo $record_no;?></th>
<th><?php echo $v["template_name"];?></th>
<th><?php echo anchor( 'email/edit/'.$v["id"]."/".$page_no,lang("EDIT"));?></th>
<th><?php echo anchor( 'email/delete/'.$v["id"]."/".$page_no,lang("DELETE"),array("onclick"=>" return delete_function()"));?></th>

</tr>

<?php  $record_no++;}
}?>

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
function delete_function()
{
    if(confirm('<?php echo lang("DELETE_MESSAGE"); ?>'))
        return true;
    else
        return false;
}
function Paging(paging)
{
   window.location="<?= base_url();?>email/change_paging/"+paging;
}  
function addTemplate()
{
   window.location="<?= base_url();?>email/add";
}    
</script>
 