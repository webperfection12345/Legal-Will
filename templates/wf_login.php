<?php 
//require_once( wp_normalize_path(ABSPATH).'wp-load.php');
include( CD_PLUGIN_PATH . 'templates/wf_head.php');
if(!is_user_logged_in()){
?>


	<div class="wflogin_container">
		<?php 
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image_url = wp_get_attachment_image_src ( $custom_logo_id , 'full' );
	?>
	<!-- Welcome -->
	<div class="logo_willed_form"><img src="<?php echo $image_url[0];?>" class="wf_form_logo"></div>
		<form class="logform" >
			<h4 class="title">Login</h4>				
			<div>
				<input class="text_field form-group" name="email" id="email" placeholder="Email Address" type="text">
				<span class="wf_error_mesg" id="mailcheck" style="color: red ;">Required field</span>	
				<span id="emailvalid" class="form-text text-muted invalid-feedback wf_error_mesg" style="color: red !important;">Your email must be a valid email</span>
			</div>
			<div>
				<input class="text_field form-group" name="password" id="password" placeholder="Password" type="password">	
				<span class="wf_error_mesg" id="passcheck" style="color: red;">Required field</span>
			</div>
			<div class="login_cred_error">
				<span class="wf_error_mesg" id="emailnotvalid" style="color: red ;">Either the email or password you entered is invalid.</span>	
				<span class="wf_error_mesg" id="emailnotverified" style="color: red ;">Email not verified please verify from mail account.</span>	
				
			</div>
			<div style="position:relative;">
				<input class="" id="wflogin_sbt" name="" type="button" value="Sign in"><span id="loader_imagedv" style="display: none;"><img class="image_loader" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
			</div>

			<div class="booka_call">
				<p>Forgot your password? <a href="" class="goto_reset_pwd">Reset password</a></p>
				<p>Don't have an account? <a href="<?php echo site_url('/willed-form/'); ?>" class="goto_sign_btn">Sign up</a></p>
			</div>
		</form>
	</div>

<?php 
} else {
	echo 'you are logged in<br>';
	echo "<a href='".site_url('wfdashboard')."'>Dashboard</a><br>";
	echo "<a href='".wp_logout_url(get_permalink())."'>Logout</a>";
}
?>	
	<script type="text/javascript">
  	jQuery(document).ready(function() {
  		$("#passcheck").hide();
  		$("#mailcheck").hide();
  		$("#emailvalid").hide();
  		$("#emailnotvalid").hide(); 
  		$("#emailnotverified").hide(); 
	    /******************Login to account **************************/
	    jQuery(document).on('click', '#wflogin_sbt', function(e) {
	    	e.preventDefault();
	    	let emailValue = $("#email").val();
	    	let passwordValue = $("#password").val();
	    	var ajaxurls = '<?php echo admin_url('admin-ajax.php');?>';
		    validateEmail();
		    validatePassword();
	     	if ( passwordError == true && emailError == true) {
		      	jQuery('#wflogin_sbt').prop('disabled',false);
				jQuery('#wflogin_sbt').removeAttr('style');
	      	  	jQuery.ajax({
	                type : "post",
	                url : ajaxurls,
	                data:{ 'action': 'login_act','emailValue': emailValue, 'passwordValue':passwordValue },
                 	beforeSend: function(){
					    $("#loader_imagedv").show();
					    $('#wflogin_sbt').addClass('submit_disable');
					},
					complete: function(){
					    $("#loader_imagedv").hide();
					    $('#wflogin_sbt').removeClass('submit_disable');
					},
	                success: function(response) {
	                	var resArray = JSON.parse(response);
	                    if(resArray.msg == 'email_pswd_invalid') {
	                    	$("#emailnotvalid").show();
	                    }
	                    if(resArray.msg == 'email_not_verified') {
	                    	$("#emailnotverified").show();
	                    }
	                    if(resArray.msg == 'successlog') {
	                        setTimeout( function() {
	                        	var base_url = window.location.origin;
								nextpageurl = base_url+'/wfdashboard/?'+'will=about';
	                        	window.location.replace(nextpageurl);
	                        }, 200);
	                    }
	                   
	                }
	            });  
		    } else {
		    	jQuery('#wflogin_sbt').prop('disabled',true);
				jQuery('#wflogin_sbt').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
		      	return false;
		    }
	    });

	    $("#email").keyup(function () {
		    validateEmail();
	  	});
	    $("#password").keyup(function () {
		    validatePassword();
	  	});

		function validateEmail(){
			$("#emailnotvalid").hide();  
			//$("#emailnotverified").hide();  
				
    		// Validate Email
		  	let emailValue = $("#email").val();
		  	if (emailValue.length == "") {
		     	$("#mailcheck").show();
			    emailError = false;
			    return false;
			    jQuery('#wflogin_sbt').prop('disabled',true);
				jQuery('#wflogin_sbt').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
		    } else {
		      	$("#mailcheck").hide();
		      	emailError = true;
		      	jQuery('#wflogin_sbt').prop('disabled',false);
				jQuery('#wflogin_sbt').removeAttr('style');
		    }
		    const email = document.getElementById("email");
		  	//email.addEventListener("blur", () => {
		    let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
		    let s = email.value;
		    if (regex.test(s)) {
		    	$("#emailvalid").hide();
		      	emailError = true;
		      	jQuery('#wflogin_sbt').prop('disabled',false);
				jQuery('#wflogin_sbt').removeAttr('style');
		    } else {
		    	$("#emailvalid").show();
		      	emailError = false;
		      	jQuery('#wflogin_sbt').prop('disabled',true);
				jQuery('#wflogin_sbt').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
		    }
		  	//});
	    }

	    function validatePassword(){
	    	$("#emailnotvalid").hide(); 
	    	//$("#emailnotverified").hide(); 
	    	 	
	    	let passwordValue = $("#password").val();
	    	if (passwordValue.length == "") {
		     	$("#passcheck").show();
			    passwordError = false;
			    return false;
			    jQuery('#wflogin_sbt').prop('disabled',true);
				jQuery('#wflogin_sbt').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
		    } else {
		      	$("#passcheck").hide();
		      	//	return true;
		      	passwordError = true;
		      	jQuery('#wflogin_sbt').prop('disabled',false);
				jQuery('#wflogin_sbt').removeAttr('style');
		    }
	    }
	    


     });

	</script>