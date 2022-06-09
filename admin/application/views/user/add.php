
       
        <style  type="text/css">


    .cke_textarea_inline{
       border: 1px solid black;
    }
  
            .jobf{
                width:60%!important;
                margin:1px auto;
              background-color: #ebebeb;
 /*               background-color: #9fe5ff;*/
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

            .form-control-pass
            {

            width: 90%;
            line-height: 30px;
            position: relative;
            margin-bottom: 15px;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            border: 1px solid #ccc;
            box-shadow: none;

                    
               
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
            <span id="back" class="redirect" title="View Users"><a href="<?php echo base_url();?>user/index/nosearch"><< View Users</a></span><br>
                                   
                                </header>
                                <div class="panel-body">
                                    
                <?php echo form_open('user/'.$action_page.'/'.$user_id);?>
                <?php echo form_hidden('flag', $flag);?>
                <?php echo form_hidden('user_id', $user_id);?>

<div class="jobf">
      <div class="col-lg-12">
                                            <label for="cname" class="col-lg-11"><?php echo lang('USER_NAME');?>&nbsp;<span class="star">*</span></label>
                                            <div class="col-lg-11">

                                                <?php $data = array(
                                'name'        => 'user_name',
                                'id'          => 'user_name',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $user_name,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?>

                                             
                                            </div>

                                            <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("user_name");?>
                                            </div>

                                            <label for="cname" class="col-lg-11">User Type<span class="star">*</span></label>
                                            <div class="col-lg-11">
    <select id="usertype" name="user_type" class="form-control m-bot15" style="size:40px">
           <?php 
                foreach(USER_TYPE_ARRAY as $key => $value){ 
                 ?>
                   <option value="<?= $key; ?>" 
                    <?php echo ($value == $user_type) ? 'selected' : ''; ?>><?= $value; ?></option>
               <?php } ?>

    </select>
                                                </div>

                                            <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("user_type");?>
                                            </div>
       
                                        

                                        <?php if($flag == "es"){ ?>

                                 <label for="cname" class="col-lg-11">Email<span class="star">*</span></label>
                                 <div class="col-lg-11">
                                                <?php 
                                                
                                $data = array(
                                'name'        => 'user_email',
                                'id'          => 'user_email',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $user_email,
                                'class'    => 'form-control',
                                'readonly' =>'readonly'
                               
                                
                                
                    );
                    echo form_input($data);?>
                                                
                                            </div>

<?php }else{?>
                                            <label for="cname" class="col-lg-11">Email<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                <?php 
                                                
                                $data = array(
                                'name'        => 'user_email',
                                'id'          => 'user_email',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $user_email,
                                'class'    => 'form-control',
                              
                                
                                
                    );
                    echo form_input($data);?>
                                                
                                            </div>

                                     <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("user_email");?>
                                            </div>
                                <?php }?>
                                <?php if($flag == "es"){?>
<label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
    <input type="checkbox" name="changepass" id="changepass" onclick="showDiv()">&nbsp;Change Password
         </div>     <?php }?>                         
                                        <br><br>      
<div id="show_password" <?php if($flag == "es"){?> style="display:none" <?php }?>>
                                            <label for="cname" class="col-lg-11">Password<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                 <?php $data = array(
                                'name'        => 'user_password',
                                'id'          => 'user_password',
                                'type'    =>'password',
                                'maxlength'   => '100',                                'class'    => 'form-control-pass',
                                
                    );
                    echo form_input($data);?><i class="bi bi-eye-slash" style="margin-bottom: -30px; cursor: pointer;" id="togglePassword"></i>
                                                
                                            </div>
                                       <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("user_password");?>
                                            </div>
                                             <label for="cname" class="col-lg-11">Reenter Password<span class="star">*</span></label>
                                            <div class="col-lg-11">
                                                 <?php $data = array(
                                'name'        => 'user_rpassword',
                                'id'          => 'user_rpassword',
                                'type'    =>'password',
                                'maxlength'   => '100',
                                
                                'class'    => 'form-control-pass',
                                
                    );
                    echo form_input($data);?>
                                                
                                            </div>
                                       <label for="cname" class="col-lg-11"></label>
                                            <div class="col-lg-11">
                                                <?= form_error("user_rpassword");?>
                                            </div>
</div>                                    
<div style="margin-top: 7px;" id="CheckPasswordMatch"></div> 
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button type="submit" class="btn name_bulkDowbutton" style="background-color:#342f29; color:#FFF" name="submit">Submit</button>
                                            </div>
                                        </div>

</div>
                                    </form>
                                </div>

                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
<script type="text/javascript">
function showDiv()
{ 
       if($("#changepass").prop('checked') == true)
       {
            $("#show_password").css("display","block");
            $('#user_password').prop('required',true);
            $('#user_rpassword').prop('required',true);
        }else
        {
            $("#show_password").css("display","none");
            $('#user_password').prop('required',false);
            $('#user_rpassword').prop('required',false);
        }
}
</script>

<script>
    $(document).ready(function() {
      $("#user_rpassword").on('keyup', function() {
        var password = $("#user_password").val();
        var confirmPassword = $("#user_rpassword").val();
        if (password != confirmPassword)
          $("#CheckPasswordMatch").html("Password does not match !").css("color", "red");
        else
          $("#CheckPasswordMatch").html("Password match !").css("color", "green");
      });
    });
  </script>

<script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#user_password");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });
</script>