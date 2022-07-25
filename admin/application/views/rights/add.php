<style  type="text/css">
.jobf
{
	width:100%!important;
	margin:1px auto;
	background-color: #ebebeb;
	padding-left:0px;
	float:left!important;
}
.jobf label
{
	font-size:15px;
	font-weight:600;
	margin-bottom:0;
	margin-top:0;
	padding-top:7px;
}

.form-control-pass
{
	width: 70%;
	line-height: 30px;
	position: relative;
	margin-bottom: 15px;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	border: 1px solid #ccc;
	box-shadow: none;        
}
</style>
        
            <section id="main-content">

                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
            <span id="back" class="redirect" title="View Users"><a href="<?php echo base_url();?>user/index/nosearch"><< View Users</a></span>
                                   
                                </header>
                                <div class="panel-body">
                                    
                <?php echo form_open('rights/'.$action_page.'/'.$user_id);?>
                <?php echo form_hidden('flag', $flag);?>
                <?php echo form_hidden('user_id', $user_id);?>

<div class="jobf">
	
      <div class="col-lg-5">
                                            <label for="cname" class="col-lg-9"><?php echo lang('USER_NAME');?>&nbsp;<span class="star">*</span></label>
                                           
<div class="col-lg-12">
                                                <?php $data = array(
                                'name'        => 'user_name',
                                'id'          => 'user_name',
                                'maxlength'   => '100',
                                'size'        => '20',
                                'value'        => $user_name,
                                'class'    => 'form-control',
                                
                    );
                    echo form_input($data);?></div>
</div>



<div class="col-lg-7">
                                        <label for="cname" class="col-lg-9">User Type<span class="star">*</span></label>
                                            <div class="col-lg-9">
    <select id="user_type" name="user_type" class="form-control m-bot15">
           <?php 
                foreach(USER_TYPE_ARRAY as $key => $value){ 
                 ?>
                   <option value="<?= $key; ?>" 
                    <?php echo ($value == $user_type) ? 'selected' : ''; ?>><?= $value; ?></option>
               <?php } ?>

    </select>
                                            </div>


                                        </div>

<?php if(form_error("user_name") || form_error("user_type")){?>
<div class="col-lg-5">
<span class="col-lg-11"><?php echo form_error("user_name") ? form_error("user_name"): "&nbsp;";?>
</span>
</div>

<div class="col-lg-5">
<span class="col-lg-11">
	<?php echo form_error("user_type") ? form_error("user_type"): "&nbsp;";?>
</span>
</div>
<?php }?>
                                          <div class="col-lg-5">
                                            <label for="cname" class="col-lg-11"><?php echo lang('EMAIL');?>&nbsp;<span class="star">*</span></label>
                                           
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
                    echo form_input($data);?></div>
</div>
<div class="col-lg-5">
                                            <label for="cname" class="col-lg-11"><?php echo lang('USER_PHONE_NUMBER');?>&nbsp;<span class="star">*</span></label>
                                           
<div class="col-lg-12">
                                              <?php 
                                                
                                $data = array(
                                'name'        => 'user_phone_number',
                                'id'          => 'user_phone_number',
                                'maxlength'   => '100',
                                'size'        => '40',
                                'value'        => $user_phone_number,
                                'class'    => 'form-control',
);
                    echo form_input($data);?></div>
</div>


<?php if(form_error("user_email") || form_error("user_phone_number")){?>
<div class="col-lg-5">
<span class="col-lg-11"><?php echo form_error("user_email") ? form_error("user_email"): "&nbsp;";?>
</span>
</div>

<div class="col-lg-5">
<span class="col-lg-11"><?php echo form_error("user_phone_number") ? form_error("user_phone_number"): "&nbsp;";?>
</span>
</div>
<?php }?>

 <div class="col-lg-5">
                                            <label for="cname" class="col-lg-11">User Status&nbsp;<span class="star">*</span></label>
                                           
	
                                        <label for="cname" class="col-lg-9"><span>
  <?php if($flag == 'es')
  {
  		echo form_radio(array('name' => 'user_status', 'value' => '1', 'checked' => ('1' == $user_status), 'id' => 'user_auth','onclick' => 'showPassDiv()')).form_label('Authorised', 'authorised');
 
?>&nbsp;&nbsp;<?php echo form_radio(array('name' => 'user_status', 'value' => '0', 'checked' => ('0' == $user_status), 'id' => 'user_unauth','onclick' => 'hidePassDiv()')).form_label('Unauthorised', 'unauthorised'); 
  	}else
  	{
  		echo form_radio(array('name' => 'user_status', 'value' => '1', 'checked' => ('1' == $user_status), 'id' => 'user_auth','onclick' => 'showPassDiv()')).form_label('Authorised', 'authorised');
 
?>&nbsp;&nbsp;<?php echo form_radio(array('name' => 'user_status', 'value' => '0', 'checked' => ('0' == $user_status), 'id' => 'user_unauth')).form_label('Unauthorised', 'unauthorised'); 
  	}?>


</span></label>
                                            
</div>                                 

<?php if($flag == 'es'){?>
<div class="col-lg-5">
  <label for="cname" class="col-lg-11"><span><input type="checkbox" name="changepass" id="changepass" onclick="showDiv()" <?php echo (@$changepass == 1) ?'checked="checked"':' '?> value="1">&nbsp;Reset Password</span></label>
  <label for="cname" class="col-lg-9"></label>
</div>
<?php }?>

<div class="col-lg-5" id="show_password" <?php if($flag == 'es' && $changepass == 1){?>style="display:block;"<?php }elseif($flag == 'es' && $changepass != 1){?>style="display:none;"<?php }?> >

                                        <label for="cname" class="col-lg-11">Password<span class="star">*</span></label>
                                          
                                            <div class="col-lg-12">
    <?php $data = array(
            'name'        => 'user_password',
            'id'          => 'user_password',
            'type'    =>'password',
            'maxlength'   => '100',                                
            'class'    => 'form-control-pass',
                                
                    );
                    echo form_input($data);?><i class="bi bi-eye-slash" style="margin-bottom: -30px; cursor: pointer;" id="togglePassword"></i>
                                            </div>
</div>
<?php if(form_error("user_status") || form_error("user_password")){?>
<div class="col-lg-5">
<span class="col-lg-11"><?php echo form_error("user_status") ? form_error("user_status"): "&nbsp;";?>
</span>
</div><?php }?>
<div class="col-lg-5">
<span class="col-lg-12"><?php echo form_error("user_password") ? form_error("user_password"): "&nbsp;";?>
</span>
</div>

<div class="col-lg-11">
 <label for="cname" class="col-lg-5">Permissions</label></div>
<div class="panel-body">
<div class="modules">

	<div class="col-lg-11">
			<table width="100%">
				
				<tr style="background-color:#E5E4E2;border-bottom: 1pt solid #E0E0E0;">
					<td width="40%">PERMISSIONS</td>
					<td width="15%"><input type="checkbox" name="indexall" id="indexAll" <?php echo ((@$indexall == "on")?'checked="checked"':'')?>>&nbsp;&nbsp;INDEX</td>
					<td width="15%"><input type="checkbox" name="addall" id="addAll" <?php echo ((@$addall == "on")?'checked="checked"':'')?>>&nbsp;&nbsp;ADD</td>
					<td width="15%"><input type="checkbox" name="editall" id="editAll" <?php echo ((@$editall == "on")?'checked="checked"':'')?>>&nbsp;&nbsp;EDIT</td>
					<td width="15%"><input type="checkbox" name="deleteall" id="deleteAll" <?php echo ((@$deleteall == "on")?'checked="checked"':'')?>>&nbsp;&nbsp;DELETE</td>
				</tr>
				<tr>
					<td width="40%"><?php echo lang("DASHBOARD");?></td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="index_id" value="1" <?php if(is_array($menu_rights)) echo (in_array(1,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					
				</tr>
				<tr>
					<td width="40%"><?php echo lang("ADMIN_MANAGEMENT");?></td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="index_id" value="2" <?php if(is_array($menu_rights)) echo (in_array(2,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="add_id" value="3" <?php if(is_array($menu_rights)) echo (in_array(3,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="edit_id" value="4" <?php if(is_array($menu_rights)) echo (in_array(4,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="delete_id" value="5" <?php if(is_array($menu_rights)) echo (in_array(5,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td width="40%"><?php echo lang("JOBS");?></td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="index_id" value="6" <?php if(is_array($menu_rights)) echo (in_array(6,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="add_id" value="7" <?php if(is_array($menu_rights)) echo (in_array(7,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="edit_id" value="8" <?php if(is_array($menu_rights)) echo (in_array(8,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="delete_id" value="9" <?php if(is_array($menu_rights)) echo (in_array(9,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td width="40%"><?php echo lang("RESUMES");?></td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="index_id" value="10" <?php if(is_array($menu_rights)) echo (in_array(10,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="add_id" value="11" <?php if(is_array($menu_rights)) echo (in_array(11,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="edit_id" value="12" <?php if(is_array($menu_rights)) echo (in_array(12,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="delete_id" value="13" <?php if(is_array($menu_rights)) echo (in_array(13,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td width="40%"><?php echo lang("COMPANIES");?></td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="index_id" value="14" <?php if(is_array($menu_rights)) echo (in_array(14,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="add_id" value="15" <?php if(is_array($menu_rights)) echo (in_array(15,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="edit_id" value="16" <?php if(is_array($menu_rights)) echo (in_array(16,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="delete_id" value="17" <?php if(is_array($menu_rights)) echo (in_array(17,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td width="40%"><?php echo lang("REPORTS");?></td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="index_id" value="18" <?php if(is_array($menu_rights)) echo (in_array(18,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					
				</tr>
				<tr>
					<td width="40%"><?php echo lang("MASTERS");?></td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="index_id" value="19" <?php if(is_array($menu_rights)) echo (in_array(19,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="add_id" value="20" <?php if(is_array($menu_rights)) echo (in_array(20,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="edit_id" value="21" <?php if(is_array($menu_rights)) echo (in_array(21,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="delete_id" value="22" <?php if(is_array($menu_rights)) echo (in_array(22,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
				</tr>
				
				<tr>
					<td width="40%"><?php echo lang("SEND_EMAIL");?></td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="index_id" value="27" <?php if(is_array($menu_rights)) echo (in_array(27,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					
				</tr>

				<tr>
					<td width="40%"><?php echo lang("DOWNLOAD_FORMS");?></td>
					<td width="15%"><input type="checkbox" name="menu_id[]" class="index_id" value="28" <?php if(is_array($menu_rights)) echo (in_array(28,$menu_rights)?'checked="checked"':'')?>>&nbsp;&nbsp;</td>
					
				</tr>

			</table>
			<div align="center" style="padding-top: 20px;"><input type="submit" name="SUBMIT" value="SUBMIT" class="btn sh" style="background-color:#342f29; color:#FFF;"></div>
		</div></div>
                                        </div>

</div></div>
                                    </form>
                                </div>

                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>

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

function showDiv()
{ 
       if($("#changepass").prop('checked') == true)
       {
            $("#show_password").css("display","block");
        }else
        {
            $("#show_password").css("display","none");
        }
}

function hidePassDiv()
{
	//	alert("hiii");
		$("#changepass").prop( "checked", false );
       if($("#user_unauth").prop("checked") == true)
       {
       		
            $("#show_password").css("display","none");
        }else
        {
            $("#show_password").css("display","block");
        }
}

function showPassDiv()
{
	//	alert("hiii");
	$("#changepass").prop( "checked", true );
       if($("#user_auth").prop("checked") == true)
       {
       		
            $("#show_password").css("display","block");
        }else
        {
            $("#show_password").css("display","none");
        }
}
$( document ).ready(function() 
{
	if($('.index_id:checked').length == $('.index_id').length){
            $('#indexAll').prop('checked',true);

        }else{
            $('#indexAll').prop('checked',false);
        }
    if($('.add_id:checked').length == $('.add_id').length){
            $('#addAll').prop('checked',true);
        }else{
            $('#addAll').prop('checked',false);
        }
    if($('.edit_id:checked').length == $('.edit_id').length){
            $('#editAll').prop('checked',true);
        }else{
            $('#editAll').prop('checked',false);
        }
    if($('.delete_id:checked').length == $('.delete_id').length){
            $('#deleteAll').prop('checked',true);
        }else{
            $('#deleteAll').prop('checked',false);
        }

 });


 $("#indexAll").click(function(){ //alert("hii");
            $(".index_id").prop('checked',$(this).prop('checked'));
     });
 $("#addAll").click(function(){ //alert("hii");
            $(".add_id").prop('checked',$(this).prop('checked'));
     });
  $("#editAll").click(function(){ //alert("hii");
            $(".edit_id").prop('checked',$(this).prop('checked'));
     });
   $("#deleteAll").click(function(){ //alert("hii");
            $(".delete_id").prop('checked',$(this).prop('checked'));
     });
</script>