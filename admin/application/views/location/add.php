
       
     
		<style>
        	.jobf{
				width:60%!important;
				margin:1px auto;
				background-color: #ebebeb;
          /*      background-color: #FFE8D5;*/
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



       
          
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                   <span id="back"><a href="<?php echo base_url();?>location/index/nosearch"><< <?= lang("VIEW_LOCATION");?></a></span><br>
                                   
                                </header>

                                <div class="panel-body">
                                	<div class="jobf">
                <?php echo form_open('location/'.$action_page.'/'.$id);?>
                <?php echo form_hidden('flag', $flag);?>
                <?php echo form_hidden('id', $id);?>
                                   
                                    	
                                        <div class="col-lg-12">
                                            <label for="add" class="col-lg-11">Company&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                <select id="company_name" name="company_name" class="form-control m-bot15">
                                       <option value="">Select Company</option>
                                                    <?php foreach($company_list as $company):?>
                   <option value="<?= $company['company_name']; ?>" <?php echo ($company['company_name'] == $company_name) ? 'selected' : ''; ?>> <?= $company['company_name']; ?> </option>
               <?php endforeach; ?>
                 
                                                    </select>
                                            </div>
                                            <div class="col-lg-11">
                                                <?= form_error("company_name");?>
                                            </div>
                                        </div>

										
                                        <div class="col-lg-12">
                                            <label for="add" class="col-lg-11">Location Name&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                               <?php $data = array(
                                'name'        => 'location_name',
                                'id'          => 'location_name',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $location_name,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>
                                            </div>
                                            <div class="col-lg-11">
                                                <?= form_error("location_name");?>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Location Link</label>
                                            <div class="col-lg-11">
                                                <?php $data = array(
                                'name'        => 'location_link',
                                'id'          => 'location_link',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $location_link,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>
                                                
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Contact</label>
                                            <div class="col-lg-11">
                                                 <?php $data = array(
                                'name'        => 'contact',
                                'id'          => 'contact',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $contact,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>
                                                
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Title</label>
                                            <div class="col-lg-11">
                                                 <?php $data = array(
                                'name'        => 'title',
                                'id'          => 'title',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $title,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>
                                               
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Phone Number</label>
                                            <div class="col-lg-11">
 <?php $data = array(
                                'name'        => 'std',
                                'id'          => 'std',
                                'value'        => $std,
                                'class'    => 'form-control',
                                'style' => 'width:10%; float:left; padding: 2px !important;',
                                'maxlength' => '4',
                                
                    );
                    echo form_input($data);?>
                                                

                                                <label style="width:4%; float:left; text-align:center; padding-top:5px; box-shadow: none;"> - </label>
 <?php $data = array(
                                'name'        => 'phone',
                                'id'          => 'phone',
                                'value'        => $phone,
                                'class'    => 'form-control',
                                'style' => 'width:50%; float:left;',
                                'maxlength' => '10',
                                
                    );
                    echo form_input($data);?>
                                                

                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Email&nbsp;<span class="star">*</span></label>
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
                                            <div class="col-lg-11">
                                                <?= form_error("email");?>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Address</label>
                                            <div class="col-lg-11">
                                                <?php $data = array(
                                'name'        => 'address',
                                'id'          => 'address',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $address,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>
                                               
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">City</label>
                                            <div class="col-lg-11">
                                               <?php $data = array(
                                'name'        => 'city',
                                'id'          => 'city',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $city,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">State</label>
                                            <div class="col-lg-11">
                                           <?php $data = array(
                                'name'        => 'state',
                                'id'          => 'state',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $state,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>     
                                                
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11">Zip</label>
                                            <div class="col-lg-11">
                                                 
                                           <?php $data = array(
                                'name'        => 'zip',
                                'id'          => 'zip',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $zip,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>     
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn sh" style="background-color:#342f29; color:#FFF;margin-left: 3%; margin-top: 3%;">SUBMIT</button>
                                            </div>
                                        </div>
                                    </form>
                                    </div><!--jobf end-->
<div id="cta">

    <div class="col-lg-12"><a href="<?= base_url();?>company/add"><span class="btn location " id="add_forms" style="cursor: pointer; min-width:230px!important; padding:10px 40px!important; border-radius:none!important; margin-bottom:20px;" title="ADD COMPANY"><img src="<?= base_url();?>images/004-internet.png"><p style="padding-top:10px;">ADD COMPANY</p></span></a></div>

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
          
  
     