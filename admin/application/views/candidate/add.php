

       
		<style>
        	.jobf{
				width:60%!important;
				margin:1px auto;
				background-color: #ebebeb;
               /* background-color: #FFE8D5;*/
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
        <section id="container" class="">
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back"><a href="<?php echo base_url();?>candidate/index/nosearch"><< View Candidates</a></span><br>
                                  
                                </header>

                                <div class="panel-body">
                                	<div class="jobf">
            <?php echo form_open('candidate/'.$action_page.'/'.$id);?>
                <?php echo form_hidden('flag', $flag);?>
                <?php echo form_hidden('id', $id);?>
                                    
                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"><?= lang("FIRST_NAME");?>&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                <?php $data = array(
                                'name'        => 'first_name',
                                'id'          => 'first_name',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $first_name,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>
                                            </div>
                                           
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("first_name");?>
                                            </div>
                                           
                                        </div>

										
    
   <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"><?= lang("LAST_NAME");?>&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                <?php $data = array(
                                'name'        => 'last_name',
                                'id'          => 'last_name',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $last_name,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>
                                            </div>
                                           
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("last_name");?>
                                            </div>
                                           
                                        </div> <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"><?= lang("EMAIL_ID");?>&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                <?php $data = array(
                                'name'        => 'email',
                                'id'          => 'email',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $email,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>
                                            </div>
                                           
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("email");?>
                                            </div>
                                           
                                        </div> <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"><?= lang("MOBILE_NO");?>&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                <?php $data = array(
                                'name'        => 'mobile',
                                'id'          => 'mobile',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $mobile,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>
                                            </div>
                                           
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("mobile");?>
                                            </div>
                                           
                                        </div>
   
                                        <div class="form-group">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn sub" style="background-color:#342f29; color:#FFF; margin-left: 3%; margin-top: 3%;">SUBMIT</button>
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
 