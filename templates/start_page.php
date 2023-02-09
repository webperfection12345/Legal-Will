<?php 
//require_once( wp_normalize_path(ABSPATH).'wp-load.php');
include( CD_PLUGIN_PATH . 'templates/wf_head.php');
?>


<div class="content main_page_wrapper">
	<?php 
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image_url = wp_get_attachment_image_src ( $custom_logo_id , 'full' );
	?>
	<!-- Welcome -->
	<div class="logo_willed_form"><img src="<?php echo $image_url[0];?>" class="wf_form_logo"></div>
    <div class="main_start_page"> 
		<section class="bg-sand pt-32 pb-16 lg:pb-32 lg:pt-32">
			<div class="container grid grid-cols-1 lg:grid-cols-2 items-center">
			   <div class="row">
				    <div class="col-md-6">
						<img class="image_baner starting_banner" src="<?php echo CD_PLUGIN_URL . 'assets/images/initial_state.png'; ?>">
					</div>
					<div class="col-md-6">
				 		<div class="legal-will_text">
							<h2>Your legal Will in minutes</h2>
							<p>Write a Will online in as little as 15 minutes, and get peace of mind for you and your loved ones.</p>
							<span class="wf_btn elementor-button-link elementor-button elementor-size-xs" id="goto_start_form" href="">Start your Will</span>
					   </div>
					</div>
			   </div>
			</div>
		</section>      
  	</div>

	<!-- get_start -->

	<!-- Multistep Form -->
	<div  class="welcome_willed_pst text-center" style="display:none;"> 
		<img class="image_baner hello_banner" src="<?php echo CD_PLUGIN_URL . 'assets/images/hello.jpg'; ?>">
      	<div class="final-msg">
			<h4 class="title">Welcome to Willed</h4>
		</div>
		<p>Get your legally valid will in as little as 15 minutes. </p><p>Our will experts are available by phone, email and live chat to assist you.</p><p> To get started we just have a few questions...</p>	
		<input class=" wf_btn get-btn-cst Get_Started" name="next" type="button" value="Get Started">
		<div class="booka_call">
			<a class="book_call_btn" href="">Book A Call</a>
			<p>Already have an account? <a href="<?php echo site_url('/wflogin/'); ?>" class="login_btn">Log in</a></p>
		</div>
	</div>


	<div class="main_form" style="display:none;">
		<img class="image_baner progressbar_banner" src="<?php echo CD_PLUGIN_URL . 'assets/images/progressbar.jpg'; ?>">
		<form action="" class="regform" method="post">

			<!-- Progress Bar -->

			<ul id="progressbar">

				<li class="active"></li>

				<li></li>

				<li></li>

				<li></li>

				<li></li>

			</ul>
 
			<!-- Fieldsets -->

		
			<fieldset id="first" class="fieldset_with_no_australia fieldset_btns_group">
				<p class="subtitle">Question 1 of 5</p>
				<div class="final-msg">
					<h4 class="title"> Do you live in Australia?</h4>
				</div>
				<!-- <div class="next_prev_div"> -->
					<button class="next_btn wf_btn next_btn_firstbtn" name="" type="button" value="yes">
					Yes</button>
					<button class="wf_btn wf_next_btn fs_no_btn_live " name="" type="button" value="no">No</button>
				<!-- </div> -->
				<!-- <span class="wf_btn wf_next_btn fs_no_btn_live">No</span> -->
				
				<hr>
				<span href="" class="pre_btn wf_pre_btn first_fieldset_bk_btn" name="previous"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</span>
			</fieldset>

			<fieldset class="fieldset_with_no_18age fieldset_btns_group">
				<p class="subtitle">Question 2 of 5</p>
				<div class="final-msg">
					<h4 class="title">Are you over 18 years of age?</h4>
				</div>
				<button class="next_btn wf_btn wf_next_btn next_btn_firstbtn" name="wf_adult_age" type="button" value="">Yes</button>
				<button class="wf_btn wf_next_btn fs_no_btn_age" name="wf_adult_age" type="button" value="">No</button>
				<!-- <span class="wf_btn wf_next_btn fs_no_btn_age">No</span> -->
				<hr>
				<span href="#" class="pre_btn wf_pre_btn" name="previous" ><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</span>
			</fieldset>

			<fieldset class="fieldset_btns_group" id="relation_status_dv">
				<p class="subtitle">Question 3 of 5</p>
				<div class="final-msg">
					<h4 class="title">What is your relationship status?</h4>
				</div>
				<button class="next_btn wf_btn wf_next_btn next_btn_relatbtn" name="wf_relationship_status" type="button" value="single">Single</button>
				<button class="next_btn wf_btn wf_next_btn" name="wf_relationship_status" type="button" value="married">Married</button>
				<button class="next_btn wf_btn wf_next_btn" name="wf_relationship_status" type="button" value="defacto">Defacto</button>
				<hr>
				<span href="" class="pre_btn wf_pre_btn" name="previous" ><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</span>
			</fieldset>
			<fieldset class="fieldset_btns_group">
				<p class="subtitle">Question 4 of 5</p>
				<div class="final-msg">
					<h4 class="title">Do you have any children?</h4>
				</div>
				<button class="next_btn wf_btn wf_next_btn next_btn_firstbtn" name="wf_have_any_children" type="button" value="yes">Yes</button>
				<button class="next_btn wf_btn wf_next_btn" name="wf_have_any_children" type="button" value="no">No</button>
				<hr>
				<span href="" class="pre_btn wf_pre_btn" name="previous" ><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</span>

			</fieldset>
			<fieldset class="fieldset_btns_group">
				<p class="subtitle">Question 5 of 5</p>
				<div class="final-msg">
					<h4 class="title">Do you want to include 'Adoptive parents' and/or provide a gift for your pet?</h4>
				</div>
				<button class="next_btn wf_btn wf_next_btn wf_have_any_pets next_btn_firstbtn" name="wf_have_any_pets" type="button" value="yes">Yes</button>
				<button class="next_btn wf_btn wf_next_btn wf_have_any_pets" name="wf_have_any_pets" type="button" value="no">No</button>
				<hr>
				<span class="pre_btn wf_pre_btn" name="previous" ><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</span>
			</fieldset>
		
			<div class="sorry_div_live" style="display:none;">
				<img class="image_baner sorry_banner" src="<?php echo CD_PLUGIN_URL . 'assets/images/sorry.jpg'; ?>">
				<p>Unfortunately, we can only create wills for adults over the age of 18 who are living in Australia.</p>
				<span class="back_btn"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</span>
			</div>
			<div class="sorry_div_18age" style="display:none;">
				<img class="image_baner sorry_banner" src="<?php echo CD_PLUGIN_URL . 'assets/images/sorry.jpg'; ?>">
				<p>Unfortunately, we can only create wills for adults over the age of 18 who are living in Australia.</p>
				<span class="back_btn"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</span>
			</div>
		</form>

	</div>


	<!-- account div -->
		<div class="before_account_sigup" style="display:none">
			<h1>Hooray!</h1>
			<h2 class="title">You are ready to create your will. It is as easy as:</h2>
			<ul>
				<li>
					<div class="number">
						<span class="num">1</span>
					</div>
					<div class="content_act">
						<h4>Create your account</h4>
					<p>Access your account anywhere and anytime to complete, save and download your Will.</p>
					</div>
				</li>
				
				<li>
					<div class="number">
						<span class="num">2</span>
					</div>
					<div class="content_act">
						<h4>Answer a few questions</h4>
						<p>Fill out our guided Will form to create your Will online.</p>
					</div>
				</li>

				<li>
					<div class="number">
						<span class="num">3</span>
					</div>
					<div class="content_act">
						<h4>Print & Sign your Will</h4>
						<p>Only pay once you are ready to download your Will.</p>
					</div>
				</li>
			</ul>
			<input class="next_btn wf_btn wf_next_btn goto_create_account" name="next" type="button" value="Create Account">
		</div>

		<div class="my_account_fs on_account_sigup" style="display:none">
			<h4 class="title">Create account</h4>				
				<!-- <form id="msform"> -->
				<!-- <input type="hidden" name="action" value="createuser_account" > -->
			<div class="form-row">
				<input class="text_field form-group" name="email" id="email" placeholder="Email Address" type="text">
				<span class="wf_error_mesg front_input_form" id="mailcheck" style="color: red ;">Required field</span>	
				<span id="emailvalid" class="form-text text-muted invalid-feedback wf_error_mesg front_input_form" style="color: red !important;">Your email must be a valid email</span>
			</div>
			<div class="form-row">
				<input class="text_field form-group" name="password" id="password" placeholder="Password" type="password">
				<span class="wf_error_mesg front_input_form" id="passcheck" style="color: red;">Required field</span>
				<span class="wf_error_mesg front_input_form" id="strongPasscheck" style="color: red;">Min. 8 chars, atlesst 1 uppercase and lowercase letter, special character and number</span>
			</div>
			<div class="form-row terms_and_policy">
				<div class="form-row">	
					<input aria-checked="false" id="input-88" role="checkbox" type="checkbox" name="term_check" value="1">
					<label for="input-88" class="" style="left: 0px; right: auto; position: relative;"><span class="black--text">I have read, understand accept the <a href="" target="_blank">Privacy Policy</a> and <a href="" target="_blank">Willed Platform Terms and Conditions</a></span></label>
					<span class="wf_error_mesg front_input_form" id="inputcheck" style="color: red ;">Accept to proceed</span>
				</div>
			</div>
			<div class="loader_div loader_div_front create_act_btn">
				<input class="" id="next-create-btn" name="action" type="button" value="Submit">
				<span style="display: none;" id="loader_imagedv" class="loader_image loader_image_container"><img class="image_loader image_loader_image" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
			</div>
			<div class="booka_call">
				<p>Already have an account? <a href="<?php echo site_url('/wflogin/'); ?>" class="login_btn">Log in</a></p>
			</div>
			<!-- </form> -->
		</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	$("#passcheck").hide();
	$("#strongPasscheck").hide();
	$("#mailcheck").hide();
	$("#emailvalid").hide(); 
	$("#inputcheck").hide(); 
	 	
  	/******************Create an account **************************/
    jQuery(document).on('click', '#next-create-btn', function(e) {
        e.preventDefault();
        var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
        var email = $("#email").val();
        var password = $("#password").val();
        var inputcheck = $("#input-88").val();
        validatemail();
        validatePaswrd();
        validateinputcheck();
        if ( passwordError == true && emailError == true && checkedboxError == true ) {
        	jQuery('#next-create-btn').prop('disabled',false);
			jQuery('#next-create-btn').removeAttr('style');
            //alert('go next');
             jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : { 'action': 'createuser_account','email': email, 'password':password },
                beforeSend: function(){
				    $("#loader_imagedv").show();
				    $(this).addClass('submit_disable');
				},
				complete: function(){
				    $("#loader_imagedv").hide();
				    $(this).removeClass('submit_disable');
				},
                success: function(response) {
                 	var resArray = JSON.parse(response);
                    if(resArray.msg == 'email_exists') {
                    	jQuery( '<span class="wf_error_mesg" id="mailexist" style="color: red ;">Email already exist.</span>').insertAfter( jQuery( "#email" ) );
                    }
                    if(resArray.msg == 'accountcreate') {
                        setTimeout( function() {
                        	alert('Registered successfully. Please goto your registered mail inbox or spam and click on activate link.');
                           	window.location.replace('https://hlblawyers.com.au/'); 
                            //window.location.href = "https://hlblawyers.com.au/wfdashboard/";  
                        },200);
                    }
                   
                }
            });  
        } else {
        	jQuery('#next-create-btn').prop('disabled',true);
			jQuery('#next-create-btn').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
            return false;
        }
    });

 	$('body').find("#email").keyup(function () {
        validatemail();
    });
    $('body').on('keyup',"#password", function () {
        validatePaswrd();
    });

    $('body').find("#input-88").change(function () {
        validateinputcheck();
    });
    
    function validatemail(){
    	 $("#mailexist").hide();
        var emailValue = $("#email").val();
        if (emailValue.length == "") {
            $("#mailcheck").show();
            emailError = false;
            return false;
            jQuery('#next-create-btn').prop('disabled',true);
			jQuery('#next-create-btn').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
        } else {
            $("#mailcheck").hide();
            emailError = true;
            jQuery('#next-create-btn').prop('disabled',false);
			jQuery('#next-create-btn').removeAttr('style');
        }
        const email = document.getElementById("email");
        let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        let s = email.value;
        if (regex.test(s)) {
            $("#emailvalid").hide();
            emailError = true;
            jQuery('#next-create-btn').prop('disabled',false);
			jQuery('#next-create-btn').removeAttr('style');
        } else {
            $("#emailvalid").show();
            emailError = false;
            jQuery('#next-create-btn').prop('disabled',true);
			jQuery('#next-create-btn').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
        }
    }
    function validatePaswrd(){
        var passwordValue = $("#password").val();
        if (passwordValue.length == "") {
            $("#passcheck").show();
            $("#strongPasscheck").hide();
            passwordError = false;
            return false;
            jQuery('#next-create-btn').prop('disabled',true);
			jQuery('#next-create-btn').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
        } else {
        	 $("#passcheck").hide();
			var regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
			//jQuery("#passwordText").text(`Password value:- ${passwordValue}`);
			if(!regex.test(passwordValue)) {
				$("#strongPasscheck").show();
				passwordError = false;
            	return false;
            	jQuery('#next-create-btn').prop('disabled',true);
				jQuery('#next-create-btn').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
		    }else{
		    	$("#strongPasscheck").hide();
	            $("#passcheck").hide();
	            passwordError = true;
	            jQuery('#next-create-btn').prop('disabled',false);
				jQuery('#next-create-btn').removeAttr('style');
			}
        }
    }

    function validateinputcheck(){
    	if(!$("#input-88").is(':checked')){
		 	$("#inputcheck").show();
            checkedboxError = false;
            return false;
            jQuery('#next-create-btn').prop('disabled',true);
			jQuery('#next-create-btn').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
    	} else {
    		$("#inputcheck").hide();
            checkedboxError = true;
            jQuery('#next-create-btn').prop('disabled',false);
			jQuery('#next-create-btn').removeAttr('style');
    	}
    }

});
</script>