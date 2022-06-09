<style>
        	.jobf{
				width:60%!important;
				margin:1px auto;
				background-color: #ebebeb;
     /*           background-color: #FFE8D5;*/
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
                                    <span id="back"><a href="<?php echo base_url();?>company/index/nosearch"><< View Companies</a></span><br>
                                 
                                </header>

                                <div class="panel-body">
                                	<div class="jobf">

                <?php echo form_open_multipart('company/'.$action_page.'/'.$id);?>
                <?php echo form_hidden('flag', $flag);?>
                <?php echo form_hidden('id', $id);?>
                <?php echo form_hidden('old_file', $uploaded_files);?>

                                 
                                       
                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Company Name&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="company_name" name="company_name" value="<?= $company_name; ?>">
                                            </div>
                                           
                                        </div>


                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("company_name");?>
                                            </div>
                                           
                                        </div>

							
                                        <div class="col-lg-12">
                                            <label for="add" class="col-lg-11">Industry&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                <select id="industry_name" name="industry_name" class="form-control m-bot15">

                                                   
                                                 <option value="">Select Industry</option>
 <?php 
     
 foreach($industry_list as $industry):?>
                   <option value="<?= $industry['industry_name']; ?>" <?php echo ($industry['industry_name'] == $industry_name) ? 'selected' : ''; ?>> <?= $industry['industry_name']; ?> </option>
               <?php endforeach; ?>       
                                                    </select>
                                            </div>
                                           
                                        </div>

                                         <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("industry_name");?>
                                            </div>
                                           
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Website</label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="company_website" name="company_website" value="<?= $website; ?>" >
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Contact</label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="contact" name="contact" value="<?= $contact;?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Title</label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="title" name="title" value="<?= $title;?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Phone Number</label>
                                            <div class="col-lg-11">
                                                <input id="std" class="form-control" type="text" style="width:10%; float:left; padding: 2px !important;" maxlength="4" name="std" value="<?= $std;?>">
                                                <label style="width:4%; float:left; text-align:center; padding-top:5px; box-shadow: none;"> - </label>
                                                <input type="text" style="width:50%; float:left;" maxlength="10" name="phone" id="phone" class="form-control" value="<?= $phone;?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Email</label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="email" name="email" value="<?= $email;?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Address</label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="address" name="address" value="<?= $address;?>" >
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">City</label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="city" name="city" value="<?= $city;?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">State</label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="state" name="state" value="<?= $state;?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Zip</label>
                                            <div class="col-lg-11">
                                                <input type="text" class="form-control" id="zip" name="zip" value="<?= $zip;?>">
                                            </div>
                                        </div>


<?php if($uploaded_files!="")
{
    $filename= str_replace("company_details/","",$uploaded_files);

 }else{
     $filename = "File Not Available";
 }  ?>
                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Service Agreement </label>

                                            <div class="col-lg-11">
                                                <input type="file" name="service_agreement" id="service_agreement"  />
                                                        
                                       <div class="col-lg-10" id="addinput_proforma">

                                                       </div>
                                            </div>
                                        </div>
                                       <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"></label>

                                            <?php if($flag == 'es'){?>
                                            <div class="col-lg-11"><?= $filename;?></div>
                                        <?php }?>


                                        </div> 

                                        <div class="form-group">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn sh" style="background-color:#342f29; color:#FFF; margin-left: 3%; margin-top: 3%;" name="submit"><?= lang("SUBMIT");?></button>
                                            </div>
                                        </div>
                                   <?php echo form_close();?></form>
                                    </div><!--jobf end-->
<div id="cta">

    <div class="col-lg-12"><a href="<?= base_url();?>location/add"><span class="btn location " id="add_forms" style="cursor: pointer; min-width:230px!important; padding:10px 40px!important; border-radius:none!important; margin-bottom:20px;" title="ADD LOCATION"><img src="<?= base_url();?>images/004-internet.png"><p style="padding-top:10px;">ADD LOCATION</p></span></a></div>

    <div class="col-lg-12"><a href="<?= base_url();?>department/add"><span class="btn depart " id="add_forms" style="cursor: pointer; min-width:230px!important; padding:10px 40px!important; border-radius:none!important; margin-bottom:20px;" title="ADD DEPARTMENT"><img src="<?= base_url();?>images/003-cube.png"><p style="padding-top:10px;">ADD DEPARTMENT</p></span></a></div>

    <div class="col-lg-12"><a href="<?= base_url();?>industry/add"><span class="btn indus " id="add_forms" style="cursor: pointer; min-width:230px!important; padding:10px 40px!important; border-radius:none!important;" title="ADD INDUSTRY"><img src="<?= base_url();?>images/001-settings.png"><p style="padding-top:10px;">ADD INDUSTRY</p></span></a></div>      
      
</div><!--end of cta buttons-->



                                </div><!--panel-body end-->
                                                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
            </section>
           