 <style>
            .jobf{
                width:60%!important;
                margin:1px auto;
                background-color: #ebebeb;
               /* background-color: #FFE8D5;*/
                padding-left:30px;
                padding-top:15px;
                padding-bottom:15px;
                padding-right:5px;
                border-radius:10px;
                float:left!important;
                /*box-shadow: 0 1px 5px rgba(0, 0, 0, 0.65);*/
            }
            .jobf label
            {
                font-size:15px;
                font-weight:600;
                margin-bottom:0;
                margin-top:0;
                padding-top:7px;
            }
            .jobf input[type="text"]
            {
               
                line-height: 30px;
                 -webkit-border-radius: 5px;
                border: 1px solid #eaeaea;
                box-shadow: none;
                font-size: 16px;

            }
           
            #main-content
            {
                    background-color: #FFFFFF;
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
                                    <span id="back"><a href="<?php echo base_url();?>job/job_order_book"><< Digital Job Order Book </a></span><br>
                                  
                                </header>

                                <div class="panel-body">
                                    <div class="jobf">
<?php echo form_open('job/share_book');?>
<?php echo form_hidden('flag', 'send');?>

 <div class="col-lg-12">
                                    <label for="cname" class="col-lg-11">Enter Email</label>
                                            <div class="col-lg-11">
                                                <?php $data = array(
                                'name'        => 'email[]',
                                'id'          => 'email[]',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'class'    => 'form-control-pass',
                                
                    );
                    echo form_input($data);?>
                                          

&nbsp;<i class="bi bi-plus-circle-fill" title="Add" id="Add" style="font-size: 20px;"></i> 
<i class="bi bi-dash-circle-fill" title="Remove" id="Remove" style="font-size: 20px;"
></i> </div>
                                           
</div>
        <div id="textboxDiv"></div><br><br>

          
         <div class="form-group">
                                            <div class="col-lg-10">
        <button class="btn sh" style="background-color:#342f29; color:#FFF;margin-left: 3%; margin-top: 3%;" type="submit" id="btn_send" onclick="return validate();"><?= lang("SEND_EMAIL")?></button></div></div>
       

<?php echo form_close(); ?>


                                </div><!--panel-body end-->

                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
            </section>
         
   
 


 <script type="text/javascript">  
        $(document).ready(function() {
            $("#Add").on("click", function() { 
                $("#textboxDiv").append("<div class='col-lg-12'><div class='col-lg-12'><br><input type='text' size = '40' maxlength = '100' class='form-control-pass' name='email[]' id='email[]'/><br></div></div>"); 
                return false; 
            });  
            $("#Remove").on("click", function() { 
                $("#textboxDiv").children().last().remove(); 
                return false;  
            });  
        });  


function validate(){
  //  var x = 0;
    var emailInput = document.getElementsByName('email[]');
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    for (i=0; i<emailInput.length; i++)
    {
        if (emailInput[i].value == "")
        {
             alert('Please Enter Email');
             var x = 1;
           return false;
        }
        if (emailInput[i].value != "")
        {
     
            if(emailInput[i].value.match(mailformat))
            {
               
                var x = 0; 
            }
            else
            {
               
                alert("You have entered an invalid email address!"); 
                 var x = 1; 
                 return false;   
            }

        }
    }

    if(x == 1)
        return false;
    
    else
        return true;

}
</script>  
