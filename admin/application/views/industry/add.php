

       
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

           

            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <span id="back"><a href="<?php echo base_url();?>industry/index/nsosearch"><< View Industries</a></span><br>
                                  
                                </header>

                                <div class="panel-body">
                                    <div class="jobf">
            <?php echo form_open('industry/'.$action_page.'/'.$id);?>
                <?php echo form_hidden('flag', $flag);?>
                <?php echo form_hidden('id', $id);?>
                                    
                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Industry Name&nbsp;<span class="star">*</label>
                                            <div class="col-lg-11">
                                                <?php $data = array(
                                'name'        => 'industry_name',
                                'id'          => 'industry_name',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $industry_name,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>
                                            </div>
                                           
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("industry_name");?>
                                            </div>
                                           
                                        </div>

                                        
    
    <br>
    <br>
   
                                        <div class="form-group">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn sh" style="background-color:#342f29; color:#FFF;margin-left: 3%; margin-top: 3%;"><?= lang("SUBMIT");?></button>
                                            </div>
                                        </div>
                                <?php echo form_close();?>
                                    </div><!--jobf end-->
<div id="cta">

    <div class="col-lg-12"><a href="<?= base_url();?>location/add"><span class="btn location " id="add_forms" style="cursor: pointer; min-width:230px!important; padding:10px 40px!important; border-radius:none!important; margin-bottom:20px;" title="ADD LOCATION"><img src="<?= base_url();?>images/004-internet.png"><p style="padding-top:10px;">ADD LOCATION</p></span></a></div>

    <div class="col-lg-12"><a href="<?= base_url();?>department/add"><span class="btn depart " id="add_forms" style="cursor: pointer; min-width:230px!important; padding:10px 40px!important; border-radius:none!important; margin-bottom:20px;" title="ADD DEPARTMENT"><img src="<?= base_url();?>images/003-cube.png"><p style="padding-top:10px;">ADD DEPARTMENT</p></span></a></div>

    <div class="col-lg-12"><a href="<?= base_url();?>company/add"><span class="btn indus " id="add_forms" style="cursor: pointer; min-width:230px!important; padding:10px 40px!important; border-radius:none!important;" title="ADD COMPANY"><img src="<?= base_url();?>images/001-settings.png"><p style="padding-top:10px;">ADD COMPANY</p></span></a></div>      
      
</div><!--end of cta buttons-->


 


                                </div><!--panel-body end-->

                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
            </section>
         
   
 