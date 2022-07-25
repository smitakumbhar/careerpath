
       
		<style>
        	.jobf{
				width:60%!important;
				margin:1px auto;
/*				background-color: #ebebeb;*/
                background-color: #ebebeb;
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
                                    <span id="back" class="redirect"><a href="<?php echo base_url();?>candidate/index/nosearch"><< <?= lang("VIEW_CANDIDATES");?></a></span><br><br>
                                   
                                </header>

                                <div class="panel-body">
                                	<div class="jobf">
                                   
                                        <?php echo form_open('candidate/'.$action_page);?>
                                    	 <?php echo form_hidden('flag', $flag);?>
                                         <div class="col-lg-12">

                                        

                                            <label for="add" class="col-lg-11"><?= lang("TEMPLATE_NAME");?>&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                <select id="template_name" name="template_name" class="form-control m-bot15">
                                                 <option value="">Select Template</option>
 <?php foreach($template_list as $template):?>
<option value="<?= $template['id']; ?>" <?php echo (isset($_POST['template_name']) && $template['id'] == $_POST['template_name']) ? 'selected' : ''; ?>> <?= $template['template_name']; ?> </option>
               <?php endforeach; ?>       
                                                    </select>
                                            </div>
                                            <div class="col-lg-11">
                                            <?= form_error("template_name");?>
                                        </div>

                                         <label for="add" class="col-lg-11"><?= lang("CANDIDATE_LIST");?>&nbsp;<span class="star">*</span></label>

                                        <div class="col-lg-11">
                                                <select id="candidate" name="candidate" class="form-control m-bot15">
                                                 <option value="">Select Candidate</option>
 <?php foreach($candidate_list as $candidate)
 {?>
                   <option value="<?= $candidate['id']; ?>"> <?= $candidate['firstname']." ".$candidate['lastname']; ?> </option>
               <?php }?>       
                                                    </select>
                                            </div>
                                            <div class="col-lg-11">
                                            <?= form_error("candidate");?>
                                        </div>
   <label for="cname" class="col-lg-11"><?php echo lang('EMAIL_ID');?>&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">

                                                <?php $data = array(
                                'name'        => 'email',
                                'id'          => 'email',
                                'maxlength'   => '100',
                                'size'        => '40',
                               // 'value'        => $email,
                                'class'    => 'form-control',
                                'readonly' =>'readonly',
                                
                    );
                    echo form_input($data);?>
                                             
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
                                                 <div class="col-lg-11">
                                            <?= form_error("subject");?>
                                        </div>


                                            <label for="cname" class="col-lg-11"><?php echo lang('TEMPLATE_DETAIL') ?>&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                    <?php $data = array(
                                'name'        => 'template_detail',
                                'id'          => 'template_detail',
                                'value'       => $template_detail,
                                
                    );
                    echo form_textarea($data);?>


                     <script type="text/javascript">
            
CKEDITOR.replace('template_detail',{

  width: "450px",
  height: "200px"

}); 
        </script>      

                                            
                                        </div>

                                             </div>
                                                 <div class="col-lg-11">
                                            <?= form_error("template_deatil");?>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-9">
                                                <button type="submit" class="btn sub" style="background-color:#342f29; color:#FFF; margin-left: 3%; margin-top: 3%;"><?= lang("SEND_EMAIL")?></button>
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
  <script type="text/javascript">
    $('#template_name').change(display_data);
    
    $('#candidate').change(display_email);


     function display_email()
    { 
       // alert(document.getElementById("candidate").value);
        if(document.getElementById("candidate").value != '')
        {
            var id= document.getElementById("candidate").value;

            $.ajax({ 
                url: '<?php echo base_url();?>candidate/get_candidate',
                data: {id: id},
                type: 'post',
               // dataType: "json",
                success: function(output) {

                const obj = JSON.parse(output);

                document.getElementById("email").value =obj.email;
                }
            });
        }else{
             document.getElementById("email").value ="";
        }

      }
      function display_data()
      {
        var template_id= document.getElementById("template_name").value;

        $.ajax({ 
            url: '<?php echo base_url();?>email/get_template_data',
            data: {template_id: template_id},
            type: 'post',
           // dataType: "json",
            success: function(output) {

            const obj = JSON.parse(output);

            document.getElementById("subject").value =obj.subject;

            var editor = CKEDITOR.instances['template_detail'];
            editor.setData(obj.template_detail);

                  }
});

      }
  </script>