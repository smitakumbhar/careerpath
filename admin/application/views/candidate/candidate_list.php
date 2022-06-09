
		
        <section id="container" class="">
          
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                	<span id="back" class="redirect" title="<?php echo base_url();?>dashboard"><< Home</span>&nbsp;<br>
                                    <span class="pagelbl"><?= lang("CANDIDATE_LIST");?></span><br><br>
                                  
                                </header>
  <?php echo form_open('candidate/view_candidates');?>
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
<form method="post" name= "send_mail" action="<?php echo base_url();?>candidate/send_bulkmail">                                        
                                     <table align="right">
                                            <tr><td><button type="submit" class="btn name_sendemailbtn" style="background-color:#342f29; color:#FFF" name="resumes_select" value="submit" onclick="return checkfile()"><?= lang("SEND_BULK_EMAIL");?></button>
                                            </td></tr>
                                            </table>  
<br>  </div>
<div class="panel-body">
<table align="right"><tr>
            <td width="2%" align="right" valign="middle">
            <?php 
             if($total_count>PER_PAGE_RECORDS)
            echo form_dropdown('paging', $paging_arr,@$_SESSION["sess_paging"],'id="paging" onchange="Paging(this.value)"');?>               
    </td></tr></table></div>
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
								<div><span id="tot">Total Records : <?= $total_count;?></span></div>                         


                                <div class="panel-body">
                                    <div class="adv-table"><?php if($candidate_data){ ?>
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Select &nbsp;&nbsp;<input type="checkbox" id="ckbCheckAll"/>
                                                    </th>
                                                    <th><i class="fa fa-bookmark"></i> First Name</th>
                                                     <th><i class="fa fa-bookmark"></i> Last Name</th>
                                                   <th><i class="fa fa-bookmark"></i> Email</th>
                                                    
                                                    <th class='per'> Mobile No</th>
                                                   
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
<th><input type="checkbox" name="selectedCandidate[]" id ="selectedCandidate[]" class="selectedCandidate" value=<?= $v["email"]; ?>></th>
<th><?php echo $v["first_name"];?></th>
<th><?php echo $v["last_name"];?></th>
<th><?php echo $v["email"];?></th>
<th><?php echo $v["mobile"];?></th>

</tr>

<?php  $record_no++;}} ?>

  
 </tbody>
                                            
                                        </table>
                                       
                                    </div>
                                </dcompany_nameiv>
                            </section>
                        </div>
                    </div></form>
                      <table align="right"><tr><td width="88%" align="right" style="padding-right:6px;" valign="middle" >
            <?php if(@$_SESSION["sess_paging"]!="All" )echo $pagination; ?></td>
            </tr></table>
                    <!-- page end-->
                </section>
            </section>
          
        </section>

<script>


            $("#ckbCheckAll").click(function(){ //alert("hii");
                    $(".selectedCandidate").prop('checked',$(this).prop('checked'));
              });
            
            function checkfile()
            {
                var checked_list = $('[name="selectedCandidate[]"]:checked').length;
                //alert(checked_list);
                if(checked_list == 0){
                        alert("Please Select Candidate. ");
                        return false;
                }else if(checked_list > 10)
                    {
                        alert("Limit is 10 Only!! ");
                        return false;
                    }else{
                        return true;
                    }
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
   window.location="<?= base_url();?>candidate/change_paging_mail/"+paging;
}
        
</script>
 