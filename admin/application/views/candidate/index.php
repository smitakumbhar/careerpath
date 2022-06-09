
		
        <section id="container" class="">
          
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back"><a href="<?php echo base_url();?>home/index"><< Home</a></span>&nbsp;<br><br>
                                   
                                    <button class="btn sh" style="background-color:#342f29; color:#FFF" onclick="addCandidate();"><?= lang("ADD_CANDIDATE");?></button><br>
                                </header>
  <?php echo form_open('candidate/index');?>
        <?php echo form_hidden('flag', "search");?>


                                <div class="panel-body form-horizontal">
                                	
                                        <div class="form-group">
                                    <label class="col-lg-2">Candidate Email</label>
                                            <div class="col-lg-2">

                                                 <?php $data = array(
                                'name'        => 'txtkeyword',
                                'id'          => 'txtkeyword',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => @$_SESSION['sess_keyword'],
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>

                                              
                                            </div>
                                           
                                            <div class="col-lg-4">
                                                 <button type="submit" class="btn sh" style="background-color:#342f29; color:#FFF">Search</button>
                                            </div>
                                        </div>

                              
<?php echo form_close();?> 
<form method="post" name= "send_mail" action="<?php echo base_url();?>candidate/sendmail">                                        
                                     <table align="right">
                                            <tr><td><button type="submit" class="btn name_sendemailbtn" style="background-color:#342f29; color:#FFF" name="resumes_select" value="submit"><?= lang("SEND_EMAIL");?></button>
                                            </td></tr>
                                            </table>  
</form><br>  </div>
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
                                    <div class="adv-table"><?php if($candidate_data){ ?>
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th><i class="fa fa-bookmark"></i> Candidate Name</th>
                                                   <th><i class="fa fa-bookmark"></i> Candidate Email</th>
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

foreach($candidate_data as $v) {  ?>
<tr>
<th><?php echo $record_no;?></th>
<th><?php echo $v["first_name"]." ".$v["last_name"];?></th>
<th><?php echo $v["email"];?></th>
<th><a href="<?php echo base_url();?>candidate/edit/<?php echo $v["id"]."/".$page_no;?>">Edit</a></th>
<th><?php echo anchor( 'candidate/delete/'.$v["id"]."/".$page_no,lang("DELETE"),array("onclick"=>" return delete_function()"));?></th>

</tr>

<?php  $record_no++;}} ?>

  
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
 <script>
function delete_function()
{
    if(confirm('<?php echo lang("DELETE_MESSAGE"); ?>'))
        return true;
    else
        return false;
}
function Paging(paging)
{
   window.location="<?= base_url();?>candidate/change_paging/"+paging;
}
function addCandidate()
{
   window.location="<?= base_url();?>candidate/add";
}      
</script>
 