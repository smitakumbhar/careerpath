
<body class="login-body">
    <div class="container">
    <h2 class="form-signin-heading"><center><img src="<?php echo base_url();?>images/logo.png" width="30%" /></center></h2>

    <form class="form-signin" action="<?php echo base_url();?>/login/index" method="post">
    <?php echo form_hidden('flag', "login");?>
    <div class="login-wrap">

    <?php $data = array(
        'name'        => 'user_email',
        'id'          => 'user_email',
        'class'        => 'form-control',
        'value'        => set_value('user_email' , $user_email),
        'placeholder'  => "Email",
    );
    echo form_input($data);
    ?>  <?php echo form_error('user_email'); ?>
    <br />

    <?php $data = array(
        'name'        => 'user_password',
        'id'          => 'user_password',
        'maxlength'   => '20',
        'size' =>'28',
        'type'        => 'password',
        'class'        => 'form-control-pass',
        'value'        => set_value('user_password' , $user_password),
        'placeholder'  => "Password",
    );
    echo form_input($data);
    ?><i class="bi bi-eye-slash" style="margin-bottom: -30px; cursor: pointer;" id="togglePassword"></i>
    <?php echo form_error('user_password'); ?>
    <br>

    <button class="btn btn-lg btn-login btn-block" type="submit" name="signin">Sign in</button> <?php if($login_failed!="") {?>
    <div class="formtxt star" align="center" id="valid_error"><?php echo $login_failed?></div>
    <?php }?>
    </div> 
    </form>
    </div>
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
</body>


