
       
		<style  type="text/css">


    .cke_textarea_inline{
       border: 1px solid black;
    }
  
        	.jobf{
				width:60%!important;
				margin:1px auto;
			background-color: #ebebeb;
/*                  background-color: #9fe5ff;*/
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

                #cta{ width:35%!important;
                float:right!important;}

                .clear{clear:both;}

                .location{background-color: #1fbcd2; color:#ffffff;}

                .depart{background-color: #673fb4; color:#ffffff;}

                .indus{background-color: #673fb4; color:#ffffff;}


                @media only screen and (max-width: 480px) {
                    #cta{ width:90%!important;
                float:none!important;
                margin-top:30px; }
                .jobf{width:90%!important;
                    float:none!important;}
                }



        </style>

      
<script type="text/javascript" src="<?php echo base_url();?>ckeditor/ckeditor.js" ></script>
 <section id="container">
            
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back" class="redirect"><a href="<?php echo base_url();?>email/index/nosearch"><< View Email Templates</a></span><br>
                                </header>

                                <div class="panel-body">
                                	<div class="jobf">
                <?php echo form_open('email/'.$action_page.'/'.$template_id);?>
                <?php echo form_hidden('flag', $flag);?>
                <?php echo form_hidden('template_id', $template_id);?>

                                    
                                    	
                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"><?php echo lang('TEMPLATE_NAME');?>&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">

                                                <?php $data = array(
                                'name'        => 'template_name',
                                'id'          => 'template_name',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $template_name,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>

                                             
                                            </div>

                                            <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("template_name");?>
                                           
                                           
                                        </div>

                                            
                                            <label for="cname" class="col-lg-11"><?php echo lang('SUBJECT');?>&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">

                                                <?php $data = array(
                                'name'        => 'subject',
                                'id'          => 'subject',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $subject,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>

                                             
                                            </div>
                                           
                                       
                                            <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("subject");?>
                                            </div>
                                        </div>

                                       
 <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"><?php echo lang('TEMPLATE_DETAIL') ?>&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                    <?php $data = array(
                                'name'        => 'template_detail',
                                'id'          => 'template_detail',
                                'value'       =>$template_detail,
                                
                    );
                    echo form_textarea($data);?>
                     <script type="text/javascript">
            
CKEDITOR.replace('template_detail',{

  width: "450px",
  height: "200px"

}); 
        </script>      

                                           
                                           
                                        </div>
                                        
                                            <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("template_detail");?>
                                            </div>
                                      
<div class="form-group">
                                            <div class="col-lg-10">

                                            <div class="col-lg-10">
                                                <button type="submit" class="btn sh" style="background-color:#342f29; color:#FFF; margin-left: 3%; margin-top: 3%;" name="submit">SUBMIT</button>
                                            </div>
                    </div>
                                        </div>
                                  <?php echo form_close();?>    
                                    </div><!--jobf end-->

                                </div><!--panel-body end-->

                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
            </section>
</section>
      
    <script language="javascript">
function back_function(page_no)
{
    window.location="<?php echo base_url();?>/template_list";
}
</script>   
       
