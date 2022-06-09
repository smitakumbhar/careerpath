
        
		<style>
        	.jobf{
				width:50%;
				margin:1px auto;

			}
			.jobf label{
			/*	font-size:15px;
				font-weight:600;
				margin-bottom:0;
				margin-top:0;
				padding-top:7px; */
			}
			.jobf input[type="text"]{
			/*	border:1px solid #ccc;*/
			}
			.jobf textarea{
			/*	border:1px solid #ccc;*/
			}
			.jobf select{
			/*	border:1px solid #ccc;*/
			}
                        .btn.btn-success.fileinput-button {
                            background-color: #6dbb4a;
                            margin-left: 2.5%;
                            margin-top: 1%;
                        }
                          #addinputtag{
                         float:left;width:74%;
                         }
                         input[type=file] {
                            margin-top: 5px;
                            margin-bottom: 5px;
                         }
                         .form_control_input {
                            border: 1px solid #e2e2e4;
                            border: 1px solid #ccc;
                            box-shadow: none;
                            color: #c2c2c2;
                            color: #797979;
                        }
                        .form_control_input {
                            display: block;
                            width: 100%;
                            height: 34px;
                            padding: 6px 20px !important;
                            font-size: 14px;
                            line-height: 1.428571429;
                            color: #555;
                            background-color: #fff;
                            background-image: none;
                            border: 1px solid #ccc;
                            border-radius: 4px;
                            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                            -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                        }
        </style>
       

        <section id="container" class="">
           
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">

                                <div class="panel-body">
                                    <a href="<?= base_url();?>report/export_companylist" class="btn sh" style="background-color:#342f29; color:#FFF" id="export_report"><?= lang("EXPORT_COMPANY_LIST");?></a>
                                </div>
                               

                            </section>
                        </div>
                   <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
<?php echo form_open('report/cindex');?>
        <?php echo form_hidden('flag', "search");?>
                                <div class="panel-body form-horizontal">
                                    <div class="form-group" style="display:none;">
                                            <label class="col-lg-1 col-sm-2">Date</label>
                                            <div class="col-lg-2">
                                                <input class="form-control form-control-inline input-medium default-date-picker"  size="16" type="text" value="" name="datefrom" id="datefrom"  />
                                            </div>
                                            <label class="col-lg-1 col-sm-2" style="width:3%">To</label>
                                            <div class="col-lg-2">
                                            <input class="form-control form-control-inline input-medium default-date-picker"  size="16" type="text" value="" name="dateto" id="dateto"  />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                             <label class="col-lg-1 col-sm-2">Industry Name</label>
                                            <div class="col-lg-3">
                                                 <select id="industry_name" name="industry_name" class="form_control_input m-bot15">
                                                     <option value="">Select Industry</option>
 <?php foreach($industry_list as $industry):?>
                   <option value="<?= $industry['industry_name']; ?>" <?php echo (isset($_SESSION['sess_industry']) && $_SESSION['sess_industry'] == $industry['industry_name']) ? 'selected' : ''; ?> > <?= $industry['industry_name']; ?> </option>
               <?php endforeach; ?>
     
                                                 </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-1 col-sm-2">Company Name</label>
                                            <div class="col-lg-2">
                                                <input type="text" class="form_control_input" id="company_name" name="company_name" value="<?= $_SESSION['sess_keyword']?>" >
                                            </div>
                                              <!-- 25 may_______________________________ -->
                                                <label class="col-lg-1 col-sm-2">Location </label>
                                            <div class="col-lg-2">
                                                <input type="text" class="form_control_input" id="location_name" name="location_name" value="<?= $_SESSION['sess_location']?>" >
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


                                    
                                </div>

                                <div class="panel-body">
                                    <div class="adv-table"><?php if($company_data){ ?>
                                        <div id="recordcount"></div>
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No</th>
                                                    <th><i class="fa fa-bookmark"></i> Company Name</th>
                                                    <th><i class="fa fa-bookmark"></i> City</th>
                                                    <th><i class="fa fa-bookmark"></i> Industry Name</th>
                                                    <th><i class="fa fa-bookmark"></i> Company Website</th>
                                                    <th><i class="fa fa-bookmark"></i> Service Agreement</th>
                                                    <!--<th> View</th>-->
                                                </tr>
                                            </thead>
                                           <tbody>
                                                 <?php  if($nextrecord==NULL)
                $record_no=1;
            else
                $record_no=$nextrecord+1; 
foreach($company_data as $v) {

     ?>
<tr>
<th><?php echo $record_no;?></th>
<th><?php echo $v["company_name"];?></th>
<th><?php echo $v["city"];?></th>
<th><?php echo $v["industry_name"];?></th>
<th><?php echo $v["company_website"];?></th>
 <?php if($v["uploaded_files"] != "")
    {
        $filepath =  str_replace("company_details/","",$v["uploaded_files"]);
        ?>

        <th><a href="<?= base_url().$v["uploaded_files"]?>" target ="_blank"><?= $filepath;?></a></th>
    <?php }
    else
    {?>
        <th>Not Available</th>
  <?php  }?>

</tr>

<?php  $record_no++;}} ?>

                                               
                                            </tbody>
                                        </table>

                                     <?php if($msg_display1!="") {?>
            <table align="center" >
            <th colspan="4" align="center" valign="middle" ><?php echo $msg_display1;?></th>
            </table>  
        <?php } ?>                  
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

function Paging(paging)
{
   //alert("<?php echo base_url();?>report/change_paging/"+paging);
   window.location="<?= base_url();?>report/change_paging/"+paging;
}

</script>