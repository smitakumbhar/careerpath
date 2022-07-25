
       
		<style>
        	.jobf{
				width:60%!important;
				margin:1px auto;
				background-color: #ebebeb;
/*                background-color: #9fe5ff;*/
				padding-left:80px;
				padding-top:15px;
				padding-bottom:15px;
				padding-right:5px;
				border-radius:10px;
                float:left!important;
				/*box-shadow: 0 1px 5px rgba(0, 0, 0, 0.65);*/
			}
			.jobf label{
				font-size:15px;
				font-weight:600;
				margin-bottom:0;
				margin-top:0;
				padding-top:7px;
			}
			.jobf input[type="text"]{
				border:1px solid #ccc;
			}
			.jobf textarea{
				border:1px solid #ccc;
			}
			.jobf select{
				border:1px solid #ccc;
			}
                        #main-content{
                                background-color: #FFFFFF;
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
                }

               

        </style>


        <section id="container">
        
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back" class="redirect" title="Home"><a href="<?php echo base_url();?>home/index"><< <?= lang("HOME");?></a></span><br><br>
                                   
                                </header>
<div id="successdiv"> 
<?php if($this->session->flashdata('msg'))?>
   <table align="center">
        <th><?php echo $this->session->flashdata('msg'); ?></th></table>
</div>

 <?php  if($msg_display!="") {?>
                                    <div align="left" ><table>
        <th>
        <?php echo $msg_display;?>
        </th>
     
      </table></div> <?php }?>
      
                                <div class="panel-body">
                                	<div class="jobf">
                                   
                                        <?php echo form_open('job/job_order_book');?>
                                    	 <?php echo form_hidden('flag', $flag);?>
                                         <div class="col-lg-12">
<label for="cname" class="col-lg-11"><?php echo lang('JOB_ORDER_BOOK_TITLE');?></label>
                                            <div class="col-lg-11">

                                                <?php $data = array(
                                'name'        => 'book_title',
                                'id'          => 'book_title',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $book_title,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>

                                             
                                            </div>
                                               
                                           
                                            <label for="add" class="col-lg-11"><?= lang("INDUSTRY_NAME");?></label>
                                            <div class="col-lg-11">
                                                <select id="industry" name="industry" class="form-control m-bot15">
                                                 <option value="">Select Industry</option>
 <?php foreach($industry_list as $industry){
 ?>
                   <option value="<?= $industry['id']; ?>"> <?= $industry['industry_name']; ?> </option>
               <?php } ?>  
                                                    </select>
                                            </div>
                                           

                                         <label for="add" class="col-lg-11"><?= lang("JOB_TYPE");?></label>

                                        <div class="col-lg-11">
                                                <select id="job_type" name="job_type" class="form-control m-bot15">
                                                
 <?php 
foreach(JOB_TYPE_ARRAY as $key => $jobtype){ 
 ?>
                   <option value="<?= $key; ?>"><?= $jobtype; ?></option>
               <?php } ?>
                                                    </select>
                                            </div>
                                          

                                            <label for="cname" class="col-lg-11"><?php echo lang('KEYWORDS');?></label>
                                            <div class="col-lg-11">

                                                <?php $data = array(
                                'name'        => 'keywords',
                                'id'          => 'keywords',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $keywords,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>

                                             
                                            </div>


                                               
                                        <div class="form-group">
                                            <div class="col-lg-9">
                                                <button type="submit" class="btn sh" style="background-color:#342f29; color:#FFF; margin-left: 3%; margin-top: 3%;"><?= lang("CREATE_BOOK")?></button>
                                            </div>
                                        </div>
                                    </form>
                                    </div><!--jobf end-->




                                </div><!--panel-body end-->

                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
            </section>
           
        </section>
   <script> 
        setTimeout(function() {
            $('#successdiv').hide('fast');
        }, 5000);
    </script>