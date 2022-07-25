
<body class="login-body">
    <div class="container">
    <h2 class="form-signin-heading"><center><img src="<?php echo base_url();?>images/logo.png" width="30%" /></center></h2>

        <?php echo form_open('home/change_password',array('class' => 'form-signin'));?>
                <?php echo form_hidden('flag', 'changepass');?>

    <div class="login-wrap">

    <?php $data = array(
        'name'        => 'user_password',
        'id'          => 'user_password',
        'class'        => 'form-control',
        'type'        => 'password',
        'value'        => $user_password,
        'placeholder'  => "Create Password",
    );
    echo form_input($data);
    ?>  <?php echo form_error('user_password'); ?>
    <br />

    <?php $data = array(
        'name'        => 'user_rpassword',
        'id'          => 'user_rpassword',
        'maxlength'   => '20',
        'size' =>'28',
        'type'        => 'password',
        'class'        => 'form-control-pass',
        'value'        => $user_rpassword,
        'placeholder'  => "Reenter Password",
    );
    echo form_input($data);
    ?><i class="bi bi-eye-slash" style="margin-bottom: -30px; cursor: pointer;" id="togglePassword"></i>
    <?php echo form_error('user_rpassword'); ?>
    <br>

    <button class="btn btn-lg btn-login btn-block" type="submit" name="signin">Change Password</button>
    </div> 
    </form>
    </div>

<script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#user_rpassword");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });
</script>
</body>


