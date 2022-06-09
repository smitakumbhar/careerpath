<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Share Book</title>
 <script src="<?php echo base_url(); ?>js/jquery.min.js"></script> 
<style type="text/css">
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
        .btn{
            -webkit-border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 15px;
            background-color:#342f29;
            color: #FFF;
            height: 30px;
            width: 30%;

        }
        .valid_error{
            color: red;
        }
        
</style>

</head>
<body>
<?php echo form_open('job/share_book');?>
<?php echo form_hidden('flag', 'send');?>
    <label>Enter Email : </label>
    <input type="text" name="email[]" id="email[]" class="form-control-pass">

    <span class="valid_error"><?php echo form_error("email");?></span>
        <div id="textboxDiv"></div><br>
        <button id="Add">Add Email</button> 
        <button id="Remove">Remove Email</button>  <br><br>
    
        <div class="col-lg-9">
            <button class="btn" type="submit" id="btn_send" onclick="return validate();"><?= lang("SEND_EMAIL")?></button>
        </div>

<?php echo form_close(); ?>
 <script type="text/javascript">  
        $(document).ready(function() {
            $("#Add").on("click", function() { 
                $("#textboxDiv").append("<div><br><input type='text' class='form-control-pass' name='email[]' id='email[]'/><br></div>"); 
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
</body>
</html>